<?php
session_start();
require_once '../classes/config.php';
include '../includes/header.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role = $_POST['role']; // Get the selected role

    if ($role == 'customer') {
        $stmt = $pdo->prepare('SELECT id, name, email, phone, password FROM customers WHERE email = ?');
    } elseif ($role == 'admin') {
        $stmt = $pdo->prepare('SELECT id, name, email, phone, password FROM admins WHERE email = ?');
    } else {
        echo 'Invalid role selected';
        exit();
    }

    $stmt->execute([$email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['name'] = $user['name'];
        $_SESSION['role'] = $role;
        header('Location: index.php');
        exit();
    } else {
        echo 'Invalid email or password';
    }
}
?>

<h1>Login</h1>
<form method="post" action="login.php">
    <label for="email">Email:</label>
    <input type="email" id="email" name="email" required><br>
    <label for="password">Password:</label>
    <input type="password" id="password" name="password" required><br>
    <label for="role">Role:</label>
    <select id="role" name="role" required>
        <option value="customer">Customer</option>
        <option value="admin">Admin</option>
    </select><br>
    <button type="submit">Login</button>
</form>

<?php include '../includes/footer.php'; ?>
