<?php
require_once 'config.php';

class Review {
    private $customer;
    private $feedback;

    public function __construct($customer, $feedback) {
        $this->customer = $customer;
        $this->feedback = $feedback;
        $this->submitFeedback();
    }

    public function submitFeedback() {
        global $pdo;
        $stmt = $pdo->prepare('INSERT INTO reviews (customer_id, feedback) VALUES (?, ?)');
        $stmt->execute([$this->customer->getId(), $this->feedback]);
        $this->sendConfirmationMessage();
    }

    private function sendConfirmationMessage() {
        echo "Thank you for your feedback, " . $this->customer->getName() . "!";
    }
}
?>
