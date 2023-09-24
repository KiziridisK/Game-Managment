<?php
session_start();
# Check  to see if post method is set.
if(isset($_POST['deleteGame-submit'])){
    #Take game's title.
    $title = strip_tags(trim($_POST['title']));

    # Take user's id 
    require_once('databaseHandle.inc.php');
    
    $sql = "SELECT id FROM users WHERE Username= :username";
    $stmt = $conn -> prepare($sql);
    $stmt ->bindParam(':username', $_SESSION['userName'], PDO::PARAM_STR);
    $stmt ->execute();
    $idData = $stmt->fetch(PDO::FETCH_ASSOC);

    if(empty($idData)){
       header("Location: ../games.php?error=userNotFound");
       exit();
    }else{
        $userId = $idData['id'];
    }
    #Check to see if the game the user wants to delete exists in his/her game.
    $sql = $conn-> prepare("SELECT * FROM games WHERE title= :title AND userId= :userId");
    $sql -> execute([':title'=>$title, ':userId'=> $userId]);
    $gameResult =  $sql->fetchAll(PDO::FETCH_ASSOC);

    if(empty($gameResult)){
        header("Location:../games.php?error=gameDoesNotExistForUser");
    }else{
        # Deleting the game from the database.
        $sql = $conn -> prepare("DELETE FROM games WHERE title= :title AND userId= :userId");
        $sql ->execute([':title' => $title , ':userId' => $userId]);
        $deleteResult = $sql ->rowCount();
        if($deleteResult == 1){
            header("Location: ../games.php?delete=success");
        }
        

    }
    

}else{
    header("Location: ../games.php");
}

?>