<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Relaxing Koala Café</title>
    <link rel="stylesheet" href="../css/styles.css"> <!-- Update path if needed -->
</head>
<body>
    <header>
        <h1>Welcome to Relaxing Koala Café</h1>
        <nav>
            <ul>
                <li><a href="../scripts/index.php">Home</a></li>
                <?php if (isset($_SESSION['user_id'])): ?>
                    <li><a href="../scripts/dashboard.php">Dashboard</a></li>
                    <?php if ($_SESSION['role'] == 'customer'): ?>
                        <li><a href="../scripts/menu.php">Menu</a></li>
                        <li><a href="../scripts/order.php">Place Order</a></li>
                        <li><a href="../scripts/reservation.php">Book a Table</a></li>
                        <li><a href="../scripts/feedback.php">Feedback</a></li>
                    <?php elseif ($_SESSION['role'] == 'admin'): ?>
                        <li><a href="../scripts/manage_menu.php">Manage Menu</a></li>
                        <li><a href="../scripts/view_orders.php">View Orders</a></li>
                        <li><a href="../scripts/reservation.php">Manage Reservations</a></li>
                        <li><a href="../scripts/view_feedback.php">View Feedback</a></li>
                    <?php endif; ?>
                    <li><a href="../scripts/logout.php">Logout</a></li>
                <?php else: ?>
                    <li><a href="../scripts/login.php">Login</a></li>
                    <li><a href="../scripts/signup.php">Sign Up</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </header>
    <main>
