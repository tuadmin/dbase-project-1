<?php
session_start();

// Redirect to login if user is not authenticated
if (!isset($_SESSION['user_logged_in'])) {
    header('Location: login.php');
    exit();
}

define('DB_HOST', 'localhost');
define('DB_NAME', 'properties');
define('DB_USER', 'user name');
define('DB_PASS', 'whatever password');

try {
    $pdo = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>
