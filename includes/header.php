<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/styles.css">
    <title>Relaxing Koala Café</title>
</head>
<body>
    <nav>
        <a href="../scripts/index.php">Home</a>
        <a href="../scripts/menu.php">Menu</a>
        <a href="../scripts/order.php">Place Order</a>
        <a href="../scripts/reservation.php">Book a Table</a>
        <a href="../scripts/feedback.php">Feedback</a>
        <?php if (isset($_SESSION['user_id'])): ?>
            <?php if ($_SESSION['role'] == 'admin'): ?>
                <a href="../scripts/manage_menu.php">Manage Menu</a>
                <a href="../scripts/view_orders.php">View Orders</a>
                <a href="../scripts/manage_reservations.php">Manage Reservations</a>
                <a href="../scripts/view_sales.php">View Sales</a>
            <?php endif; ?>
            <a href="../scripts/logout.php">Logout</a>
        <?php else: ?>
            <a href="../scripts/login.php">Login</a>
            <a href="../scripts/signup.php">Sign Up</a>
        <?php endif; ?>
    </nav>
    <div class="container">
