<?php 
session_start();
include('includes/config.php');

// Redirect if user is not logged in
if (!isset($_SESSION['aid']) || empty($_SESSION['aid'])) { 
    header('location:index.php');
    exit();
} 
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <title>Hall Booking System || Home Page</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <link href="https://fonts.googleapis.com/css?family=Oswald:400,700|Dancing+Script:400,700|Muli:300,400" rel="stylesheet">
  <link rel="stylesheet" href="fonts/icomoon/style.css">

  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/jquery-ui.css">
  <link rel="stylesheet" href="css/owl.carousel.min.css">
  <link rel="stylesheet" href="css/owl.theme.default.min.css">
  <link rel="stylesheet" href="css/jquery.fancybox.min.css">
  <link rel="stylesheet" href="css/bootstrap-datepicker.css">
  <link rel="stylesheet" href="fonts/flaticon/font/flaticon.css">
  <link rel="stylesheet" href="css/aos.css">
  <link href="css/jquery.mb.YTPlayer.min.css" media="all" rel="stylesheet" type="text/css">
  <link rel="stylesheet" href="css/style.css">

</head>
<body>

<div class="site-wrap">
  
  <?php include_once("includes/navbar.php"); ?>

  <div class="hero-slide owl-carousel site-blocks-cover">
    <div class="intro-section" style="background-image: url('images/hero_1.jpeg');">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-lg-7 ml-auto text-right">
            <h1>Explore, Discover The College</h1>
          </div>
        </div>
      </div>
    </div>

    <div class="intro-section" style="background-image: url('images/hero_2.jpeg');">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-lg-7 mx-auto text-center">
            <h1>Welcome to Our Hall Booking System</h1>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- About Section -->
  <div class="site-section">
    <div class="container">
      <div class="row">
        <div class="col-md-6">
          <img src="images/hero_2.jpeg" alt="Welcome to Hall Booking System" 
               class="img-fluid" style="width: 100%; height: 400px; object-fit: cover;">
        </div>
        <div class="col-md-6">
          <h3 class="heading-92913 text-black">Welcome To Our Website</h3>
          <p class="text-black">
            The Hall Booking System is designed to simplify the reservation process for college halls,
            ensuring smooth scheduling for events, seminars, and meetings. 
          </p>
          <p class="text-black">
            Developed using PHP and MySQL, our system offers a secure and efficient platform to manage hall bookings
            for faculty members, staff, and administrators. Enjoy a user-friendly experience for hassle-free reservations!
          </p>
        </div>
      </div>
    </div>
  </div>

  <?php include_once("includes/footer.php"); ?>

</div>
<!-- .site-wrap -->

<!-- Loader -->
<div id="loader" class="show fullscreen">
  <svg class="circular" width="48px" height="48px">
    <circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/>
    <circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#ff5e15"/>
  </svg>
</div>

<!-- Scripts -->
<script src="js/jquery-3.3.1.min.js"></script>
<script src="js/jquery-migrate-3.0.1.min.js"></script>
<script src="js/jquery-ui.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/owl.carousel.min.js"></script>
<script src="js/jquery.stellar.min.js"></script>
<script src="js/jquery.countdown.min.js"></script>
<script src="js/bootstrap-datepicker.min.js"></script>
<script src="js/jquery.easing.1.3.js"></script>
<script src="js/aos.js"></script>
<script src="js/jquery.fancybox.min.js"></script>
<script src="js/jquery.sticky.js"></script>
<script src="js/jquery.mb.YTPlayer.min.js"></script>
<script src="js/main.js"></script>

</body>
</html>
