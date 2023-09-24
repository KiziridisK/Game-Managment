<?php
    require_once('header.php');
    # Starting page of the website
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    

</head>
<body>

    <!-- Page template -->
    <?php 
        if (!isset($_SESSION['userName'])){
            echo"
            <h1 class='d-flex justify-content-center mt-5 mb-5'>
                Log in to manage your games!
            </h1>
            <h1 class='d-flex justify-content-center mt-5 mb-5'>
            If you don't have an account create one here <a href='signUp.php'>Sign Up!</a>
            </h1>
            
            ";
        }else{
            echo "
            <div class='d-flex justify-content-center mt-5 mb-5'>
                <h1>Welcome back ".$_SESSION['userName']."! </h1>
            </div>
            ";
        }
    ?>
   
    
    
</body>
</html>

<?php
    require_once('footer.php')
?>