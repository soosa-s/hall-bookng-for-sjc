<?php
session_start();
include('includes/config.php');

if (isset($_POST['login'])) {
    $uname = mysqli_real_escape_string($con, $_POST['username']);
    $password = md5($_POST['inputpwd']); // Using MD5 because your DB stores passwords in MD5

    // Check login for tblusers (Normal Users)
    $stmt = $con->prepare("SELECT ID, UserName, UserType FROM tblusers WHERE UserName=? AND Password=?");
    $stmt->bind_param("ss", $uname, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($user = $result->fetch_assoc()) {
        $_SESSION['aid'] = $user['ID'];
        $_SESSION['uname'] = $user['UserName'];
        $_SESSION['utype'] = $user['UserType'];
        header("Location: services.php");
        exit();
    }

    // Check login for tbladmin (Admin Users)
    $stmt = $con->prepare("SELECT ID, AdminuserName, UserType FROM tbladmin WHERE AdminuserName=? AND Password=?");
    $stmt->bind_param("ss", $uname, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($admin = $result->fetch_assoc()) {
        $_SESSION['aid'] = $admin['ID'];
        $_SESSION['uname'] = $admin['AdminuserName'];
        $_SESSION['utype'] = $admin['UserType'];
        header("Location: admin/dashboard.php");
        exit();
    }

    // Check login for principal_father
    $stmt = $con->prepare("SELECT ID, username, usertype FROM principal WHERE username=? AND password=?");
    $stmt->bind_param("ss", $uname, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($principal = $result->fetch_assoc()) {
        $_SESSION['aid'] = $principal['ID'];
        $_SESSION['uname'] = $principal['username'];
        $_SESSION['utype'] = $principal['usertype'];
        header("Location: principal/principal.php"); // Redirect to principal dashboard
        exit();
    }

    // If no match is found, redirect back with an error
    $_SESSION['error'] = "Invalid Username or Password";
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Hall Booking System | Login</title>

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">

  <!-- Custom CSS -->
  <style>
    body {
        height: 100vh;
        background: linear-gradient(135deg, #007bff, #00d4ff);
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 20px;
        color: #fff;
    }

    .login-box {
        background: #ffffff;
        border-radius: 20px;
        padding: 40px;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3);
        max-width: 400px;
        width: 100%;
    }

    .login-box h1 {
        font-weight: bold;
        color: #007bff;
        text-align: center;
        margin-bottom: 20px;
    }

    .form-control:focus {
        border-color: #007bff;
        box-shadow: 0 0 12px rgba(0, 123, 255, 0.5);
    }

    .btn-primary {
        background-color: #007bff;
        border: none;
        width: 100%;
        padding: 10px;
        border-radius: 25px;
        transition: background 0.3s ease, transform 0.2s ease;
    }

    .btn-primary:hover {
        background-color: #0056b3;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0, 91, 187, 0.3);
    }

    .input-group-text {
        background: #007bff;
        color: #fff;
        border: none;
    }

    .footer-link {
        text-align: center;
        margin-top: 15px;
    }

    .footer-link a {
        color: #007bff;
        text-decoration: none;
        transition: color 0.3s ease;
    }

    .footer-link a:hover {
        color: #0056b3;
        text-decoration: underline;
    }

    /* Password Visibility Toggle */
    .toggle-password {
        cursor: pointer;
    }
  </style>
</head>

<body>
<div class="login-box">
    <h1>Hall Booking Login</h1>
    <p class="text-center">Sign in to start your session</p>

    <form method="post">
        <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <div class="input-group">
                <input type="text" class="form-control" id="username" name="username" placeholder="Enter your username" required>
                <span class="input-group-text">
                    <i class="fas fa-user"></i>
                </span>
            </div>
        </div>

        <div class="mb-3">
            <label for="inputpwd" class="form-label">Password</label>
            <div class="input-group">
                <input type="password" class="form-control" id="inputpwd" name="inputpwd" placeholder="Enter your password" required>
                <span class="input-group-text toggle-password" onclick="togglePasswordVisibility()">
                    <i class="fas fa-eye"></i>
                </span>
            </div>
        </div>

        <button type="submit" class="btn btn-primary" name="login">Sign In</button>

    </form>
</div>

<!-- Password Toggle Script -->
<script>
    function togglePasswordVisibility() {
        const passwordInput = document.getElementById('inputpwd');
        const icon = document.querySelector('.toggle-password i');

        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            icon.classList.remove('fa-eye');
            icon.classList.add('fa-eye-slash');
        } else {
            passwordInput.type = 'password';
            icon.classList.remove('fa-eye-slash');
            icon.classList.add('fa-eye');
        }
    }
</script>

<!-- Bootstrap JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>