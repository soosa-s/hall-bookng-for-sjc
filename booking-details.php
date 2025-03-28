<?php session_start();
// Database Connection
include('includes/config.php');

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <title>Hall Booking System || Booking Status</title>
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

<body data-spy="scroll" data-target=".site-navbar-target" data-offset="300">

  <div class="site-wrap">

  


    
    <?php include_once("includes/navbar.php");?>
    
    <div class="intro-section" style="background-image: url('images/hero_2.jpeg');">
        <div class="container">
          <div class="row align-items-center">
            <div class="col-lg-7 mx-auto text-center" data-aos="fade-up">
              <h1>Booking Details</h1>
              <p><a href="contact.php" class="btn btn-primary py-3 px-5">Contact</a></p>
            </div>
          </div>
        </div>
      </div>
    
    <div class="site-section">
      <div class="container">
        <div class="row">





<div class="col-md-12">
<table id="example1" class="table table-bordered table-striped">
       
                  <tbody>
<?php $bid=base64_decode($_GET['bid']);
$eml=base64_decode($_GET['eml']);
$pno=base64_decode($_GET['pno']);
$query=mysqli_query($con,"select tblbookings.*, tblhall.ID,tblhall.HallName from tblbookings join tblhall on tblhall.ID=tblbookings.HallID  where tblbookings.ID='$bid' and tblbookings.EmailId='$eml' and tblbookings.PhoneNumber='$pno'");
$cnt=1;
while($result=mysqli_fetch_array($query)){
?>


       <tr>
                  <th>Booking Number</th>
                    <td colspan="3"><?php echo $result['BookingNumber']?></td>
                  </tr>

                  <tr>
                  <th> Name</th>
                    <td><?php echo $result['FullName']?></td>
                    <th>Email Id</th>
                   <td> <?php echo $result['EmailId']?></td>
                  </tr>
                  <tr>
                    <th> Mobile No</th>
                    <td><?php echo $result['PhoneNumber']?></td>
                    <th>dept</th>
                    <td><?php echo $result['dept']?></td>
                  </tr>
                  <tr>
                    <th>Booking Date</th>
                  
                   <td><?php echo date('d-m-Y ', strtotime($result['BookingDateFrom']))?></td>
                   <th>Booking Time</th>
                   <td><?php echo $result['BookingTime']?> -<?php echo $result['EndingTime']?></td>               
                 </tr>
                 <tr>
                  <th>Posting Date</th>
                  <td><?php echo date('d-m-Y ', strtotime($result['postingDate']))?></td>
                    <th>Hall Name</th>
                    <td ><?php echo $result['HallName']?>  <a href='hall-details.php?bid=<?php echo $result['HallID']; ?>' target="blank"> View Details</a></td>
                  </tr>

 


            <tr>
                  <th>Booking  Status</th>
                    <td><?php if($result['BookingStatus']==''): ?>
<span class="badge bg-warning text-dark">Not Processed Yet</span>
                  <?php elseif($result['BookingStatus']=='Accepted'): ?>
                    <span class="badge bg-success">Accepted</span>
                    <?php elseif($result['BookingStatus']=='Rejected'): ?>
                      <span class="badge bg-danger">Rejected</span>
                    <?php endif;?></td>
                 
      <tr>



         <?php $cnt++;} ?>
             
                  </tbody>
     
                </table>

              </div>


        </div>
      </div>
    </div>
    

    <div class="site-section bg-image overlay" style="background-image: url('images/hero_2.jpeg');">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-md-7 text-center">
            <h2 class="text-white">Get In Touch With Us</h2>
            <p class="mb-0"><a href="contact.php" class="btn btn-warning py-3 px-5 text-white">Contact Us</a></p>
          </div>
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
  <script type="text/javascript">
        $(".datepicker").datepicker({
            format: "yyyy-mm-dd",
        });
    </script>

</html>