<?php
require 'config.php';

$phone = $_GET['phone'] ?? '';
header('Content-Type: application/json');
if ($phone) {
    $stmt = $pdo->prepare("SELECT CONTACT, PROPERTY_NAME, PHONE_NUMBER FROM properties WHERE PHONE_NUMBER LIKE :phone");
    $stmt->execute(['phone' => $phone . '%']);
    $duplicates = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode(['duplicates' => $duplicates]);
} else {
    echo json_encode(['duplicates' => []]);
}

