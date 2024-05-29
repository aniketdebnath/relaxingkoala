<?php
session_start();
require_once '../classes/config.php';
include '../includes/header.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role = $_POST['role']; // Get the selected role

    if ($role == 'customer') {
        // Insert the new customer into the customers table
        $stmt = $pdo->prepare('INSERT INTO customers (name, email, phone, password, role) VALUES (?, ?, ?, ?, ?)');
        $stmt->execute([$name, $email, $phone, $password, $role]);
    } elseif ($role == 'admin') {
        // Insert the new admin into the admins table
        $stmt = $pdo->prepare('INSERT INTO admins (name, email, phone, password, role) VALUES (?, ?, ?, ?, ?)');
        $stmt->execute([$name, $email, $phone, $password, $role]);
    }

    // Set session variables
    $_SESSION['user_id'] = $pdo->lastInsertId();
    $_SESSION['name'] = $name;
    $_SESSION['role'] = $role;
    header("Location: index.php");
    exit();
}
?>

<h1>Sign Up</h1>
<form method="post" action="signup.php">
    <label for="name">Name:</label>
    <input type="text" id="name" name="name" required><br>
    <label for="email">Email:</label>
    <input type="email" id="email" name="email" required><br>
    <label for="phone">Phone:</label>
    <input type="text" id="phone" name="phone" required><br>
    <label for="password">Password:</label>
    <input type="password" id="password" name="password" required><br>
    <label for="role">Role:</label>
    <select id="role" name="role" required>
        <option value="customer">Customer</option>
        <option value="admin">Admin</option>
    </select><br>
    <button type="submit">Sign Up</button>
</form>

<?php include '../includes/footer.php'; ?>
