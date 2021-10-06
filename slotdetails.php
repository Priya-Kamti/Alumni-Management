<?php
session_start();
 if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!= true){
      header("location: login.php");
      exit;
    }
 ?>
<?php    include 'external/_dbconnect.php';   ?>

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

<div class="container">
  <div class="card border-light mb-3" >
    <article class="card-body mx-auto" style="max-width: 500px;">
      <h4 class="card-title mt-3 text-center">Slot Details for Visit.</h4>

   <div class="card-body">


     <table class="table">
 <thead>
   <tr>
     <th scope="col">Booking Id</th>
     <th scope="col">First Name</th>
     <th scope="col">Last Name</th>
     <th scope="col">Client Age</th>
     <th scope="col">Mobile No</th>
     <th scope="col">Center For Vaccination</th>
     <th scope="col" >Date of Vaccination</th>
     <th scope="col">Time for Vaccination</th>
   </tr>
 </thead>
 <tbody>

   <?php
       $sql= "SELECT slotbooking.*, users.* FROM users , slotbooking WHERE users.username= '".$_SESSION['$username']."' AND users.username=slotbooking.username";
       $result = mysqli_query($conn, $sql);
       $num = mysqli_num_rows($result);

          if($num > 0){
           $row=mysqli_fetch_assoc($result);
           $age=date_diff(date_create($row['dateofbirth']),date_create('today'))->y;
      ?>


   <tr>
     <td><?php  echo $row['bookingid']?></td>
     <td><?php  echo $row['firstname']?></td>
     <td><?php  echo $row['lastname']?></td>
     <td><?php  echo $age ?></td>
     <td><?php  echo $row['phonenum']?></td>
     <td><?php  echo $row['location']?></td>
     <td><?php  echo $row['dateofvaccination']?></td>
     <td><?php  echo $row['time']?></td>
   </tr>
   <?php
   }
   ?>

 </tbody>
</table>

   </div>
</div>
</div>

   <!-- Optional JavaScript; choose one of the two! -->

   <!-- Option : Bootstrap Bundle with Popper -->
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

   <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

 </body>
</html>
