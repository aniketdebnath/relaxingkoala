<?php
require_once 'config.php'; // Ensure you have included your database configuration file

class Review {
    private $customer;
    private $feedback;

    public function __construct($customer, $feedback) {
        $this->customer = $customer;
        $this->feedback = $feedback;
        $this->submitFeedback();
    }

    public function submitFeedback() {
        global $pdo; // Ensure $pdo is properly initialized in your global scope or passed as a dependency
        $customerId = $this->customer ? $this->customer->getId() : null;
        $stmt = $pdo->prepare('INSERT INTO reviews (customer_id, feedback, created_at) VALUES (?, ?, NOW())');
        try {
            $stmt->execute([$customerId, $this->feedback]);
            $this->sendConfirmationMessage();
        } catch (PDOException $e) {
            // Error handling for database operation
            echo "Error submitting feedback: " . $e->getMessage();
        }
    }

    private function sendConfirmationMessage() {
        if ($this->customer !== null) {
            echo "Thank you for your feedback, " . $this->customer->getName() . "!";
        } else {
            echo "Feedback received. Thank you!";
        }
    }
}
?>
