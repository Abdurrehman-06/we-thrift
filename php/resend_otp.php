<?php
session_start();
include "../includes/db_conn.php";

require '../smtp/vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["resend_otp"])) { 
    // Check if email is set in session
    if(isset($_SESSION['signup_email'])) {
        $email = $_SESSION['signup_email'];
        $verification_code = generateOTP(6);
        $update_query = "UPDATE users SET verification_code='$verification_code' WHERE email='$email'";
        if(mysqli_query($conn, $update_query)) {
            // Send verification email with the new OTP
            $userMail = new PHPMailer(true);
            $userMail->isSMTP();
            $userMail->Host = "premium55.web-hosting.com";
            $userMail->SMTPAuth = true;
            $userMail->Username = "info@form.justdailyblog.info";
            $userMail->Password = "xnz;(III.dXJ";
            $userMail->SMTPSecure = 'ssl';
            $userMail->Port = 465;
            $userMail->setFrom("info@form.justdailyblog.info", "Veify Email");
            $userMail->addAddress($email);
            $userMail->isHTML(true);
            $userMail->Subject = "Resend OTP - Email Verification";
            $userMail->Body = "<html><body>
                <div style='font-family:sofia pro'>
                    <p><b>Dear User,</b></p>
                    <p>Your OTP for email verification has been resent. Please use the following OTP to verify your email address:</p>
                    <p>Your Verification OTP is: {$verification_code} </p>
                    <br>
                    <p>Best regards,</p>
                </div></body></html>";

            if ($userMail->send()) {
                header("Location: enter_otp.php?success=A new OTP has been sent to your email address.");
                exit;
            } else {
                // Error sending verification email
                header("Location: enter_otp.php?error=Error sending verification email. Please try again later.");
                exit;
            }
        } else {
            // Error updating verification code in the database
            header("Location: enter_otp.php?error=Error resending OTP. Please try again later.");
            exit;
        }
    } else {
        // Email not set in session
        header("Location: enter_otp.php?error=Session data missing. Please try again.");
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
