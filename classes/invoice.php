<?php
class Invoice {
    private $order;
    private $amount;

    public function __construct($order, $amount) {
        $this->order = $order;
        $this->amount = $amount;
    }

    public function generateInvoice() {
        // Generate and return invoice details
    }
}
?>
