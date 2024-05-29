<?php
// Ensure errors are displayed (for development purposes)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once '../classes/config.php';
require_once '../classes/menu_manager.php';
require_once '../classes/reservation_manager.php';
require_once '../classes/customer.php';
require_once '../classes/order.class.php';
require_once '../classes/review.php';
require_once '../classes/restaurant_staff.php';
require_once '../classes/manager.class.php';
require_once '../classes/item.php';

// Check database connection
try {
    $pdo->query('SELECT 1');
    echo "Database connection successful.<br>";
} catch (Exception $e) {
    echo "Database connection failed: " . $e->getMessage();
    exit();
}
echo "<br>";

// Initialize and load MenuManager
try {
    $menuManager = MenuManager::getInstance();
    $items = $menuManager->getItems();
    if (!empty($items)) {
        echo "Menu items loaded successfully:<br>";
        foreach ($items as $item) {
            echo htmlspecialchars($item['name']) . " - " . htmlspecialchars($item['description']) . " - $" . number_format($item['price'], 2) . "<br>";
        }
    } else {
        echo "No menu items found.<br>";
    }
} catch (Exception $e) {
    echo "Failed to load menu items: " . $e->getMessage() . "<br>";
}
echo "<br>";


// Initialize and load ReservationManager and show reservations
try {
    $reservationManager = new ReservationManager();
    $reservations = $reservationManager->getReservations();
    if (!empty($reservations)) {
        echo "Reservations loaded successfully:<br>";
        foreach ($reservations as $reservation) {
            echo "Reservation ID: " . htmlspecialchars($reservation['id']) . " - Customer ID: " . htmlspecialchars($reservation['customer_id']) . " - Table ID: " . htmlspecialchars($reservation['table_id']) . " - Date: " . htmlspecialchars($reservation['reservation_date']) . " - Time: " . htmlspecialchars($reservation['reservation_time_start']) . " to " . htmlspecialchars($reservation['reservation_time_end']) . "<br>";
        }
    } else {
        echo "No reservations found.<br>";
    }
} catch (Exception $e) {
    echo "Failed to load reservations: " . $e->getMessage() . "<br>";
}
echo "<br>";

// Load Customers
try {
    $stmt = $pdo->query('SELECT * FROM customers');
    $customers = $stmt->fetchAll(PDO::FETCH_ASSOC);
    if (!empty($customers)) {
        echo "Customers loaded successfully:<br>";
        foreach ($customers as $customer) {
            echo "Customer ID: " . htmlspecialchars($customer['id']) . " - Name: " . htmlspecialchars($customer['NAME']) . "<br>";
        }
    } else {
        echo "No customers found.<br>";
    }
} catch (Exception $e) {
    echo "Failed to load customers: " . $e->getMessage() . "<br>";
}
echo "<br>";

// Load Orders
try {
    $stmt = $pdo->query('SELECT * FROM orders');
    $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);
    if (!empty($orders)) {
        echo "Orders loaded successfully:<br>";
        foreach ($orders as $order) {
            echo "Order ID: " . htmlspecialchars($order['id']) . " - Customer ID: " . htmlspecialchars($order['customer_id']) . " - Total Amount: $" . number_format($order['total_amount'], 2) . "<br>";
        }
    } else {
        echo "No orders found.<br>";
    }
} catch (Exception $e) {
    echo "Failed to load orders: " . $e->getMessage() . "<br>";
}
echo "<br>";

// Load Reviews
try {
    $stmt = $pdo->query('SELECT * FROM reviews');
    $reviews = $stmt->fetchAll(PDO::FETCH_ASSOC);
    if (!empty($reviews)) {
        echo "Reviews loaded successfully:<br>";
        foreach ($reviews as $review) {
            echo "Review ID: " . htmlspecialchars($review['id']) . " - Customer ID: " . htmlspecialchars($review['customer_id']) . " - Feedback: " . htmlspecialchars($review['feedback']) . "<br>";
        }
    } else {
        echo "No reviews found.<br>";
    }
} catch (Exception $e) {
    echo "Failed to load reviews: " . $e->getMessage() . "<br>";
}
echo "<br>";

// Load Managers
try {
    $stmt = $pdo->query('SELECT * FROM admins');
    $managers = $stmt->fetchAll(PDO::FETCH_ASSOC);
    if (!empty($managers)) {
        echo "Managers loaded successfully:<br>";
        foreach ($managers as $manager) {
            echo "Manager ID: " . htmlspecialchars($manager['id']) . " - Name: " . htmlspecialchars($manager['name']) . "<br>";
        }
    } else {
        echo "No managers found.<br>";
    }
} catch (Exception $e) {
    echo "Failed to load managers: " . $e->getMessage() . "<br>";
}
echo "<br>";

// Load Items
try {
    $stmt = $pdo->query('SELECT * FROM items');
    $items = $stmt->fetchAll(PDO::FETCH_ASSOC);
    if (!empty($items)) {
        echo "Items loaded successfully:<br>";
        foreach ($items as $item) {
            echo "Item ID: " . htmlspecialchars($item['id']) . " - Name: " . htmlspecialchars($item['name']) . " - Description: " . htmlspecialchars($item['description']) . " - Price: $" . number_format($item['price'], 2) . "<br>";
        }
    } else {
        echo "No items found.<br>";
    }
} catch (Exception $e) {
    echo "Failed to load items: " . $e->getMessage() . "<br>";
}

echo "Bootstrap process completed successfully.";
?>
