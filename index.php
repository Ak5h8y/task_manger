<?php
session_start();

$active = isset($_SESSION['active_form']) ? $_SESSION['active_form'] : 'login';
?>

<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>KyvexAI | Login</title>

    <link rel="stylesheet" href="style.css">

</head>

<body>

<div class="container">

    <div class="form-box">

        <div class="button-box">

            <button id="loginBtn" class="toggle-btn">Login</button>

            <button id="registerBtn" class="toggle-btn">Register</button>

        </div>

        <!-- LOGIN FORM -->

        <form id="loginForm"
              action="login_register.php"
              method="POST"
              class="form">

            <h2>Welcome Back</h2>

            <input
                type="email"
                name="email"
                placeholder="Email"
                required>

            <input
                type="password"
                name="password"
                placeholder="Password"
                required>

            <?php
            if(isset($_SESSION['login_error'])){
                echo "<p class='error'>".$_SESSION['login_error']."</p>";
                unset($_SESSION['login_error']);
            }
            ?>

            <button
                type="submit"
                name="login"
                class="submit-btn">

                Login

            </button>

        </form>


        <!-- REGISTER FORM -->

        <form id="registerForm"
              action="login_register.php"
              method="POST"
              class="form">

            <h2>Create Account</h2>

            <input
                type="text"
                name="name"
                placeholder="Full Name"
                required>

            <input
                type="email"
                name="email"
                placeholder="Email"
                required>

            <input
                type="password"
                name="password"
                placeholder="Password"
                required>

            <select name="role" required>

                <option value="">Choose Role</option>

                <option value="user">User</option>

                <option value="admin">Admin</option>

            </select>

            <?php
            if(isset($_SESSION['register_error'])){
                echo "<p class='error'>".$_SESSION['register_error']."</p>";
                unset($_SESSION['register_error']);
            }
            ?>

            <button
                type="submit"
                name="register"
                class="submit-btn">

                Register

            </button>

        </form>

    </div>

</div>

<script>

const loginBtn=document.getElementById("loginBtn");
const registerBtn=document.getElementById("registerBtn");

const loginForm=document.getElementById("loginForm");
const registerForm=document.getElementById("registerForm");

function showLogin(){

loginForm.style.display="flex";
registerForm.style.display="none";

loginBtn.classList.add("active");
registerBtn.classList.remove("active");

}

function showRegister(){

registerForm.style.display="flex";
loginForm.style.display="none";

registerBtn.classList.add("active");
loginBtn.classList.remove("active");

}

loginBtn.onclick=showLogin;

registerBtn.onclick=showRegister;

<?php if($active=="register"){ ?>

showRegister();

<?php } else { ?>

showLogin();

<?php } ?>

</script>

</body>

</html>