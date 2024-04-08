<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buyer Sign-Up</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
    .fade-out {
        animation: fadeOut 1s ease-out forwards;
    }

    @keyframes fadeOut {
        from {
            opacity: 1;
        }
        to {
            opacity: 0;
            display: none; /* Ensure element is not displayed after fading out */
        }
    }
        @media (max-width: 480px) {
.input-group-text{
    padding:0px !important;
}
}
    .form-control:focus {
    color: #495057;
    background-color: #fff;
    border-color: #000000;
    outline: 0;
    box-shadow: 0 0 0 0.2rem rgb(0 0 0 / 25%);
}
.form-control{
    border:1px solid #000;
}
.form-control {
    display: block;
    width: 100%;
    height: calc(1.5em + .75rem + 2px);
    padding: .375rem .75rem;
    font-size: 1rem;
    font-weight: 400;
    line-height: 1.5;
    color: #495057;
    background-color: #fff;
    background-clip: padding-box;
    border: 1px solid #000;
    border-radius: .25rem;
    transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out;
}
    .btn{background-color:black ; color:white; border-radius:0px !important;}
        .error {
            color: red;
            font-size: 0.8em;
        }
        #signupForm {
            margin:30px auto;
            padding:30px;
        }
        .form-group {
            position: relative;
        }
        .form-group .error {
            position: absolute;
            bottom: -1.5em;
            left: 0;
        }
           .sign-bor{
            border:3px solid black;
            border-radius:10px;
            padding:10px;
        }
           .center {
                display: flex;
        justify-content: center; /* Horizontally center the content */
        align-items: center; /
    }
    </style>
</head>
<body>
    <div class="container">
       <div class="row justify-content-center">
        <div class="col-7">
    <form id="signupForm"  class="sign-bor" action="php/buyer_signup_submit.php" method="POST" enctype="multipart/form-data">
                    <div class="center">
    <img src="assets/img/dashboard/Wsymbol_black_RT.svg" height="100px" width="auto" alt="Centered Image">
</div>
        <h2 class="text-center pb-4">Sign-Up (Customer)</h2>
                <!-- Display error message if present -->
        <?php if(isset($_GET['error'])): ?>
            <div  id="errorAlert" class="alert alert-danger text-center" role="alert">
                <?php echo htmlspecialchars($_GET['error']); ?>
            </div>
        <?php endif; ?>
        <?php if(isset($_GET['success'])): ?>
            <div  id="successAlert" class="alert alert-success text-center" role="alert">
                <?php echo htmlspecialchars($_GET['success']); ?>
            </div>
        <?php endif; ?>
        <div class="row">
            <div class="col-md-6 col-sm-6 col-6">
                <div class="form-group">
                    <label for="username">Username:</label>
                    <input type="text" class="form-control" id="username" name="username" pattern="[A-Za-z0-9]{8,}" title="Username must be at least 8 characters and contain only letters and numbers" required>
                    <small id="usernameError" class="error"></small>
                </div>
            </div>
            <div class="col-md-6 col-sm-6 col-6">
                <div class="form-group">
                    <label for="birthdate">Birthdate:</label>
                    <input type="date" class="form-control" id="birthdate" name="birthdate" required>
                    <small id="birthdateError" class="error"></small>
                </div>
            </div>
            </div>
            <div class="row">
            <div class="col-md-6 col-sm-6 col-6">
                <div class="form-group"> 
                    <label for="phoneNumber">Phone Number:</label>
                    <div class="input-group">
    <span class="input-group-prepend">
        <span class="input-group-text">
            <img src="assets/img/dashboard/kosovo_flag_icon.png" alt="Kosovo Flag" style="width: 30px; height: auto;"> +383
        </span>
    </span>
    <input type="tel" class="form-control" id="phoneNumber" name="phone_number" pattern="\d{9}" title="Phone number must have 9 digits" required>
</div>
                    <!--<input type="tel" class="form-control" id="phoneNumber" name="phone_number" pattern="\+383\d{9}" title="Phone number must start with +383 and have 9 digits after that" required>-->
                </div>
            </div>
                        <div class="col-md-6 col-6 col-sm-6">
                <div class="form-group">
                    <label for="streetAddress">Street Address:</label>
                    <input type="text" class="form-control" id="streetAddress" name="street_address" required>
                </div>
            </div>
        </div>
        <div class="row">
<div class="col-md-12">
    <div class="form-group">
        <label for="email">Email Address:</label>
        <input type="email" class="form-control" id="email" name="email" required>
        <small id="emailError" class="error"></small> <!-- Error message will be displayed here -->
    </div>
</div>

            </div>
        <div class="row">
<div class="col-md-6 col-sm-6 col-6">
    <div class="form-group">
        <label for="password">Create Password:</label>
        <div class="input-group">
            <input type="password" class="form-control" id="password" name="password" minlength="8" required>
            <span class="input-group-append">
                <span class="input-group-text">
                    <i id="togglePassword" class="fas fa-eye-slash"></i>
                </span>
            </span>
        </div>
        <small id="passwordError" class="error"></small>
    </div>
</div>


