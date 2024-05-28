<?php
session_start();
require_once '../includes/auth.php';
checkAuthentication();
require_once '../classes/customer.php';
require_once '../classes/review.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $customer = new Customer($_POST['name'], $_POST['email'], $_POST['phone']);
    $feedback = new Review($customer, $_POST['feedback']);
    echo "Feedback submitted successfully!";
}
include '../includes/header.php';
?>

    <h1>Submit Feedback</h1>
    <form method="post" action="feedback.php">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required><br>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br>
        <label for="phone">Phone:</label>
        <input type="text" id="phone" name="phone" required><br>
        <label for="feedback">Feedback:</label>
        <textarea id="feedback" name="feedback" required></textarea><br>
        <button type="submit">Submit Feedback</button>
    </form>
    <?php include '../includes/footer.php'; ?>
