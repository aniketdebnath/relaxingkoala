<?php
session_start();
require_once '../includes/auth.php';
checkAuthentication();
checkAdmin();

require_once '../classes/Manager.class.php';

try {
    $managerId = $_SESSION['user_id']; // Assuming manager is logged in
    $manager = new Manager($managerId);

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (isset($_POST['add'])) {
            $name = $_POST['name'];
            $description = $_POST['description'];
            $price = $_POST['price'];
            
            $manager->addItem($name, $description, $price);
        } elseif (isset($_POST['delete'])) {
            $id = $_POST['id'];
            $manager->deleteItem($id);
        }
    }

    $menuManager = MenuManager::getInstance();
    $items = $menuManager->getItems();
} catch (Exception $e) {
    echo 'Error: ' . $e->getMessage();
}

include '../includes/header.php';
?>

<h1>Manage Menu</h1>
<h2>Add New Item</h2>
<form method="post" action="manage_menu.php">
    <label for="name">Name:</label>
    <input type="text" id="name" name="name" required><br>
    <label for="description">Description:</label>
    <textarea id="description" name="description" required></textarea><br>
    <label for="price">Price:</label>
    <input type="number" id="price" name="price" step="0.01" required><br>
    <button type="submit" name="add">Add Item</button>
</form>

<h2>Existing Menu Items</h2>
<ul>
    <?php foreach ($items as $item): ?>
        <li>
            <strong><?php echo htmlspecialchars($item['name']); ?></strong> - <?php echo htmlspecialchars($item['description']); ?> - $<?php echo number_format($item['price'], 2); ?>
            <form method="post" action="manage_menu.php" style="display:inline;">
                <input type="hidden" name="id" value="<?php echo $item['id']; ?>">
                <button type="submit" name="delete">Delete</button>
            </form>
        </li>
    <?php endforeach; ?>
</ul>

<?php include '../includes/footer.php'; ?>
