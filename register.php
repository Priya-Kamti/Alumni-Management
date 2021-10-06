<?php
$showalert = false;
$showerror = false;
if($_SERVER["REQUEST_METHOD"] == "POST"){
    include "external/_dbconnect.php";
    $username = $_POST["username"];
    $password = $_POST["password"];
    $cpassword = $_POST["cpassword"];

    //checking whether username exists
    $existsql = "SELECT * FROM `usercred` WHERE username='$username'";
    $result = mysqli_query($conn, $existsql); //fetching result from database
    $numexistrows = mysqli_num_rows($result);
    if($numexistrows > 0){
        //$exist = true; username exists..
          $showerror =" Username already exist. Please try another.";

    }
    else{
        //$exist = false; username doesnt exist but...
          if($password == $cpassword){
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $sql = "INSERT INTO `usercred` ( `username`, `password`, `date`) VALUES ( '$username', '$hash', current_timestamp())";
            $result = mysqli_query($conn, $sql);
            if($result){
              $showalert = true;
            }
          }
          else{
            $showerror =" Passwords do not match. Try again.";
          }
  }
}
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://use.fontawesome.com/releases/v5.13.0/css/all.css" rel="stylesheet" id="fontawesome-css">
    <link rel="stylesheet" href="css/style.css">
    <title>Sign Up</title>
  </head>
  <body>
  <?php require 'external/_nav.php' ?>
  <?php
  if($showalert){
  echo'
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Info:"><use xlink:href="#info-fill"/></svg>
      <strong>SUCESS!</strong> You can proceed to registration now.
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';}
  if($showerror){
  echo'
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
      <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Info:"><use xlink:href="#info-fill"/></svg>
      <strong>ERROR!</strong> '.$showerror.'
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';}
  ?>
  <div class="container">
  <div class="card bg-light my-4">
  	<article class="card-body mx-auto" style="max-width: 400px;">
      <h4 class="card-title mt-3 text-center">User credentials</h4>
      <p class="divider-text bg-light mt-2">

    </p>
<!-------->
<form action="/vaccination/register.php"  method="post">
<div class="form-group input-group mb-3">
  <div class="input-group mb-3">
    <span class="input-group-text"> <i class="fa fa-user"></i> </span>
   </div>
  <input name="username" maxlength="11" id ="username" class="form-control" placeholder="@username" type="text">
</div>


		<div class="form-group input-group mb-3">
			<div class="input-group mb-3">
				<span class="input-group-text"> <i class="fa fa-lock"></i> </span>
			</div>
			<input class="form-control" id="password" name="password" placeholder="Create password" type="password">
		</div>
    <div class="form-group input-group mb-3">
      <div class="input-group mb-3">
        <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
      </div>
      <input class="form-control" id="cpassword" name="cpassword"placeholder="Repeat password" type="password">
    </div>
<div class="form-group mb-3 d-grid gap-2" id="button">
  <button type="submit" class="btn btn-primary btn-block"> Set Credentials  </button>
</div>
<!------------>

<!--
<div class="container my-4">
  <h1 class="text-center"> Register Your Details</h1>
  <form action="/vaccination/register.php" method="post">
  <div class="mb-3 col-md-6">
    <label for="username" class="form-label">Username</label>
    <input type="text" class="form-control" id="username" name="username"  aria-describedby="username">

  </div>
  <div class="mb-3 col-md-6">
    <label for="firstname" class="form-label">First name</label>
    <input type="text" class="form-control" id="firstname"  name="firstname">
  </div>
  <div class="mb-3 col-md-6">
    <label for="lastname" class="form-label">Last name</label>
    <input type="text" class="form-control" id="lastname"  name="lastname">
  </div>

  <div class="mb-3 col-md-6">
    <label for="dateofbirth" class="form-label">dateofbirth</label></label>
    <input type="text" class="form-control" id="dateofbirth" name="dateofbirth" aria-describedby="dateofbirth">
  </div>

  <div class="mb-3 col-md-6">
    <label for="aadharnum" class="form-label">Aadhar Num</label>
    <input type="text" class="form-control" id="aadharnum"  name="aadharnum">
  </div>

  <div class="mb-3 col-md-6">
    <label for="phonenum" class="form-label">Mobile number</label>
    <input type="text" class="form-control"  id="phonenum" name="phonenum" aria-describedby="phonenum">

  </div>
  <div class="mb-3 col-md-6">
      <label for="email" class="form-label">Email address</label>
      <input type="email" class="form-control" id="email" name="email">

    </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
<!-code chnages here>

    <!- Optional JavaScript; choose one of the two! -->



    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
<!--footer section-->

  </body>
</html>
