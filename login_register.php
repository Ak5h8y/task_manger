<?php
session_start();
require_once "config.php";

/* ==========================
   REGISTER
========================== */

if (isset($_POST['register'])) {

    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $role = trim($_POST['role']);

    // Check email exists
    $check = $conn->prepare("SELECT id FROM users WHERE email = ?");
    $check->bind_param("s", $email);
    $check->execute();
    $result = $check->get_result();

    if ($result->num_rows > 0) {

        $_SESSION['register_error'] = "Email already exists!";
        $_SESSION['active_form'] = "register";

        header("Location: index.php");
        exit();
    }

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO users(name,email,password,role) VALUES(?,?,?,?)");
    $stmt->bind_param("ssss",$name,$email,$hashedPassword,$role);

    if($stmt->execute()){

        $_SESSION['login_error']="Registration Successful! Please Login.";

    }else{

        $_SESSION['register_error']="Registration Failed!";
        $_SESSION['active_form']="register";

    }

    header("Location:index.php");
    exit();
}


/* ==========================
   LOGIN
========================== */

if(isset($_POST['login'])){

    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    $stmt = $conn->prepare("SELECT * FROM users WHERE email=?");
    $stmt->bind_param("s",$email);
    $stmt->execute();

    $result = $stmt->get_result();

    if($result->num_rows == 1){

        $user = $result->fetch_assoc();

        if(password_verify($password,$user['password'])){

            $_SESSION['id'] = $user['id'];
            $_SESSION['name'] = $user['name'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['role'] = $user['role'];

            if($user['role']=="admin"){

                header("Location: admin_page.php");

            }else{

                header("Location: user_page.php");

            }

            exit();

        }

    }

    $_SESSION['login_error']="Invalid Email or Password";
    $_SESSION['active_form']="login";

    header("Location:index.php");
    exit();

}
?>