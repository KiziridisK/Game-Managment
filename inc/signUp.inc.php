<?php
#SignUp handling php file.
if(isset($_POST['signUp-submit'])){
    #Inserting the database handle php file to establish database connection
    require_once("databaseHandle.inc.php");

    #Extracting the sign up form data from POST method
    $username = strip_tags(trim($_POST['userName']));
    $email = strip_tags(trim($_POST['userEmail']));
    $firstName = strip_tags(trim($_POST['firstName']));
    $lastName = strip_tags(trim($_POST['lastName']));
    $password = strip_tags(trim($_POST['password']));
    
    # Error checking for empty fields
    # Check to see if all fields are missing-sends the user back to signUp.php with usefull data in the url
    if(empty($firstName) && empty($lastName) && empty($username) && empty($email) && empty($password)){
        header("Location: ../signUp.php?error=missingFields&firstName=".$firstName.
        "&lastName=".$lastName."&userName=".$username."&userEmail=".$email);
        exit();
    }
    # Check to see if "fistName" field is empty. Sends the user back to signUp.php
    else if(empty($firstName)){
        header("Location: ../signUp.php?error=missingFirstName&lastName=".$lastName.
        "&userName=".$username."&userEmail=".$email);
        exit();
    }
    # Check to see if "lastName" field is empty. Sends the user back to signUp.php
    else if(empty($lastName)){
        header("Location: ../signUp.php?error=missingLastName&firstName=".$firstName.
        "&userName=".$username."&userEmail=".$email);
        exit();
    }
    # Check to see is "userName" field is empty. Sends the user back to signUp.php
    else if(empty($username)){
        header("Location: ../signUp.php?error=missingUserName&firstName=".$firstName.
        "&lastName=".$lastName."&userEmail=".$email);
        exit();
    }
    # Check to see if "userName" field is valid. Sends the user back to signUp.php
    else if(!preg_match("/^[a-zA-Z0-9]*$/", $username)){
        header("Location: ../signUp.php?error=invalidUserName&firstName=".$firstName.
        "&lastName=".$lastName."&userEmail=".$email);
        exit();
    }
    # Check to see if "userEmail" field is empty. Sends the user back to signUp.php
    else if(empty($email)){
        header("Location: ../signUp.php?error=missingEmail&firstName=".$firstName.
        "&lastName=".$lastName."&userName=".$username);
        exit();
    }else if(empty($password)){
        header("Location:../signUp.php?error=missingPassword&firstName=".$firstName.
        "&lastName=".$lastName."&userName=".$username."&email=".$email);
    }
    # Check to see if "userEmail" field is valid. Sends the user back to signUp.php
    else if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        header("Location: ../signUp.php?error=invalidEmail&firstName=".$firstName.
        "&lastName=".$lastName."&userName=".$username);
        exit();
    }
    else{
        
        $str2 = $conn->prepare("SELECT * FROM users WHERE Email=:email");
        $str2->execute(['email'=>$email]);
        $emailResult = $str2->fetch(PDO::FETCH_OBJ);

        $str = $conn->prepare("SELECT * FROM users WHERE Username=:username");
        $str->execute(['username'=> $username]);
        $usernameResult = $str->fetch(PDO::FETCH_OBJ);
        //Checking the results. Fetch method returns false if the query result is 
        //empty. If it's true then the username exists.
        if($emailResult!= false && $usernameResult!= false){
            header("Location: ../signUp.php?error=UserNameTaken&emailTaken&firstName=".$firstName.
            "&lastName=".$lastName);
            exit();
        }else if($emailResult!= false){
            header("Location: ../signUp.php?error=emailTaken&firstName=".$firstName.
            "&lastName=".$lastName."&userName=".$username);
            exit();
        }else if($usernameResult != false){
            header("Location: ../signUp.php?error=UserNameTaken&firstName=".$firstName.
            "&lastName=".$lastName."&userEmail=".$email);
            exit();
        }else{
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $sql = $conn->prepare("INSERT INTO users (FirstName, LastName, Username, email, pass)
            VALUES (:firstname, :lastname, :username, :email, :pass)");
            $sql->execute(['firstname'=>$firstName, 'lastname'=>$lastName, 'username'=>$username, 'email'=>$email, 'pass'=>$hashedPassword]);
            header("Location: ../signUp.php?signUp=success");
      }
    }
 
    $conn = null;

}else{
    header("Location: ../signUp.php");
}

