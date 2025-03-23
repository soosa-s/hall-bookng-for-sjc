<?php 
session_start();
include('includes/config.php');

if(isset($_POST['submit'])){
    $hallid = $_GET['bid'];
    $fname = htmlspecialchars($_POST['fname']);
    $emailid = filter_var($_POST['emailid'], FILTER_VALIDATE_EMAIL);
    $phonenumber = preg_replace('/[^0-9]/', '', $_POST['phonenumber']);
    $bookingdatefrom = $_POST['bookingdatefrom'];
    $bookingtime = $_POST['bookingtime'];
    $endingtime = $_POST['endingtime'];
    $dept = htmlspecialchars($_POST['dept']);
    $purpose = htmlspecialchars($_POST['purpose']);
    $bno = mt_rand(100000000, 9999999999);

    if(!$emailid) {
        echo "<script>alert('Invalid email format. Please try again.');</script>";
        exit();
    }

    // Check if the hall is available for the selected date and time slot
    $stmt = $con->prepare("SELECT BookingTime, EndingTime FROM tblbookings 
        WHERE HallID = ? 
        AND BookingStatus = 'Accepted' 
        AND BookingDateFrom = ?");
    $stmt->bind_param("is", $hallid, $bookingdatefrom);
    $stmt->execute();
    $result = $stmt->get_result();

    $bookedSlots = [];
    while($row = $result->fetch_assoc()) {
        $bookedSlots[] = [
            'start' => strtotime($row['BookingTime']),
            'end' => strtotime($row['EndingTime'])
        ];
    }
    $stmt->close();

    // Check if new booking overlaps with any booked slots
    $requestedStart = strtotime($bookingtime);
    $requestedEnd = strtotime($endingtime);

    $isOverlap = false;
    foreach($bookedSlots as $slot) {
        if (($requestedStart < $slot['end']) && ($requestedEnd > $slot['start'])) {
            $isOverlap = true;
            break;
        }
    }

    if(!$isOverlap){
        // Insert Booking Data
        $stmt = $con->prepare("INSERT INTO tblbookings (HallID, BookingNumber, FullName, EmailId, PhoneNumber, BookingDateFrom, BookingTime, EndingTime, dept, purpose) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("isssssssss", $hallid, $bno, $fname, $emailid, $phonenumber, $bookingdatefrom, $bookingtime, $endingtime, $dept, $purpose);
        $query = $stmt->execute();
        $stmt->close();

        if($query){
            echo "<script>alert('Your hall booking request has been sent successfully. Booking number is $bno');</script>";
            echo "<script type='text/javascript'> document.location = 'services.php'; </script>";
        } else {
            echo "<script>alert('Something went wrong. Please try again.');</script>";
        }
    } else {
        // Suggest Available Timings
       // Suggest Available Timings
$availableSlots = [];
$openingTime = strtotime("08:30");
$closingTime = strtotime("18:30");

// Sort booked slots by start time
usort($bookedSlots, function($a, $b) {
    return $a['start'] - $b['start'];
});

// Add slot before the first booking
if ($bookedSlots[0]['start'] > $openingTime) {
    $availableSlots[] = date("H:i", $openingTime) . " - " . date("H:i", $bookedSlots[0]['start']);
}

// Add gaps between booked slots
for ($i = 0; $i < count($bookedSlots) - 1; $i++) {
    if ($bookedSlots[$i]['end'] < $bookedSlots[$i + 1]['start']) {
        $availableSlots[] = date("H:i", $bookedSlots[$i]['end']) . " - " . date("H:i", $bookedSlots[$i + 1]['start']);
    }
}

// Add slot after the last booking
if ($bookedSlots[count($bookedSlots) - 1]['end'] < $closingTime) {
    $availableSlots[] = date("H:i", $bookedSlots[count($bookedSlots) - 1]['end']) . " - " . date("H:i", $closingTime);
}

// Display Suggested Timings
if (!empty($availableSlots)) {
    $suggestedTimings = implode(", ", $availableSlots);
    echo "<script>alert('Hall is not available for this time slot. Suggested timings are: $suggestedTimings');</script>";
} else {
    echo "<script>alert('The hall is fully booked. Please choose a different date.');</script>";
}}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Hall Booking System | Booking Page</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <!-- Bootstrap CSS -->
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


    <!-- Custom CSS -->
    <style>
        body {
            background-color: #f0f8ff;
            font-family: 'Arial', sans-serif;
        }

        .booking-form {
            background: #ffffff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .booking-form:hover {
            transform: scale(1.02); 
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.3);
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #004080;
            transform: translateY(-3px);
        }

        .btn-warning {
            background-color: #ffc107;
            transition: background-color 0.3s ease;
        }

        .btn-warning:hover {
            background-color: #e0a800;
        }

        .img-hover {
            border-radius: 12px;
            padding-left: 100; /* Remove left padding */
            margin-left: -10px; /* Fine-tuned for alignment */
            object-fit: cover;
            margin-top: -200px; /* Slightly move the image upward */
}
        .img-hover:hover {
            transform: scale(1.05);
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.3);
        }

    

        .form-control:focus {
            border-color: #007bff;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
        }

        .contact-section {
            background-color: #ffefd5;
            padding: 80px 0;
        }
    </style>
</head>
<body>

<?php include_once("includes/navbar.php");?>
<br>
<br>
<br>
<br>
<div class="container mt-6">
    <h2 class="text-center mb-4 text-primary fw-bold">Book A Hall</h2>
   
        
        <div class="row justify-content-center">
            <div class="col-md-7">
                <div class="booking-form">
                    <h3 class="text-center mb-4">Hall Booking Form</h3>
                    <form method="post">
                        <div class="mb-3">
                            <label class="form-label">Full Name</label>
                            <input type="text" name="fname" class="form-control" required>
                        </div>

                    <div class="mb-3">
                        <label class="form-label">Department:</label>
                        <input type="text" class="form-control" name="dept" required>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Date From:</label>
                            <input type="date" class="form-control" name="bookingdatefrom" required>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label class="form-label">Start Time:</label>
                            <input type="time" class="form-control" name="bookingtime" required>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label class="form-label">End Time:</label>
                            <input type="time" class="form-control" name="endingtime" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Email Address:</label>
                        <input type="email" class="form-control" name="emailid" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Phone Number:</label>
                        <input type="text" class="form-control" name="phonenumber" maxlength="10" pattern="[0-9]+" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Purpose:</label>
                        <textarea class="form-control" name="purpose" rows="3" required></textarea>
                    </div>

                    <button type="submit" name="submit" class="btn btn-primary w-100">Book Now</button>
                </form>
            </div>
        </div>
    </div>
</div>


<div class="contact-section text-center mt-5">
    <h3 class="text-dark">Get In Touch With Us</h3>
    <p class="mb-3">If you have any queries, feel free to contact us.</p>
    <a href="contact.php" class="btn btn-warning">Contact Us</a>
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
