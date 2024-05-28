<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$role = $_SESSION['role'];
include '../includes/header.php';
?>

    <h1>Welcome to the Dashboard</h1>
    <?php if ($role == 'customer'): ?>
        <h2>Customer Console</h2>
        <p>Here you can place orders, view your order history, and more.</p>
        <ul>
            <li><a href="menu.php">View Menu</a></li>
            <li><a href="order.php">Place Order</a></li>
            <li><a href="reservation.php">Book a Table</a></li>
            <li><a href="feedback.php">Submit Feedback</a></li>
        </ul>
    <?php elseif ($role == 'admin'): ?>
        <h2>Admin Console</h2>
        <p>Here you can manage menu items, view all orders, manage reservations, and more.</p>
        <ul>
            <li><a href="manage_menu.php">Manage Menu</a></li>
            <li><a href="view_orders.php">View All Orders</a></li>
            <li><a href="manage_reservations.php">Manage Reservations</a></li>
        </ul>
    <?php endif; ?>
    <a href="logout.php">Logout</a>
    <?php include '../includes/footer.php'; ?>
