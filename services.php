<?php session_start();
// Database Connection
include('includes/config.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <title>Hall Booking System || Services</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <link href="https://fonts.googleapis.com/css?family=Oswald:400,700|Dancing+Script:400,700|Muli:300,400" rel="stylesheet">
  <link rel="stylesheet" href="fonts/icomoon/style.css">

  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/jquery-ui.css">
  <link rel="stylesheet" href="css/owl.carousel.min.css">
  <link rel="stylesheet" href="css/owl.theme.default.min.css">
  <link rel="stylesheet" href="css/owl.theme.default.min.css">

  <link rel="stylesheet" href="css/jquery.fancybox.min.css">

  <link rel="stylesheet" href="css/bootstrap-datepicker.css">

  <link rel="stylesheet" href="fonts/flaticon/font/flaticon.css">

  <link rel="stylesheet" href="css/aos.css">
  <link href="css/jquery.mb.YTPlayer.min.css" media="all" rel="stylesheet" type="text/css">

  <link rel="stylesheet" href="css/style.css">



</head>
<style>

.bg-primary {
    background-color:rgb(43, 176, 216) !important; /* Custom Green Color */
}
  </style>

<body data-spy="scroll" data-target=".site-navbar-target" data-offset="300">

  <div class="site-wrap">

   <?php include_once("includes/navbar.php");?>
    



    
<?php

// Number of records per page
$limit = 6;

// Get the current page number from URL (if not present, default to 1)
if (isset($_GET['page']) && is_numeric($_GET['page'])) {
    $page = intval($_GET['page']);
} else {
    $page = 1;
}

// Calculate the offset for the SQL query
$offset = ($page - 1) * $limit;

// Fetch the total number of records
$total_query = mysqli_query($con, "SELECT COUNT(*) FROM tblhall");
$total_row = mysqli_fetch_array($total_query);
$total_records = $total_row[0];

// Calculate total pages
$total_pages = ceil($total_records / $limit);

// Fetch the halls for the current page with limit and offset
$query = mysqli_query($con, "SELECT * FROM tblhall LIMIT $limit OFFSET $offset");
?>
<br>
<br>
<br>
<div class="py-5">
  <div class="container">
    <div class="row justify-content-center mb-5">
      <div class="col-md-5 text-center">
        <span class="text-serif text-primary">Destination</span>
        <h3 class="heading-92913 text-black text-center">Our Destinations</h3>
      </div>
    </div>
    <div class="row">
      <?php while ($result = mysqli_fetch_array($query)) { ?>
        <div class="col-md-6 col-lg-4 mb-4">
          <div class="service-39381">
            <img src="admin/images/<?php echo $result['Image']; ?>" alt="Image" width="350" height="200">
            <div class="p-4">
              <div class="d-flex">
                <div class="mr-auto price">
                <span class="bg-primary"><?php echo $result['HallName']?></span>
                </div>
                <div class="ml-auto price">
                <a href="book-hall.php?bid=<?php echo $result['ID']; ?>" class="btn btn-primary" style="color:white;">
                Book</a>
                  </div>
                <div>
                  <span class="bg-primary"></span>
                </div>
              </div>
            </div>
          </div>
        </div>
      <?php }?>
    </div>

    <!-- Pagination Links -->
    <div class="pagination justify-content-center">
      <nav aria-label="Page navigation">
        <ul class="pagination">
          <!-- Previous Page Link -->
          <?php if ($page > 1): ?>
            <li class="page-item">
              <a class="page-link" href="?page=<?php echo $page - 1; ?>" aria-label="Previous">
                <span aria-hidden="true">&laquo;</span>
              </a>
            </li>
          <?php else: ?>
            <li class="page-item disabled">
              <span class="page-link">&laquo;</span>
            </li>
          <?php endif; ?>

          <!-- Page Numbers -->
          <?php for ($i = 1; $i <= $total_pages; $i++): ?>
            <li class="page-item <?php if ($i == $page) echo 'active'; ?>">
              <a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
            </li>
          <?php endfor; ?>

          <!-- Next Page Link -->
          <?php if ($page < $total_pages): ?>
            <li class="page-item">
              <a class="page-link" href="?page=<?php echo $page + 1; ?>" aria-label="Next">
                <span aria-hidden="true">&raquo;</span>
              </a>
            </li>
          <?php else: ?>
            <li class="page-item disabled">
              <span class="page-link">&raquo;</span>
            </li>
          <?php endif; ?>
        </ul>
      </nav>
    </div>
  </div>
</div>


    
 <?php include_once("includes/footer.php");?>
    

  </div>
  <!-- .site-wrap -->


  <!-- loader -->
  <div id="loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#ff5e15"/></svg></div>

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