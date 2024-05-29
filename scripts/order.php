<?php
session_start();
require_once '../includes/auth.php';
checkAuthentication();
require_once '../classes/menu_manager.php';
require_once '../classes/Order.class.php';
require_once '../classes/customer.php';

try {
    $menuManager = MenuManager::getInstance();
    $items = $menuManager->getItems();

    $orderPlaced = false;
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $customerId = $_SESSION['user_id']; // Assuming customer is logged in
        $customer = new Customer($customerId); // Assuming Customer class can be initialized with an ID
        $order = new Order(rand(1000, 9999), $customer); // Random order number for demonstration

        $hasValidItem = false;
        foreach ($_POST['items'] as $itemId => $quantity) {
            if ($quantity > 0) {
                $hasValidItem = true;
                $item = $menuManager->getItemById($itemId);
                if ($item) {
                    $order->addItem($item, $quantity);
                } else {
                    throw new Exception("Item not found");
                }
            }
        }

        if ($hasValidItem) {
            $order->confirmOrder();
            $orderPlaced = true;
        } else {
            throw new Exception("Please select at least one item with a quantity greater than zero.");
        }
    }
} catch (Exception $e) {
    $errorMessage = 'Error: ' . $e->getMessage();
}

include '../includes/header.php';
?>

<h1>Place Order</h1>
<?php if (isset($errorMessage)): ?>
    <p style="color: red;"><?php echo $errorMessage; ?></p>
<?php endif; ?>
<?php if ($orderPlaced): ?>
    <p style="color: green;">Order placed successfully!</p>
<?php else: ?>
    <form method="post" action="order.php">
        <h2>Select Items:</h2>
        <?php foreach ($items as $item): ?>
            <div>
                <label for="item_<?php echo $item['id']; ?>"><?php echo htmlspecialchars($item['name']); ?> ($<?php echo number_format($item['price'], 2); ?>):</label>
                <input type="number" id="item_<?php echo $item['id']; ?>" name="items[<?php echo $item['id']; ?>]" min="0" value="0">
            </div>
        <?php endforeach; ?>
        <button type="submit">Place Order</button>
    </form>
<?php endif; ?>

<?php include '../includes/footer.php'; ?>
