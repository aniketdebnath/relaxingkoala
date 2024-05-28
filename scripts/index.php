<?php
session_start();
include '../includes/header.php';
?>

<h1>Welcome to the Relaxing Koala Café</h1>
<p>Welcome to the Relaxing Koala Café, your go-to place for delicious food and a relaxing atmosphere. Whether you're here to enjoy a meal, make a reservation, or leave feedback, we're here to ensure you have a great experience.</p>

<?php if (isset($_SESSION['user_id'])): ?>
    <h2>Hello, <?php echo htmlspecialchars($_SESSION['name']); ?>!</h2>
    <p>Use the navigation menu above to explore our services.</p>
<?php else: ?>
    <h2>Please Login or Sign Up</h2>
    <p>If you already have an account, please <a href="login.php">login</a>. If not, you can <a href="signup.php">sign up</a> to get started.</p>
<?php endif; ?>

<?php include '../includes/footer.php'; ?>
