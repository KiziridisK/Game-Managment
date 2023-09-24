<?php
#AddGame submit file
session_start();
if(isset($_POST['addGame-submit'])){
    #Inserting the database handle php file to establish database connection
    require_once("databaseHandle.inc.php");

    #Extracting the add game form data from POST method
    $title = strip_tags(trim($_POST['title']));
    $descreption = strip_tags(trim($_POST['descreption']));
    $release = strip_tags(trim($_POST['releaseDate']));
    $genre = strip_tags(trim($_POST['genre']));

    # Get user id
    $sql = "SELECT id FROM users WHERE Username= :username";
    $stmt = $conn -> prepare($sql);
    $stmt ->bindParam(':username', $_SESSION['userName'], PDO::PARAM_STR);
    $stmt ->execute();
    $idData = $stmt->fetch(PDO::FETCH_ASSOC);

    if(empty($idData)){
       header("Location: ../games.php?error=userNotFound");
    }else{
        $userId = $idData['id'];
    }


    # Error checking for empty fields
    # Check to see if all fields are missing-sends the user back to games.php with usefull data in the url
    if(empty($title) && empty($descreption) && empty($release) && empty($userId) && empty($genre) ){
        header("Location: ../games.php?error=missingFields&title=".$title.
        "&descreption=".$descreption."&release=".$release."&genre=".$genre);
        exit();
    }
    # Check to see if "title" field is empty. Sends the user back to games.php
    else if(empty($title)){
        header("Location: ../games.php?error=missingTitle&descreption=".$descreption.
        "&release=".$release."&genre=".$genre);
        exit();
    }
    # Check to see if "descreption" field is empty. Sends the user back to games.php
    else if(empty($descreption)){
        header("Location: ../games.php?error=missingDescreption&title=".$title.
        "&release=".$release."&genre=".$genre);
        exit();
    }
    # Check to see is "release" field is empty. Sends the user back to games.php
    else if(empty($release)){
        header("Location: ../games.php?error=missingRelease&title=".$title.
        "&descreption=".$descreption."&genre=".$genre);
        exit();
    }# Check to see is "genre" field is empty. Sends the user back to games.php
    else if(empty($genre)){
        header("Location: ../games.php?error=missingGenre&title=".$title.
        "&descreption=".$descreption."&release=".$release."genre=".$genre);
        exit();
    }
    # Check to see if "title" field is valid. Sends the user back to games.php
    else if(!preg_match("/^[a-zA-Z0-9]*$/", $username)){
        header("Location: ../games.php?error=invalidTitle&descreption=".$descreption.
        "&release=".$release);
        exit();
    }else{


        $str2 = $conn->prepare("SELECT * FROM games WHERE title=:title AND userId= :userId");
        $str2->execute(['title'=>$title, 'userId'=>$userId]);
        $titleResult = $str2->fetch(PDO::FETCH_OBJ);

        //Checking the results. Fetch method returns false if the query result is 
        //empty. If it's true then the game exists.

        if($titleResult != false){
            header("Location: ../games.php?=gameTitleAlreadyExistsForUser");
            exit();
        }else{
            $sql = $conn->prepare("INSERT INTO games (title, descreption, genre, releaseDate, userId)
            VALUES (:title, :descreption, :genre, :releaseDate, :userId)");
            $sql->execute(['title'=>$title, 'descreption'=>$descreption, ':genre'=>$genre ,'releaseDate'=>$release, 'userId'=>$userId]);
            header("Location: ../games.php?addGame=success");
        }
    }


}else{
    header("Location: ../games.php");
}

?>