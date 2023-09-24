<?php

# Function file. 
function not_empty($field){
  if(isset($_POST[$field])){
    return 1;
  }else{
    echo'Field '. $field .' must not be empty';
    return 0;
  }
}

function not_empty_field($firstName, $lastName, $username, $email, $DoB, $password){
  if(empty($_POST[$firstName])||empty($_POST[$lastName]) || empty($_POST[$username]) || 
    empty($_POST[$email]) || empty($_POST[$DoB]) || empty($_POST[$password]))
    {
      return false;
    }else{
      return true;
    }
}
?>