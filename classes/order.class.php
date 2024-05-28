<?php
require_once 'config.php';

class Order {
    private $orderNumber;
    private $items = [];
    private $totalAmount;
    private $customer;

    public function __construct($orderNumber, $customer) {
        $this->orderNumber = $orderNumber;
        $this->customer = $customer;
        $this->totalAmount = 0;
    }

    public function addItem($item, $quantity) {
        $this->items[] = ['item' => $item, 'quantity' => $quantity];
        $this->totalAmount += $item['price'] * $quantity;
    }

    public function confirmOrder() {
        global $pdo;
        $stmt = $pdo->prepare('INSERT INTO orders (customer_id, total_amount, created_at) VALUES (?, ?, NOW())');
        $stmt->execute([$this->customer->getId(), $this->totalAmount]);
        $orderId = $pdo->lastInsertId();

        foreach ($this->items as $orderItem) {
            $stmt = $pdo->prepare('INSERT INTO order_items (order_id, item_id, quantity, price) VALUES (?, ?, ?, ?)');
            $stmt->execute([$orderId, $orderItem['item']['id'], $orderItem['quantity'], $orderItem['item']['price']]);
        }

        // Send confirmation message
        echo "Order #{$this->orderNumber} placed successfully for {$this->customer->getName()}! Total amount: \${$this->totalAmount}.";
    }

    public function getOrderDetails() {
        return $this->items;
    }

    public function getTotalAmount() {
        return $this->totalAmount;
    }
}
?>