<div class="col-md-6 col-sm-6 col-6">
    <div class="form-group">
        <label for="confirmPassword">Confirm Password:</label>
        <div class="input-group">
            <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" minlength="8" required>
            <div class="input-group-append">
                <span class="input-group-text">
                    <i id="toggleConfirmPassword" class="fas fa-eye-slash"></i>
                </span>
            </div>
        </div>
        <small id="confirmPasswordError" class="error"></small>
    </div>
</div>
<div class="col-md-12 d-flex align-items-center">
    <input type="checkbox" class="mr-2" id="tos" required>
    <label for="tos" class="mb-0">I have read and accepted the <a href="https://docs.google.com/document/d/1yPWgBks9AQax2hioe6ROE3M-l0ishh6aC2cuZcu5M2I/edit?usp=sharing">Terms of Use</a> and <a href="https://docs.google.com/document/d/1jDOEw5M_vT7Ythdropx92Louh5FJlmQi_L7t_8Wjk-M/edit?usp=sharing">Privacy Policy</a></label>
</div>

            <div class="col-md-6">
                <div class="form-group">
                    <p>Already have an Account? <a href="login.php">Login</a></p>
                </div>
            </div>
        </div>
        <div class="row align-items-center">
            <div class="col-lg-3 col-md-4 col-sm-6 col-6">
                <button type="submit" class="btn px-4">Sign Up</button>
            </div>
            <div class="col-lg-3 col-md-8  col-sm-6 col-6 pt-1">
                <a href="seller_signup.php"><p><b>Signup as Seller</b></p></a>
            </div>
        </div>
    </form>
</div>

       </div>
    </div>
    <script>
        document.getElementById('password').addEventListener('input', function(event) {
            var password = event.target.value;
            var confirmPassword = document.getElementById('confirmPassword').value;
            var passwordError = document.getElementById('passwordError');
            if (password.length < 8) {
                passwordError.textContent = "Password must be at least 8 characters long";
            } else {
                passwordError.textContent = "";
            }
        });

        document.getElementById('confirmPassword').addEventListener('input', function(event) {
            var confirmPassword = event.target.value;
            var password = document.getElementById('password').value;
            var confirmPasswordError = document.getElementById('confirmPasswordError');
            if (confirmPassword !== password) {
                confirmPasswordError.textContent = "Confirm Password does not match Password";
            } else {
                confirmPasswordError.textContent = "";
            }
        });
        document.getElementById('signupForm').addEventListener('submit', function(event) {
            var username = document.getElementById('username').value;
            // var confirmPassword = document.getElementById('confirmPassword').value;
            // var password = document.getElementById('password').value;
            var birthdate = new Date(document.getElementById('birthdate').value);
            var today = new Date();
            var age = today.getFullYear() - birthdate.getFullYear();
            var monthDiff = today.getMonth() - birthdate.getMonth();
            if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < birthdate.getDate())) {
                age--;
            }
            
            if (!/^[A-Za-z0-9]{8,}$/.test(username)) {
                event.preventDefault();
                document.getElementById('usernameError').textContent = "Username must be at least 8 characters and contain only letters and numbers";
            } else {
                document.getElementById('usernameError').textContent = "";
            }
                if (age < 13) {
                event.preventDefault();
                document.getElementById('birthdateError').textContent = "You must be 13 or older to sign up";
            } else {
                document.getElementById('birthdateError').textContent = "";
            }
                    var email = document.getElementById('email').value;
        var emailError = document.getElementById('emailError');
        var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

        if (!emailPattern.test(email)) {
            event.preventDefault(); // Prevent form submission
            emailError.textContent = "Invalid email address";
        } else {
            emailError.textContent = ""; // Clear error message
        }
        });
    window.onload = function() {
        setTimeout(function() {
            var errorAlert = document.getElementById('errorAlert');
            var successAlert = document.getElementById('successAlert');
            if (errorAlert) {
                errorAlert.style.display = 'none';
            }
            if (successAlert) {
                successAlert.style.display = 'none';
            }
        }, 3000); // 3000 milliseconds = 3 seconds
    };
    window.onload = function() {
        setTimeout(function() {
            var errorAlert = document.getElementById('errorAlert');
            var successAlert = document.getElementById('successAlert');
            if (errorAlert) {
                errorAlert.classList.add('fade-out');
            }
            if (successAlert) {
                successAlert.classList.add('fade-out');
            }
        }, 2000);
    };
    document.getElementById('togglePassword').addEventListener('click', function() {
        var passwordInput = document.getElementById('password');
        var icon = document.getElementById('togglePassword');

        if (passwordInput.type === "password") {
            passwordInput.type = "text";
            icon.classList.remove('fa-eye-slash');
            icon.classList.add('fa-eye');
        } else {
            passwordInput.type = "password";
            icon.classList.remove('fa-eye');
            icon.classList.add('fa-eye-slash');
        }
    });

    // Toggle confirm password visibility
    document.getElementById('toggleConfirmPassword').addEventListener('click', function() {
        var confirmPasswordInput = document.getElementById('confirmPassword');
        var icon = document.getElementById('toggleConfirmPassword');

        if (confirmPasswordInput.type === "password") {
            confirmPasswordInput.type = "text";
            icon.classList.remove('fa-eye-slash');
            icon.classList.add('fa-eye');
        } else {
            confirmPasswordInput.type = "password";
            icon.classList.remove('fa-eye');
            icon.classList.add('fa-eye-slash');
        }
    });

    </script>
</body>
</html>
