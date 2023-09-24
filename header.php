<?php
 session_start()
 # Header file. It is used in every page the users sees.
?>

<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="description" content="Demo webpage">
        <meta name="keywords" content="Demo, HTML, CSS, BootStrap">
        <meta name="author" content="Konstantinos Kiziridis">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>This is a demo website</title>
        <!--Bootstrap added-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" 
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

        

    </head>

    <body>
    
    <!--Bootstrap JS added-->    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
      
    <!--Navbar -->
      <nav class="navbar navbar-expand-md navbar-primary bg-dark">
        <div class="container-fluid">
          <a class="navbar-brand" href="index.php">Game Managment</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="index.php">Home</a>
              </li>
              <?php if(isset($_SESSION['userName'])){
                        echo '<li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="games.php">Manage Games</a>
                              </li>
                              <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="viewGames.php">View Games</a>
                              </li>';
                              
                    }
                ?>
            </ul>

            
            <ul class="navbar-nav mr-auto mb-2 mb-lg-0">
              <?php 
              # Checking session values to dynamicly display content.
              if(isset($_SESSION['userName'])){
                echo'<li class="nav-item">
                <form class="form-group-row" action="inc/logOut.inc.php" method="POST">
                  <div class="col">
                    <button type="submit" class="btn btn-primary" name="logOut-submit">Log Out</button>
                  </div>
                </form>
              </li>';
              }else{
                echo'<li class="nav-item">
                <div class="header-login">
                  <form class="form-group-row"action="inc/logIn.inc.php" method="POST">
                    <div class="row">
                      <div class="col">
                        <input type="text" name="username" class="form-control" placeholder="Username\Email">
                      </div>
                      <div class="col">
                        <input  type="password" name="password" class="form-control" placeholder="Password">
                      </div>
                      <div class="col-md-auto">
                        <button type="submit" class="btn btn-primary" name="logIn-submit">Log In</button>
                      </div>
                    </div>
                  </form>
                </div>
               </li>
                <li class="nav-item">
                    <a class="nav-link" href="signUp.php">Sign Up</a>
                </li>';
              }?>
            </ul>
          </div>
        </div>
      </nav>


    
    </body>

</html>