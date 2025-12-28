<?php
session_start();

// proteksi halaman
if (!isset($_SESSION['user'])) {
    header("Location: index.php");
    exit;
}

$user = $_SESSION['user'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
</head>
<body>

<h1>Welcome to the Dashboard</h1>
<p>Hello, <b><?= htmlspecialchars($user['name']); ?></b></p>
<p>Email: <?= htmlspecialchars($user['email']); ?></p>

<a href="logout.php">Logout</a>

</body>
</html>
