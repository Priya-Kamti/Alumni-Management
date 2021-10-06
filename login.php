<?php
$login = false;
$showerror = false;
if($_SERVER["REQUEST_METHOD"] == "POST"){
    include "external/_dbconnect.php";
    $registration_num = $_POST["registration_num"];
    $password = $_POST["password"];
    //  $sql = "select * from users where registration_num='$registration_num' AND password='$password'";
    $sql = "select * from users where registration_num='$registration_num'";//fetch the registration_num from database..
      $result = mysqli_query($conn, $sql);// Performs a query on the database using the registration_num
      $num = mysqli_num_rows($result);  //gets the num of tuples or rows in the result
      if($num == 1){
        while($row=mysqli_fetch_assoc($result)){ // Fetch a result row as an associative array
              if(password_verify($password,$row['password'])){ //verifying password against the hash;
              $login = true;
              session_start();
              $_SESSION['loggedin'] = true;
              $_SESSION['$registration_num'] = $registration_num;
              header("location: slotbooking.php");
        }
        else{
          $showerror =" Invalid credentials";
        }
      }
      }
    else{
      $showerror =" Invalid credentials";
    }
}
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/style.css">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://use.fontawesome.com/releases/v5.13.0/css/all.css" rel="stylesheet" id="fontawesome-css">
    <link rel="stylesheet" href="css/style.css">
    <title>LogIn</title>
  </head>
  <body>
  <?php require 'external/_nav.php' ?>
  <?php
  if($login){
  echo'
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Info:"><use xlink:href="#info-fill"/></svg>
      <strong>SUCESS!</strong> You are logged in now.
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
<!--chnagesdonehere-->


<div class="container">
<div class="card bg-light my-4">
	<article class="card-body mx-auto" style="max-width: 400px;">
    <h4 class="card-title mt-3 text-center">Log Into Your Account</h4>
    <p class="divider-text bg-light mt-2">

    </p>
		<form action="/vaccination/login.php"  method="post">
		<div class="form-group input-group mb-3">
			<div class="input-group mb-3">
				<span class="input-group-text"><i class="fa fa-user"></i> </span>
			 </div>
			<input name="registration_num" maxlength="16" id ="registration_num" class="form-control" placeholder="Registration Number" type="text">
		</div>

		<div class="form-group input-group mb-3">
			<div class="input-group mb-3">
				<span class="input-group-text"> <i class="fa fa-lock"></i> </span>
			</div>
			<input class="form-control" id="password" name="password" placeholder="Password" type="password">
		</div>

		<div class="form-group input-group mb-3">
		<div class="form-group mb-3 d-grid gap-2 col-6 mx-auto" id="button">
			<button type="submit" class="btn btn-primary btn-block"> Log In  </button>
		</div>
		<p class="text-center">Haven't an account? <a href="/vaccination/signup.php">Sign Up</a> </p>
	</form>
	</article>
</div>
</div>




  <!--<div class="container my-4">
    <h1 class="text-center"> LogIn for Vaccine Registration</h1>
    <form action="/vaccination/login.php" method="post">
  <div class="mb-3 col-md-6">
    <label for="registration_num" class="form-label">registration_num</label>
    <input type="text" class="form-control" id="registration_num" name="registration_num" placeholder="@registration_num" aria-describedby="emailHelp">
    <div id="emailHelp" class="form-text">We'll never share your registration_num with anyone else.</div>
  </div>
  <div class="mb-3 col-md-6" >
    <label for="password" class="form-label">Password</label>
    <input type="password" class="form-control" id="password" name="password" placeholder="password">
  </div>

 <button type="submit" class="btn btn-primary">Sign Up</button>

</form>
  </div>
-->
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>


    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <?php require 'external/footer.php' ?>
  </body>
</html>
