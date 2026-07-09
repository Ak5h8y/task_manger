<?php
session_start();
require_once "config.php";

// Check login
if (!isset($_SESSION['id'])) {
    header("Location: index.php");
    exit();
}

// Only users can access
if ($_SESSION['role'] != "user") {
    header("Location: admin_page.php");
    exit();
}

$userName = $_SESSION['name'];
?>

<!DOCTYPE html>
<html lang="en">
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>User Dashboard</title>

<link rel="stylesheet" href="dashboard.css">

</head>

<body>

<div class="sidebar">

    <h2>KyvexAI</h2>

    <a href="#">🏠 Dashboard</a>
    <a href="#">📋 My Tasks</a>
    <a href="#">👤 Profile</a>
    <a href="logout.php">🚪 Logout</a>

</div>

<div class="main">

<div class="header">

<h1>Welcome, <?php echo $userName; ?></h1>

</div>

<div class="cards">

<div class="card">
<h3>Total Tasks</h3>
<p>0</p>
</div>

<div class="card">
<h3>Completed</h3>
<p>0</p>
</div>

<div class="card">
<h3>Pending</h3>
<p>0</p>
</div>

<div class="card">
<h3>Account</h3>
<p>User</p>
</div>

</div>

<h2 style="margin-top:40px;">My Profile</h2>

<table>

<tr>
<th>Name</th>
<th>Email</th>
<th>Role</th>
</tr>

<tr>

<td><?php echo $_SESSION['name']; ?></td>

<td><?php echo $_SESSION['email']; ?></td>

<td><?php echo ucfirst($_SESSION['role']); ?></td>

</tr>

</table>

</div>

</body>
</html>