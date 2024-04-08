<?php
session_start();
include "../includes/db_conn.php";

require '../smtp/vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if all fields are set
    if(isset($_POST["username"]) && isset($_POST["birthdate"]) && isset($_POST["phone_number"]) && isset($_POST["email"]) 
    && isset($_POST["street_address"]) && isset($_POST["password"])) {
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $company_name = mysqli_real_escape_string($conn, $_POST['company_name']);
        $birthdate = mysqli_real_escape_string($conn, $_POST['birthdate']);
        $phone_number = mysqli_real_escape_string($conn, $_POST['phone_number']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $street_address = mysqli_real_escape_string($conn, $_POST['street_address']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);
        $verification_code = generateOTP(6); // Generate a 6-digit OTP
        $password = password_hash($password, PASSWORD_DEFAULT);
        $status = 0;
        $join_date = date('Y-m-d');
        $_SESSION['signin_username'] = $username;
        $check_username_query = "SELECT * FROM users WHERE username='$username'";
        $check_email_query = "SELECT * FROM users WHERE email='$email'";
        $result_username = mysqli_query($conn, $check_username_query);
        $result_email = mysqli_query($conn, $check_email_query);

        if(mysqli_num_rows($result_username) > 0) {
            header("location:../buyer_signup.php?error=Error: Username already taken.");
            exit;
        } elseif(mysqli_num_rows($result_email) > 0) {
            header("location:../buyer_signup.php?error=Error: Email already taken.");
            exit;
        }

        $sql = "INSERT INTO users (username, company_name, birthdate, phone_number, email, street_address, password, status, join_date, verification_code) 
        VALUES ('$username', '$company_name', '$birthdate', '$phone_number', '$email', '$street_address', '$password', '$status', '$join_date', '$verification_code')";
        if(mysqli_query($conn, $sql)) {
            // Send verification email
            $userMail = new PHPMailer(true);
            $userMail->isSMTP();
            $userMail->Host = "smtp.hostinger.com";
            $userMail->SMTPAuth = true;
            $userMail->Username = "info@we-thrift.com";
            $userMail->Password = "TdEFeyv+ju8*";
            $userMail->SMTPSecure = 'ssl';
            $userMail->Port = 465;
            $userMail->setFrom("info@we-thrift.com", "Veify Email");
            $userMail->addAddress($email);
            $userMail->isHTML(true);
            $userMail->Subject = "Email Verification";
            $userMail->Body = "<html><body>
                <div style='font-family:sofia pro'>
                    <p><b>Dear {$username},</b></p>
                    <p>Thank you for signing up. Please click the following link to verify your email address:</p>
                    <p>Your Verification OTP is: {$verification_code} </p>
                    <p>If you did not sign up, please disregard this email.</p>
                    <br>
                    <p>Best regards,</p>
                </div></body></html>";

            if ($userMail->send()) {
                header("Location: enter_otp_buyer.php?success=A verification Email has been sent you");
                exit;
            } else {
                // Error sending verification email
                header("Location: ../buyer_signup.php?error=Error sending verification email. Please try again later.");
                exit;
            }
        } else {
            // Error inserting user data into database
            header("Location: ../buyer_signup.php?error=Error creating account. Please try again later.");
            exit;
        }
    } else {
        // Fields not set
        header("Location: ../buyer_signup.php?error=Please fill in all fields.");
        exit;
    }
}

function generateOTP($length = 6) {
    $characters = '0123456789';
    $otp = '';
    $max = strlen($characters) - 1;
    for ($i = 0; $i < $length; $i++) {
        $otp .= $characters[random_int(0, $max)];
    }
    return $otp;
}
?>
