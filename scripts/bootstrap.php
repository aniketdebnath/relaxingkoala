<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once '../classes/config.php';
require_once '../classes/menu_manager.php';
require_once '../classes/reservation_manager.php';
require_once '../classes/Order.class.php';
require_once '../classes/customer.php';
require_once '../classes/review.php';
require_once '../classes/sales_record.php';
require_once '../classes/analysis.php';

function checkDatabaseConnection($pdo) {
    try {
        $stmt = $pdo->query('SELECT 1');
        if ($stmt) {
            echo "Database connection is working.<br>";
        }
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage() . "<br>";
    }
}

function loadMenuItems() {
    $menuManager = MenuManager::getInstance();
    $items = $menuManager->getItems();
    echo "Loaded " . count($items) . " menu items.<br>";
}

function loadTables() {
    $reservationManager = new ReservationManager();
    $tables = $reservationManager->getTables();
    echo "Loaded " . count($tables) . " tables.<br>";
}

function loadCustomers() {
    global $pdo;
    $stmt = $pdo->query('SELECT COUNT(*) as count FROM customers');
    $count = $stmt->fetch()['count'];
    echo "Loaded " . $count . " customers.<br>";
}

function loadReservations() {
    global $pdo;
    $stmt = $pdo->query('SELECT COUNT(*) as count FROM reservations');
    $count = $stmt->fetch()['count'];
    echo "Loaded " . $count . " reservations.<br>";
}

function loadOrders() {
    global $pdo;
    $stmt = $pdo->query('SELECT COUNT(*) as count FROM orders');
    $count = $stmt->fetch()['count'];
    echo "Loaded " . $count . " orders.<br>";
}

function loadReviews() {
    global $pdo;
    $stmt = $pdo->query('SELECT COUNT(*) as count FROM reviews');
    $count = $stmt->fetch()['count'];
    echo "Loaded " . $count . " reviews.<br>";
}

function loadSalesRecords() {
    $salesRecord = new SalesRecord();
    $sales = $salesRecord->getSalesRecords();
    echo "Loaded " . count($sales) . " sales records.<br>";
}

function analyzeData() {
    $analysis = new Analysis();
    $totalSales = $analysis->analyzeSalesData();
    $totalReviews = $analysis->analyzeReviews();
    echo "Total Sales: $" . $totalSales . "<br>";
    echo "Total Reviews: " . $totalReviews . "<br>";
}

// Initialize System
echo "<h1>Bootstrap Process</h1>";
echo "<h2>System Initialization</h2>";
checkDatabaseConnection($pdo);

// Menu and Items Setup
echo "<h2>Menu and Items Setup</h2>";
loadMenuItems();

// Table and Reservation Setup
echo "<h2>Table and Reservation Setup</h2>";
loadTables();

// Customer Management
echo "<h2>Customer Management</h2>";
loadCustomers();

// Order Processing Setup
echo "<h2>Order Processing Setup</h2>";
loadOrders();

// Review Collection and Management
echo "<h2>Review Collection and Management</h2>";
loadReviews();

// Sales and Analysis
echo "<h2>Sales and Analysis</h2>";
loadSalesRecords();
analyzeData();

echo "<h2>Bootstrap Process Completed</h2>";
?>
