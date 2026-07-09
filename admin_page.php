<?php
session_start();
require_once "config.php";

// Check login
if (!isset($_SESSION['id'])) {
    header("Location: index.php");
    exit();
}

// Only admin can access
if ($_SESSION['role'] != "admin") {
    header("Location: user_page.php");
    exit();
}

// Total users
$totalUsers = $conn->query("SELECT COUNT(*) AS total FROM users");
$totalUsers = $totalUsers->fetch_assoc()['total'];

// Total admins
$totalAdmins = $conn->query("SELECT COUNT(*) AS total FROM users WHERE role='admin'");
$totalAdmins = $totalAdmins->fetch_assoc()['total'];

// Total normal users
$totalNormalUsers = $conn->query("SELECT COUNT(*) AS total FROM users WHERE role='user'");
$totalNormalUsers = $totalNormalUsers->fetch_assoc()['total'];
?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Admin Dashboard</title>

<link rel="stylesheet" href="dashboard.css">

</head>

<body>

<div class="sidebar">

<h2>KyvexAI</h2>

<a href="#">🏠 Dashboard</a>
<a href="#">👥 Users</a>
<a href="#">📋 Tasks</a>
<a href="#">⚙ Settings</a>
<a href="logout.php">🚪 Logout</a>

</div>

<div class="main">

<div class="header">

<h1>Welcome, <?php echo $_SESSION['name']; ?></h1>

</div>

<div class="cards">

<div class="card">
<h3>Total Users</h3>
<p><?php echo $totalUsers; ?></p>
</div>

<div class="card">
<h3>Admins</h3>
<p><?php echo $totalAdmins; ?></p>
</div>

<div class="card">
<h3>Users</h3>
<p><?php echo $totalNormalUsers; ?></p>
</div>

<div class="card">
<h3>Status</h3>
<p>Online</p>
</div>

</div>

<h2 style="margin-top:40px;">Registered Users</h2>

<table>

<tr>

<th>ID</th>
<th>Name</th>
<th>Email</th>
<th>Role</th>

</tr>

<?php

$result = $conn->query("SELECT * FROM users ORDER BY id DESC");

while($row = $result->fetch_assoc()){

?>

<tr>

<td><?php echo $row['id']; ?></td>

<td><?php echo $row['name']; ?></td>

<td><?php echo $row['email']; ?></td>

<td><?php echo ucfirst($row['role']); ?></td>

</tr>

<?php
}
?>

</table>

</div>

</body>

</html>