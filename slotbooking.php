<?php
session_start();
 if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!= true){
      header("location: login.php");
      exit;
    }
 ?>
 <?php

   if($_SERVER['REQUEST_METHOD']=='POST'){
    include 'external/_dbconnect.php';
      $username=$_SESSION['$username'];
      $location = $_POST['location'];
      $date = $_POST['date'];
      $time = $_POST['time'];
      $sql="INSERT INTO `slotbooking` ( `username`, `location`, `dateofvaccination`, `time`) VALUES ( '$username', '$location', '$date', '$time')";
      $result = mysqli_query($conn,$sql);
      header("location: slotdetails.php");
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
     <title>Reserve Slot <?php $_SESSION['$username']?></title>
   </head>
   <body>
   <?php require 'external/_nav.php' ?>
   <div class="alert alert-success" role="alert">
  <h4 class="alert-heading">Well done!</h4>
  <p>Aww yeah, you have sucessfully registerd yourself . Its our duty to get prepare for the devastating environment we are surrounded all together. Let's be together.</p>
  <hr>
  <p class="mb-0">Please book the slot as preffereble time and make sure you get vaccinated.</p>
</div>

  <div class="card border-light mb-3" >
     <article class="card-body mx-auto" style="max-width: 500px;">
  <div class="card-header">Book Slot On Preference</div>

  <div class="card-body">

    <form action="/vaccination/slotbooking.php"  method="post">
      <div class="form-group input-group mb-3">
      <div class="input-group mb-3">
      <span class="input-group-text" ><i class="fa fa-location-arrow"></i></span>
      <select class="form-control" name="location" id="location">
          <option selected="">Select Centre </option>
          <option>Coochbehar</option>
          <option>siliguri</option>
          <option>Alipurduar</option>
          <option>Maldah</option>
      </select>
      </div>

      <div class="form-group input-group mb-3">
  			<div class="input-group mb-3">
  				<span class="input-group-text"> <i class="fa fa-calendar"></i> </span>
  			<input name="date" id ="date" class="form-control"  type="date">
  		</div>
      <div class="form-group input-group mb-3">
  			<div class="input-group mb-3">
  				<span class="input-group-text"> <i class="far fa-clock"></i> </span>
  			<input type="time" name="time" id ="time" class="form-control">
  		</div>

        <div class="form-group mb-3 d-grid gap-2 col-6 mx-auto" id="button">
    			<button type="submit" class="btn btn-primary btn-block">Submit </button>
    		</div>

		</form>

  </div>
</div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <?php require 'external/footer.php' ?>
  </body>
</html>
