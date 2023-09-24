<?php 
  // Using require to add the needed php files
  require_once('inc/databaseHandle.inc.php');
  require_once('header.php');
  require_once('functions.php');

  // Starting the session
  session_status() === PHP_SESSION_ACTIVE ?: session_start();  

  // Webpage that contains the register form for the user. 
?>

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
  <!-- Form div-->
    <div class="d-flex justify-content-center mt-5 mb-5">
        <form class="form-group-row"  action="inc/signUp.inc.php" method="POST">
            <div class="row"><h1>Sign Up</h1></div>
            <div class="row">
              <!--First Name div -->
              <div class="col">
                <label for="firstName">First Name</label>
                <input type="text" name="firstName"  class="form-control" placeholder="First Name">
              </div>  
              <!--Last Name div -->
              <div class="col">
                <label for="lastName">Last Name</label>
                <input type="text" name="lastName"  class="form-control" placeholder="Last Name">
              </div>
            </div>
            <div class="row">
              <!--Username div -->
              <div class="col">
                <label for="userName">Username</label>
                <input type="text" name="userName"  class="form-control" placeholder="Username">
              </div>
            </div>
            <div class="row">
              <!--Email div -->
              <div class="col">
                <label for="userEmail">Email</label>
                <input type="email" name="userEmail"   class="form-control" placeholder="Email">
              </div>
            </div>
            <div class="row">
              <!--Password div -->
              <div class="col">
                <label for="password">Password</label>
                <input type="password" name="password"  class="form-control" placeholder="Password">
              </div>
            </div>
            <div id="error_div">
              <?php if(isset($missingFieldError)){echo '<label class="text-danger">'.$missingFieldError.
                      '</label>';}
              ?>
            </div>
            <div class="justify-content-center">
                Already have an account? <a href="index.php">Sign In!</a>
            </div>
            <div class="row mt-3">
              <!--SignUp submit button div  -->
              <div class="col-sm-6">
                  <button type="submit" class="btn btn-primary" name="signUp-submit">Sign Up</button>
              </div>
            </div>
        </form>        
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

</body>
</html>

<?php require_once('footer.php'); ?>