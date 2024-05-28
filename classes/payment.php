<?php
class Payment {
    private $amount;
    private $method;
    private $order;

    public function __construct($amount, $method, $order) {
        $this->amount = $amount;
        $this->method = $method;
        $this->order = $order;
    }

    public function processPayment() {
        // Process payment and return receipt
        return new Invoice($this->order, $this->amount);
    }
}
?>
