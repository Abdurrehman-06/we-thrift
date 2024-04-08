<?php
session_start();
if (isset($_SESSION['user_id'])) {
    header("Location:ecommerce");
    exit;
}
include "includes/head.php"
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
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
        body {
            height: 100%;
            margin: 0;
            display: flex;
            justify-content: center;
        }
        button {
            border-radius:0px !important;
        }
           .sign-bor{
            border:3px solid black;
            border-radius:10px;
            padding:30px;
            margin:0px 10px;
        }
            .center {
                display: flex;
        justify-content: center; /* Horizontally center the content */
        align-items: center; /
    }
        @media(min-width:786px){
            .container {
            width: 30%;
        }
        }
        
    </style>
</head>
<body>
    <div class="sign-bor container mt-5">
        <div class="center">
    <img src="assets/img/dashboard/Wsymbol_black_RT.svg" height="100px" width="auto" alt="Centered Image">
</div>
        <h2 class="text-center mb-4">Login</h2>
        <?php if(isset($_GET['error'])): ?>
            <div class="alert alert-danger text-center" role="alert">
                <?php echo htmlspecialchars($_GET['error']); ?>
            </div>
        <?php endif; ?>
        <?php if(isset($_GET['success'])): ?>
            <div class="alert alert-success text-center" role="alert">
                <?php echo htmlspecialchars($_GET['success']); ?>
            </div>
        <?php endif; ?>

        <form  action="php/login_submit.php" method="post">
            
            <div class="form-group">
                <label for="emailOrUsername"><b>Email or Username:</b></label>
                <input type="text" class="form-control" id="emailOrUsername" name="emailOrUsername" value="<?php echo isset($_GET['emailOrUsername']) ? htmlspecialchars($_GET['emailOrUsername']) : ''; ?>" required>
            </div>
            <div class="form-group">
                <label for="password"><b>Password:</b></label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-10">
                <div class="form-group "style="margin-left:-15px">
                    <p>Don't have an Account? <a href="buyer_signup.php">Create One!</a></p>
                </div>
            </div>
                    <div class="row">
            <div class="col-lg-2 col-md-4 col-sm-6 rounded-0">
                <button type="submit" class="btn px-4" style="color:white ; background:black">Login</button>
            </div>
        </div>
            
        </form>
    </div>
    
</body>
</html>
