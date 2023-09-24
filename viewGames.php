<?php
require_once('header.php');
require_once('inc/databaseHandle.inc.php');
require_once('functions.php');

session_status() === PHP_SESSION_ACTIVE ?: session_start(); 

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

if(isset($_POST['filterGame-submit'] ) and !empty($_POST['genre'])){
    $genre = strip_tags(trim($_POST['genre']));
    $stmt = $conn -> prepare("SELECT * FROM games 
                              WHERE userId= :userId AND genre= :genre 
                              ORDER BY releaseDate DESC");
    $stmt -> execute([':userId' => $userId, ':genre'=> $genre]);
}else if(isset($_POST['filterGame-submit'] ) and empty($_POST['genre'])){
    $stmt = $conn -> prepare("SELECT * FROM games 
                              WHERE userId= :userId
                              ORDER BY releaseDate ASC");
    $stmt -> execute([':userId' => $userId]);
}else{
    $stmt = $conn -> prepare("SELECT * FROM games 
                              WHERE userId= :userId
                              ORDER BY releaseDate ASC");
    $stmt -> execute([':userId' => $userId]);
}

?>

<!-- HTML Page that displays the user's games. -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="background.css">

</head>
<body>
    <div class="d-flex justify-content-center mt-5 mb-1">
        <h1>YOUR GAMES</h1>
    </div>
    <div class="d-flex justify-content-center mt-1">
      <div class="container">
        <div class="row mt-5"></div>
        <div class="col">
          <div class="card mt-5">
            <div class="card-header">
              <h2 class="display-6 text-center">
                <?echo $_SESSION['userName']?>
              </h2>
            <div class="card-body">
              <table class="table table-bordered text-center">
                <tr>
                  <td>Game Title</td>
                  <td>Descreption</td>
                  <td>Genre</td>
                  <td>Release Date</td>
                </tr>
                <tr>
                    <?php
                       while($row = $stmt->fetch(PDO::FETCH_ASSOC)){

                       
                    ?>
                    <td><?php echo $row['title'] ?></td>
                    <td><?php echo $row['descreption'] ?></td>
                    <td><?php echo $row['genre'] ?></td>
                    <td><?php echo $row['releaseDate'] ?></td>
                </tr>
                <?php
                       }
                ?>
              </table>
            </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    
    <!--Filtering  -->
    <div class="d-flex justify-content-center mt-5 mb-5">
        <form action="viewGames.php" class="form-group-row" method="POST">
            <div class="row">
                <div class="col">Filter by Genre</div>
            </div>
            <div class="row">
                <div class="col">
                    <input type="text" name="genre" class="form-control" placeholder="Filter">
                </div>
            </div>
            <div class="row mt-3">
              <!--Filter games submit button div  -->
              <div class="col-sm-6">
                  <button type="submit" class="btn btn-primary" name="filterGame-submit">Filter</button>
              </div>
            </div>
        </form>

    </div> 

<?php
require_once('footer.php');
?>