<?php
include "../includes/head.php";
include "../includes/db_conn.php";
session_start(); 
$username = $_SESSION['username'];
    $email_query = "SELECT email FROM users WHERE username = '$username'";
    $email_result = mysqli_query($conn, $email_query);
    if($email_result && mysqli_num_rows($email_result) > 0) {
        $row = mysqli_fetch_assoc($email_result);
        // Fetch the email
        $signin_email = $row['email'];
    } else {
        // Handle error if email is not found
        $signin_email = "Email not found";
    }
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST["enter_otp"])) {
        $entered_otp = mysqli_real_escape_string($conn, $_POST['enter_otp']);
        $check_query = "SELECT email, verification_code FROM users WHERE username='$username'";
        $result = mysqli_query($conn, $check_query);
        
        if(mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $stored_otp = $row['verification_code'];
            $user_email = $row['email'];
            
            if ($entered_otp == $stored_otp) {
                $update_query = "UPDATE users SET status = 2 WHERE username = '$username'";
                if(mysqli_query($conn, $update_query)) {
                    header("Location: ../login.php");
                    exit;
                } else {
                    header("Location: enter_otp_seller.php?error=Your email is not verified. Please try again.");
                    exit;
                }
            } else {
                header("Location: enter_otp_seller.php?error=Invalid OTP. Please try again.");
            }
        } else {
            header("Location: enter_otp_seller.php?error=Invalid Username");
        } 
    } else {
        $error = "Please enter OTP.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        body {
            height: 100%;
            margin: 0;
            display: flex;
            justify-content: center;
        }
        .container {
            width: 50%;
        }
        button {
            width: 100%;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center mb-4">OTP</h2>
        <!-- Display error message if present -->
        <?php if(isset($error)): ?>
            <div class="alert alert-danger text-center" role="alert">
                <?php echo htmlspecialchars($error); ?>
            </div>
        <?php endif; ?>
                <!-- Display error message if present -->
        <?php if(isset($_GET['error'])): ?>
            <div class="alert alert-danger text-center" role="alert">
                <?php echo htmlspecialchars($_GET['error']); ?>
            </div>
        <?php endif; ?>
        <!-- Display success message if present -->
        <?php if(isset($_GET['success'])): ?>
            <div class="alert alert-success text-center" role="alert">
                <?php echo htmlspecialchars($_GET['success']);  ?>
            </div>
        <?php endif; ?>

        <form action="" method="post">
            <div class="form-group">
                <!-- Display the email on the form -->
                <label for="otp">Enter OTP sent to <?php echo $signin_email; ?></label>
                <input type="text" class="form-control" id="otp" name="enter_otp" required>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</body>
</html>
