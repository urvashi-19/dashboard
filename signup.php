<?php
    $showAlert = false;
    $showError = false;
    if($_SERVER["REQUEST_METHOD"] == "POST"){
      
     include 'partials/_dbconnect.php';        //making connection to database

     $username = $_POST["username"];
     $password = $_POST["password"];
     $cpassword = $_POST["cpassword"];
    //  $exists=false;

     $existSql = "SELECT * FROM `users` WHERE username = '$username'";
     $result = mysqli_query($conn , $existSql); // to make query run 
     $numExistRows = mysqli_num_rows($result);
     if($numExistRows > 0){
      // $exists = true;
      $showError = " Username already exsist";
     }
     else{
        //  $exists=false;
      if(($password == $cpassword) ){
        $hash = password_hash($password , PASSWORD_DEFAULT);
         
        $sql = "INSERT INTO `users` ( `username`, `password`, `dt`)
         VALUES ( '$username', '$hash', current_timestamp()) ";
  
        $result = mysqli_query($conn , $sql);   // to make query run;
  
        if($result){
                 $showAlert = true;
        }
  
      }

      else{
        $showError = "passwords do not match ";
       }
     }
     

      
     
      
   
 
    }

?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Signup Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
  </head>
  <body>
    <?php  require 'partials/_nav.php' ?>

    <?php

    if($showAlert){
    echo ' <div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>Success!</strong> You account is now created and you can login.
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>' ;

    }

    if($showError){
      echo ' <div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Error!</strong>'. $showError .'
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>' ;
  
      }

?>

  
    <div class="container">
        <h1 class="text-center">Welcome , to my signup page</h1>
        <form action = "/login/signup.php" method="post">
   <div class="form-group col-md-6">
    <label for="username" class="form-label">Username</label>
    <input type="text" class="form-control" id="username" maxlength= "11" name= "username" aria-describedby="emailHelp">
   
  </div>
  <div class="form-group col-md-6">
    <label for="password" class="form-label">Password</label>
    <input type="password" class="form-control" id="password" maxlength= "23" name= "password">
  </div>
  <div class="form-group col-md-6">
    <label for="cpassword" class="form-label">Confirm Password</label>
    <input type="password" class="form-control" id="cpassword" maxlength= "23" name= "cpassword">
  </div>
  <br>
  <button type="submit" class="btn btn-primary">Signup</button>
</form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js" integrity="sha384-Rx+T1VzGupg4BHQYs2gCW9It+akI2MM/mndMCy36UVfodzcJcF0GGLxZIzObiEfa" crossorigin="anonymous"></script>
  </body>
</html>