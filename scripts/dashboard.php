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
<?php elseif ($role == 'admin'): ?>
    <h2>Admin Console</h2>
    <p>Here you can manage menu items, view all orders, manage reservations, and view feedback.</p>
<?php endif; ?>

<?php include '../includes/footer.php'; ?>
