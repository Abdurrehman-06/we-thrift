<?php
include "../includes/db_conn.php";

if (isset($_GET['Token'])) {
    $token = mysqli_real_escape_string($conn, $_GET['Token']);
    $query = "SELECT * FROM users WHERE reset_otp='$token'";
    $result = mysqli_query($conn, $query);
    
    if(mysqli_num_rows($result) == 1) {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $new_password = mysqli_real_escape_string($conn, $_POST['new_pass']);
            $confirm_password = mysqli_real_escape_string($conn, $_POST['cpassword']);
            if ($new_password === $confirm_password) {
                $email_query = "SELECT email FROM users WHERE reset_otp='$token'";
                $email_result = mysqli_query($conn, $email_query);
                
                if(mysqli_num_rows($email_result) == 1) {
                    $row = mysqli_fetch_assoc($email_result);
                    $email = $row['email'];
                    $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
                    $update_query = "UPDATE users SET password='$hashed_password', reset_otp=NULL WHERE email='$email'";
                    $update_result = mysqli_query($conn, $update_query);
                    
                    if ($update_result) {
                        // Password updated successfully, redirect to login page
                        header("location: ../login.php?success=Password updated successfully. Please log in.");
                        exit;
                    } else {
                        $error_message = "An unknown Error Occurred in Updating password: " . mysqli_error($conn);
                    }
                } else {
                    // Email not found for the given token, redirect to an error page or show error message
                    $error_message = "There is no such otp for this email";
                }
            } else {
                // Passwords don't match, redirect back to reset password page or show error message
                $error_message = "Please Enter Password And Confirm Password Same";
            }
        }
    } else {
        // Token not found, show error message or redirect to an error page
        $error_message = "There is no such otp for this email";
    }
} else {
    // Token not provided in URL, redirect to an error page or show an error message
    $error_message = "Please Send An email first for Password Recovery";
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Jost:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Jost:ital,wght@0,100..900;1,100..900&family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap" rel="stylesheet">
    <style>
    body{
        background:#f5f5f5;
    }
        h1 { font-family: "Playfair Display", sans-serif; font-weight:700}
        #new_pass, #cpassword { border-radius: 5px; background-color: #F4F5F6; width: 100%; padding-left: 20px; }
        #chgpswd { border-radius: 5px; background-color: #ADB1BC; width: 100%; color: white; }
        .error { color: red; }
        .chgpswd_form{
                display: flex;
    justify-content: center;
    align-items: center;
    background:#f5f5f5;
    height: 100vh;
        }
        #chgpswd_form{
                padding: 10px 30px;
    width: 35%;
    background: #fff;
    
        }
        @media(max-width:786px){
            #chgpswd_form{
                width: 50%;            
            }
        }
        
        @media(max-width:480px){
            #chgpswd_form{
                width: 90%;            
            }
        }
    </style>
</head>
<body>
    <div class="chgpswd_form">
    <form id="chgpswd_form" action="create_password.php?Token=<?php echo $token; ?>" method="POST">
        <div class="pt-5 text-center">
            <h1 class="pb-2">Reset Password</h1>
        </div>
        <div class="text-center">
            <input type="password" class="border-0 py-2 my-2" placeholder="Enter New Password" name="new_pass" id="new_pass">
            <input type="password" class="my-2 border-0 py-2" placeholder="Confirm Password" name="cpassword" id="cpassword">
            <span id="passerror" class="error text-left"><?php if(isset($error_message)) { echo $error_message; } ?></span><br>
        </div>
        <div class="text-center">
            <input type="submit" class="btn border-0 text-center mt-3" value="Change Password" id="chgpswd">    
            <span id="passerror" class="error text-left">
                <?php if(isset($_GET['error'])){ ?>
                    <div class="text-center mt-2" role="alert">
                       <p style="color:red"><?php echo $_GET['error']; ?></p>
                    </div>
                <?php } ?>
                <?php if(isset($_GET['success'])){ ?>
                    <div class="text-center" role="alert">
                       <p style="color:green"><?php echo $_GET['success']; ?></p>
                    </div>
                <?php } ?> </span>
                
        </div>
    </form>
</div>
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const newPassInput = document.getElementById('new_pass');
        const cpasswordInput = document.getElementById('cpassword');
        const passError = document.getElementById('passerror');
        const chgpswdBtn = document.getElementById('chgpswd');

        function validatePassword(password) {
            return password.length >= 8;
        }

        function passwordsMatch(newPassword, confirmPassword) {
            return newPassword === confirmPassword;
        }

        function validateForm() {
            const newPassword = newPassInput.value;
            const confirmPassword = cpasswordInput.value;
            let isValid = true;
            newPassInput.style.borderColor = '';
            cpasswordInput.style.borderColor = '';

            if (!validatePassword(newPassword) || !passwordsMatch(newPassword, confirmPassword)) {
                passError.textContent = 'Passwords must be at least 8 characters long and match';
                newPassInput.style.borderColor = 'red';
                cpasswordInput.style.borderColor = 'red';
                isValid = false;
            } else {
                passError.textContent = '';
            }

            return isValid;
        }

        chgpswdBtn.addEventListener('click', function(event) {
            if (!validateForm()) {
                event.preventDefault();
            }
        });

        newPassInput.addEventListener('input', function () {
            const newPassword = this.value;
            const confirmPassword = cpasswordInput.value;

            if (validatePassword(newPassword) && passwordsMatch(newPassword, confirmPassword)) {
                chgpswdBtn.style.backgroundColor = 'blue';
            } else {
                chgpswdBtn.style.backgroundColor = '';
            }
        });

        cpasswordInput.addEventListener('input', function () {
            const newPassword = newPassInput.value;
            const confirmPassword = this.value;

            if (validatePassword(newPassword) && passwordsMatch(newPassword, confirmPassword)) {
                chgpswdBtn.style.backgroundColor = 'blue';
            } else {
                chgpswdBtn.style.backgroundColor = '';
            }
        });
    });
</script>

</body>
</html>
