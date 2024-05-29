<?php
session_start();
include '../includes/header.php';
?>

<h1>Welcome to the Relaxing Koala Café</h1>
<p>Discover our delicious menu and make reservations online.</p>

<?php if (!isset($_SESSION['user_id'])): ?>
    <p><a href="login.php">Login</a> or <a href="signup.php">Sign Up</a> to place orders and make reservations.</p>
<?php else: ?>
    <p><a href="dashboard.php">Go to your Dashboard</a></p>
<?php endif; ?>

<?php include '../includes/footer.php'; ?>
