<?php
$showalert = false;
$showerror = false;
if($_SERVER["REQUEST_METHOD"] == "POST"){
    include "external/_dbconnect.php";

    $firstname = $_POST["firstname"];
    $lastname = $_POST["lastname"];
    $yearofbatch = $_POST["yearofbatch"];
    $registration_num = $_POST["registration_num"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $cpassword = $_POST["cpassword"];

    //checking whether registration_num exists
    $existsql = "SELECT * FROM `users` WHERE registration_num='$registration_num'";
    $result = mysqli_query($conn, $existsql); //fetching result from database
    $numexistrows = mysqli_num_rows($result);
    if($numexistrows > 0){
        //$exist = true; registration_num exists..
          $showerror =" registration_num already exist. Please try another.";

    }
    else{
        //$exist = false; registration_num doesnt exist but...
          if($password == $cpassword){
            $hash = password_hash($password, PASSWORD_DEFAULT);//Verifies that the given hash matches the given password.
            $sql = "INSERT INTO `users` (`firstname`, `lastname`, `yearofbatch`, `registration_num`, `email`, `password`) VALUES ('$firstname', '$lastname', '$yearofbatch', '$registration_num', '$email','$hash')";
            //$sql = "INSERT INTO `users` ( `registration_num`, `password`, `date`) VALUES ( '$registration_num', '$hash', current_timestamp())";
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
		<h4 class="card-title mt-3 text-center">Create Account</h4>
		<p class="text-center">Get started with your free account</p>
		<p>
			<a href="#" class="btn btn-block btn-twitter"> <i class="fab fa-twitter"></i>   Login via Twitter</a>
			<a href="#" class="btn btn-block btn-facebook"> <i class="fab fa-facebook-f"></i>   Login via facebook</a>
		</p>
		<p class="divider-text">
			<span class="bg-light">OR</span>
		</p>
		<form name="register" action="/vaccination/signup.php" onsubmit="return validateForm()" method="post"  >


    <div class="form-group input-group mb-3">
      <div class="input-group mb-3">
        <span class="input-group-text"> <i class="fa fa-user"></i> </span>
       </div>
      <input name="firstname" maxlength="11" id ="firstname" class="form-control" placeholder="Firstname" type="text" required>
    </div>

    <div class="form-group input-group mb-3">
      <div class="input-group mb-3">
        <span class="input-group-text"> <i class="fa fa-user"></i> </span>
       </div>
      <input name="lastname" maxlength="11" id ="lastname" class="form-control" placeholder="Lastname" type="text" required>
    </div>

    <div class="form-group input-group mb-3">
      <div class="input-group mb-3">
        <span class="input-group-text"> <i class="fa fa-user"></i> </span>
       </div>
      <input name="yearofbatch"  id ="yearofbatch" class="form-control" placeholder="Year Of Batch" type="month" required>
    </div>

    <div class="form-group input-group mb-3">
      <div class="input-group mb-3">
        <span class="input-group-text"> <i class="fa fa-user"></i> </span>
       </div>
      <input name="registration_num" maxlength="16" id ="registration_num" class="form-control" placeholder="Registration Number" type="text" required>
    </div>



    <div class="form-group input-group mb-3">
      <div class="input-group mb-3">
        <span class="input-group-text"> <i class="fa fa-user"></i> </span>
       </div>
      <input name="email"  id ="email" class="form-control" placeholder="E-mail" type="email" required>
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
		<div class="form-group mb-3 d-grid gap-2 col-6 mx-auto" id="button">
			<button type="submit" class="btn btn-primary btn-block"> Create Account  </button>
		</div>
		<p class="text-center">Have an account? <a href="/vaccination/login.php">Log In</a> </p>
	</form>
	</article>
</div>
</div>

<!-- Optional JavaScript; choose one of the two! -->

<!-- Option 1: Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>


<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
<script type="text/javascript">

function validateForm(){
    var registration_num = document.getElementById('registration_num').value;
    var firstname = document.getElementById('firstname').value;
    var lastname = document.getElementById('lastname').value;
    var yearofbatch = document.getElementById('yearofbatch').value;
     var registration_num = document.getElementById('registration_num').value;
     var phonenumber = document.getElementById('phonenum').value;
    var email = document.getElementById('email').value;


    if(registration_num == ""){
     alert("registration_num must be filled out");
       return false;
    }

    if(firstname == ""){
     alert("First Name must be filled out");
       return false;
    }
    if(firstname.length>=20){
      alert("First Name must be between 20 characters.");
        return false;
    }

   if(lastname == ""){
   alert("Last Name must be filled out");
   return false;
   }
   if(lastname.length>=20){
     alert("Last Name must be between 20 characters.");
     return false;
   }
    if(yearofbatch == ""){
      alert("Date of Birth must be filled out");
      return false;
    }

   if(email == ""){
   alert("EMail must be filled out");
   return false;
   }
   if(email.indexOf('@') <= 0){
     alert("Invalid Mail Structure.");
     return false;
   }
   if((mail.charAt(email.length-4)!='.') && (email.charAt(email.length-3!='.'))){
       alert("Invalid Mail Structure.");
       return false;
   }

   if(phonenumber == ""){
   alert("Phone Number must be filled out");
   return false;
   }
   if(phonenumber.length!=10){
   alert("Phone Number must be 10 digits.");
   return false;
   }
}

</script>
</body>

</html>
