<?php
session_start();
require_once '../includes/auth.php';
checkAuthentication(); // Ensure the user is authenticated before submitting feedback
require_once '../classes/customer.php';
require_once '../classes/review.php';

$customer = null;
if (isset($_SESSION['user_id'])) {
    $customer = new Customer($_SESSION['user_id']);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $feedback = new Review($customer, $_POST['feedback']); // Create a Review instance with or without a customer
    echo "Feedback submitted successfully!";
}

include '../includes/header.php';
?>

<h1>Submit Feedback</h1>
<form method="post" action="feedback.php">
    <label for="feedback">Feedback:</label>
    <textarea id="feedback" name="feedback" required></textarea><br>
    <button type="submit">Submit Feedback</button>
</form>
<?php include '../includes/footer.php'; ?>
