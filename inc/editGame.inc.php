<?php

session_start();
require_once('../functions.php');

if(isset($_POST['editGame-submit'])){
    #include database handling file
    require_once('databaseHandle.inc.php');

    # Get old title
    $oldTitle = strip_tags(trim($_POST['oldTitle']));

    # Checking which attributes are sent in the form and will be changed.
    if(isset($_POST['changeTitle']) and !empty($_POST['changeTitle'])){
        $newTitle = strip_tags(trim($_POST['changeTitle']));
    }
    if(isset($_POST['changeDescreption']) and !empty($_POST['changeDescreption'])){
        $newDescreption = strip_tags((trim($_POST['changeDescreption'])));
    }
    if(isset($_POST['changeReleaseDate']) and !empty($_POST['changeReleaseDate'])){
        $newRelease = strip_tags(trim($_POST['changeReleaseDate']));
    }

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

    # Get old data 
    $sql = "SELECT descreption, releaseDate FROM games WHERE userId= :userId AND title= :oldTitle ";
    $stmt = $conn -> prepare($sql);
    $stmt ->bindParam(':userId', $userId, PDO::PARAM_INT);
    $stmt ->bindParam(':oldTitle',$oldTitle, PDO::PARAM_STR);
    $stmt ->execute();
    $gameData = $stmt->fetch(PDO::FETCH_ASSOC);

    # Check to see if the game 
    if(empty($gameData)){
       header("Location: ../games.php?error=gameNotFound");
    }

    #Only Title changes
    if(isset($newTitle) and !isset($newRelease) and !isset($newDescreption)){
        $titleSql = $conn->prepare("UPDATE games SET title= :newTitle WHERE title= :oldTitle AND userId= :userId");
        $titleSql->execute(['newTitle'=>$newTitle, 'oldTitle'=>$oldTitle, 'userId'=>$userId]);
        $changeTitleResult = $titleSql->fetch(PDO::FETCH_OBJ);
        header("Location:../games.php?changeTitle=success");
        exit();
    }

     #Only Descreption changes
     if(!isset($newTitle) and !isset($newRelease) and isset($newDescreption)){
        $titleSql = $conn->prepare("UPDATE games SET descreption= :newDescreption WHERE title= :oldTitle AND userId= :userId");
        $titleSql->execute(['newDescreption'=>$newDescreption, 'oldTitle'=>$oldTitle, 'userId'=>$userId]);
        $changeTitleResult = $titleSql->fetch(PDO::FETCH_OBJ);
        header("Location:../games.php?changeDescreption=success");
        exit();
        
    }

    #Only Release changes
    if(!isset($newTitle) and isset($newRelease) and !isset($newDescreption)){
        $titleSql = $conn->prepare("UPDATE games SET releaseDate= :newReleaseDate WHERE title= :oldTitle AND userId= :userId");
        $titleSql->execute(['newReleaseDate'=>$newRelease, 'oldTitle'=>$oldTitle, 'userId'=>$userId]);
        $changeTitleResult = $titleSql->fetch(PDO::FETCH_OBJ);
        header("Location:../games.php?changeReleaseDate=success");
        exit();
    }

    # Change Title, Descreption
    if(isset($newTitle) and !isset($newRelease) and isset($newDescreption)){
        $slq2 = "UPDATE games 
                 SET title= :newTitle, descreption= :newDescreption
                 WHERE title= :oldTitle AND userId= :userId";
        $titleSql = $conn->prepare($slq2);
        $titleSql->execute(['newTitle'=>$newTitle,'newDescreption'=>$newDescreption, 'oldTitle'=>$oldTitle, 'userId'=>$userId]);
        $changeTitleResult = $titleSql->fetch(PDO::FETCH_OBJ);
        header("Location:../games.php?changeTitle&Descreption=success");
        exit();
    }

    # Change Title, Release Date
    if(isset($newTitle) and isset($newRelease) and !isset($newDescreption)){
        $slq2 = "UPDATE games 
                 SET title= :newTitle, releaseDate= :newReleaseDate
                 WHERE title= :oldTitle AND userId= :userId";
        $titleSql = $conn->prepare($slq2);
        $titleSql->execute(['newTitle'=>$newTitle,'newReleaseDate'=>$newRelease, 'oldTitle'=>$oldTitle, 'userId'=>$userId]);
        $changeTitleResult = $titleSql->fetch(PDO::FETCH_OBJ);
        header("Location:../games.php?changeTitle&ReleaseDate=success");
        exit();
    }

    # Change Descreption, Release Date
    if(!isset($newTitle) and isset($newRelease) and isset($newDescreption)){
        $slq2 = "UPDATE games 
                 SET descreption= :newDescreption, releaseDate= :newReleaseDate
                 WHERE title= :oldTitle AND userId= :userId";
        $titleSql = $conn->prepare($slq2);
        $titleSql->execute(['newDescreption'=>$newDescreption,'newReleaseDate'=>$newRelease, 'oldTitle'=>$oldTitle, 'userId'=>$userId]);
        $changeTitleResult = $titleSql->fetch(PDO::FETCH_OBJ);
        header("Location:../games.php?changeDescreption&ReleaseDate=success");
        exit();
    }

    # Change Title, Descreption, Release Date
    if(isset($newTitle) and isset($newRelease) and isset($newDescreption)){
        $slq2 = "UPDATE games 
                 SET title= :newTitle, descreption= :newDescreption, releaseDate= :newReleaseDate
                 WHERE title= :oldTitle AND userId= :userId";
        $titleSql = $conn->prepare($slq2);
        $titleSql->execute(['newTitle'=>$newTitle,'newDescreption'=>$newDescreption,'newReleaseDate'=>$newRelease, 'oldTitle'=>$oldTitle, 'userId'=>$userId]);
        $changeTitleResult = $titleSql->fetch(PDO::FETCH_OBJ);
        header("Location:../games.php?changeTitle&Descreption&ReleaseDate=success");
        exit();
    }
}else{
    header("Location:../games.php");
}


?>

