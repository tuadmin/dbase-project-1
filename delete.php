<?php
require 'config.php';


if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("Invalid request.");
}

$recordId = $_GET['id'];

$stmt = $pdo->prepare("DELETE FROM properties WHERE RECORD_ID = :id");
$stmt->bindParam(':id', $recordId, PDO::PARAM_INT);

if ($stmt->execute()) {
    header("Location: list.php?message=Record Deleted Successfully");
    exit();
} else {
    echo "Error deleting record.";
}
?>
