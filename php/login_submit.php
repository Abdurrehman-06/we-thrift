<?php
session_start();
include "../includes/db_conn.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $emailOrUsername = $_POST["emailOrUsername"];
    $data = $emailOrUsername;
    $password = $_POST["password"];
    $sql = "SELECT * FROM users WHERE email = '$emailOrUsername' OR username = '$emailOrUsername'";
    $result = $conn->query($sql);
    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row["password"])) {
            if ($row["status"] == 2 || $row["status"] == 3 || $row["status"] == 4  || $row["status"] == 1 || $row["status"] == 5) {
                $_SESSION['user_id'] = $row['id'];
                $_SESSION['email'] = $row['email'];
                header("Location:../ecommerce/");
                exit;
            } else {
                header("Location: ../login.php?error=Your email verification is pending.&emailOrUsername=$data");
                exit;
            }
        } else {
            header("Location:../login.php?error=Invalid Email/Username or Password.&emailOrUsername=$data");
            exit;
        }
    } else {
        header("Location:../login.php?error=Invalid Username or Password.&emailOrUsername=$data");
        exit;
    }
}
?>
