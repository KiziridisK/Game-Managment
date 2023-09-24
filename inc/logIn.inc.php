<?php 
    if(isset($_POST['logIn-submit'])){
        # Requiring the php database-handler file.
        require_once('databaseHandle.inc.php');

        # Extracting data from POST method
        $username = strip_tags(trim($_POST['username']));
        $password = strip_tags(trim($_POST['password']));

        if(empty($username) && empty($password)){
            header("Location: ../index.php?error=missingUsername&password");
            exit();
        }
        else if(empty($username)){
            header("Location: ../index.php?error=missingUsername");
            exit();
        }
        else if(empty($password)){
            header("Location: ../index.php?error=missingPassword");
            exit();
        }
        else{
            $sql = $conn->prepare("SELECT * FROM users WHERE Username=:username OR Email =:email ");
            $sql ->execute(['username'=> $username, 'email'=> $username]);
            $data = $sql->fetchAll(PDO::FETCH_ASSOC);
            print_r($data);
            if(empty($data)){
                header("Location: ../index.php?error=userNotFound");
            }else{
                $passwordCheck = password_verify($password, $data[0]['pass']);
                if($passwordCheck){
                    header("Location:../index.php?logIn=success");
                    session_start();
                    $_SESSION['userName'] = $data[0]['Username'];
                }else{
                    header("Location:../index.php?error=wrongPassword");
                }
                
            }
        }

    }else{
        header("Location:../index.php");
        exit;
    }
?>

