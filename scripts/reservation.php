<?php
session_start();
require_once '../includes/auth.php';
checkAuthentication(); 
require_once '../classes/reservation_manager.php'; 

$reservationManager = new ReservationManager(); 
$message = "";

// form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_SESSION['user_id'] ?? null; 
    $date = $_POST['date'] ?? null;
    $timeStart = $_POST['timeStart'] ?? null;
    $timeEnd = $_POST['timeEnd'] ?? null;
    $guests = $_POST['guests'] ?? null;

    // Validate required fields
    if (!$date || !$timeStart || !$timeEnd || !$guests) {
        $message = "Please fill in all fields.";
    } else {
        $tables = $reservationManager->getTables();
        $bookingSuccess = false;
        $messages = [];

        foreach ($tables as $table) {
            $result = $reservationManager->bookTable($user_id, $table->getId(), $date, $timeStart, $timeEnd, $guests);
            if (strpos($result, "successfully") !== false) {
                $message = $result;
                $bookingSuccess = true;
                break;
            } else {
                if (!in_array($result, $messages)) {
                    $messages[] = $result;
                }
            }
        }

        if (!$bookingSuccess) { // display reason for error
            $message = "No available tables that can accommodate the number of guests at the selected times";
            if (!empty($messages)) {
             
                $message .= ", " . implode(", ", $messages);
            }
        }
    }
}

include '../includes/header.php'; 
?>

<h1>Book a Table</h1>   
<?php if ($message): ?>
    <p><?= htmlspecialchars($message) ?></p>
<?php endif; ?>
<form method="post" action="reservation.php">
    <label for="date">Date:</label>
    <input type="date" id="date" name="date" required><br>
    <label for="timeStart">Start Time:</label>
    <input type="time" id="timeStart" name="timeStart" required><br>
    <label for="timeEnd">End Time:</label>
    <input type="time" id="timeEnd" name="timeEnd" required><br>
    <label for="guests">Number of Guests:</label>
    <input type="number" id="guests" name="guests" required min="1"><br>
    <button type="submit">Book Table</button>
</form>

<?php include '../includes/footer.php'; // Including footer file ?>