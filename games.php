<?php 
  // Using require to add the needed php files
  require_once('inc/databaseHandle.inc.php');
  require_once('header.php');
  require_once('functions.php');

  // Starting the session
  session_status() === PHP_SESSION_ACTIVE ?: session_start();  
?>


  <!-- HTML page that contains the game managment functionality -->  
  <!-- Form div-->
    <div class="d-flex justify-content-center mt-5 ms-5">
        <form class="form-group-row"  action="inc/addGame.inc.php" method="POST">
            <div class="row"><h1>Add game</h1></div>
            <div class="row">
              <!--Titme div -->
              <div class="col">
                <label for="title">Title</label>
                <input type="text" name="title"  class="form-control" placeholder="Title">
              </div>  
            </div>
            <div class="row">
                <!--Descreption div -->
                <div class="col">
                <label for="descreption">Descreption</label>
                <input type="text" name="descreption"  class="form-control" placeholder="Descreption">
              </div>
            </div>
            <div class="row">
              <div class="col">
                <label for="genre">Genre</label>
                <input type="text" name="genre" class="form-control" placeholder="Genre">
              </div>
            </div>
            <div class="row">
              <!--Release date div -->
              <div class="col">
                <label for="releaseDate">Release Date</label>
                <input type="date" name="releaseDate"  class="form-control" placeholder="Release Date">
              </div>
            </div>
            <div id="error_div">
              <?php if(isset($missingFieldError)){echo '<label class="text-danger">'.$missingFieldError.
                      '</label>';}
              ?>
            </div>
            <div class="row mt-3">
              <!--Add game submit button div  -->
              <div class="col-sm-6">
                  <button type="submit" class="btn btn-primary" name="addGame-submit">Add Game</button>
              </div>
            </div>
        </form>       
    </div>
    
    

    <div  class="d-flex justify-content-center mt-5 ms-5">
    <form class="form-group-row"  action="inc/deleteGame.inc.php" method="POST">
            <div class="row"><h1>Delete Game</h1></div>
            <div class="row">
              <!--Title div -->
              <div class="col">
                <label for="title">Title</label>
                <input type="text" name="title"  class="form-control" placeholder="Title">
              </div>  
            </div>
            <div id="error_div">
              <?php if(isset($missingFieldError)){echo '<label class="text-danger">'.$missingFieldError.
                      '</label>';}
              ?>
            </div>
            <div class="row mt-3">
              <!--Delete game submit button div  -->
              <div class="col-sm-6 mb-5">
                  <button type="submit" class="btn btn-primary" name="deleteGame-submit">Delete Game</button>
              </div>
            </div>
        </form>   
    </div>
    
    
    <div class="d-flex justify-content-center mt-5 ms-5 mb-5">
        <form class="form-group-row"  action="inc/editGame.inc.php" method="POST">
            <div class="row"><h1>Edit game</h1></div>
            <div class="row">
              <!--Titme div -->
              <div class="col">
                <label for="oldTitle">Title</label>
                <input type="text" name="oldTitle"  class="form-control" placeholder="Title">
              </div>  
            </div>
            <div class="row">
              <!--Titme div -->
              <div class="col">
                <label for="changeTitle">New Title</label>
                <input type="text" name="changeTitle"  class="form-control" placeholder="New Title">
              </div>  
            </div>
            <div class="row">
                <!--Descreption div -->
                <div class="col">
                <label for="changeDescreption">New Descreption</label>
                <input type="text" name="changeDescreption"  class="form-control" placeholder="New Descreption">
              </div>
            </div>
            <div class="row">
              <!--Release date div -->
              <div class="col">
                <label for="changeReleaseDate">New Release Date</label>
                <input type="date" name="changeReleaseDate"  class="form-control" placeholder="Release Date">
              </div>
            </div>
            <div id="error_div">
              <?php if(isset($missingFieldError)){echo '<label class="text-danger">'.$missingFieldError.
                      '</label>';}
              ?>
            </div>
            <div class="row mt-3">
              <!--Edit game submit button div  -->
              <div class="col-sm-6">
                  <button type="submit" class="btn btn-primary" name="editGame-submit">Edit Game</button>
              </div>
            </div>
        </form>       
    </div>

    
  
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

</body>
</html>

<?php require_once('footer.php')?>