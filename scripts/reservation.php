<?php
session_start();
require_once '../includes/auth.php';
checkAuthentication();
require_once '../classes/reservation_manager.php';
require_once '../classes/RestaurantTable.php';

$reservationManager = new ReservationManager();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve user details from session
    $user_id = $_SESSION['user_id'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $guests = $_POST['guests'];
    
    $availableTables = array_filter($reservationManager->getTables(), function($table) use ($guests) {
        return $table->getCapacity() >= $guests && $table->isAvailable();
    });

    if (count($availableTables) > 0) {
        $table = reset($availableTables); // Get the first available table
        $reservationManager->bookTable($user_id, $table->getId(), $date, $time, $guests);
        echo "<p>Table booked successfully!</p>";
    } else {
        echo "<p>No available table for the selected time.</p>";
    }
}

include '../includes/header.php';
?>

<h1>Book a Table</h1>
<form method="post" action="reservation.php">
    <label for="date">Date:</label>
    <input type="date" id="date" name="date" required><br>
    <label for="time">Time:</label>
    <input type="time" id="time" name="time" required><br>
    <label for="guests">Number of Guests:</label>
    <input type="number" id="guests" name="guests" required><br>
    <button type="submit">Book Table</button>
</form>

<?php include '../includes/footer.php'; ?>
