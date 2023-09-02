<?php
   $login= false;
    $showError = false;
    if($_SERVER["REQUEST_METHOD"] == "POST"){
      
     include 'partials/_dbconnect.php';        //making connection to database

     $username = $_POST["username"];
     $password = $_POST["password"];
     
     
         
      // $sql = "Select * from users where username = '$username' AND password = '$password' ";
      $sql = "Select * from users where username = '$username' " ;
      $result = mysqli_query($conn , $sql);
      $num = mysqli_num_rows($result);
      

      if($num == 1){
               while($row = mysqli_fetch_assoc($result)){
                if (password_verify($password, $row['password'])) {
                  $login = true;
                  session_start();
                  $_SESSION['loggedin'] = true;
                  $_SESSION['username'] = $username;
                 header("location: welcome.php");
               }

               else{
                $showError = "Invalid credentials";
               }
              
              }

      }

    

      else{
        $showError = "Invalid credentials";
       }
     
      
   
 
    }

?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
  </head>
  <body>
    <?php  require 'partials/_nav.php' ?>

    <?php

    if($login){
    echo ' <div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>Success!</strong> You are logged in.
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
        <h1 class="text-center">Welcome , to my Login page</h1>
        <form action = "/login/login.php" method="post">
   <div class="form-group col-md-6">
    <label for="username" class="form-label">Username</label>
    <input type="text" class="form-control" id="username"  name= "username" aria-describedby="emailHelp">
   
  </div>
  <div class="form-group col-md-6">
    <label for="password" class="form-label">Password</label>
    <input type="password" class="form-control" id="password" name= "password">
  </div>
 
  <br>
  <button type="submit" class="btn btn-primary">Login</button>
</form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js" integrity="sha384-Rx+T1VzGupg4BHQYs2gCW9It+akI2MM/mndMCy36UVfodzcJcF0GGLxZIzObiEfa" crossorigin="anonymous"></script>
  </body>
</html>