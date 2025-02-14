<?php


ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
require 'config.php';

$id = $_GET['id'] ?? null;
$property = $id ? $pdo->query("SELECT * FROM properties WHERE RECORD_ID = $id")->fetch(PDO::FETCH_ASSOC) : null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['RECORD_ID'];
  $data = [
    'PROPERTY_NAME' => $_POST['PROPERTY_NAME'],
    'CONTACT' => $_POST['CONTACT'],
    'HOUSE_NUMBER' => $_POST['HOUSE_NUMBER'],
    'STREET_NAME' => $_POST['STREET_NAME'],
    'CITY' => $_POST['CITY'],
    'STATE' => $_POST['STATE'],
    'ZIPCODE' => $_POST['ZIPCODE'],
    'DISTRICT' => $_POST['DISTRICT'],
    'CITY_PERMITABLE' => $_POST['CITY_PERMITABLE'] ?? null, 
    'ISHOA' => $_POST['ISHOA'] ?? null, // Ensure NULL
    'HOA_ALLOWED' => ($_POST['ISHOA'] === 'yes') ? ($_POST['HOA_ALLOWED'] ?? null) : null, 
    'PHONE_NUMBER' => $_POST['PHONE_NUMBER'],
    'STATUS' => isset($_POST['STATUS']) ? 'yes' : 'no',
    'NOTES' => $_POST['NOTES']
];


    if ($id) {
        $sql = "UPDATE properties SET 
                    PROPERTY_NAME = :PROPERTY_NAME, CONTACT = :CONTACT, 
                    HOUSE_NUMBER = :HOUSE_NUMBER, STREET_NAME = :STREET_NAME, CITY = :CITY, 
                    STATE = :STATE, ZIPCODE = :ZIPCODE, DISTRICT = :DISTRICT, 
                    CITY_PERMITABLE = :CITY_PERMITABLE, ISHOA = :ISHOA, HOA_ALLOWED = :HOA_ALLOWED, 
                    PHONE_NUMBER = :PHONE_NUMBER, STATUS = :STATUS, NOTES = :NOTES
                WHERE RECORD_ID = :RECORD_ID";
        $stmt = $pdo->prepare($sql);
        $data['RECORD_ID'] = $id;
    } else {
        $sql = "INSERT INTO properties 
                (PROPERTY_NAME, CONTACT, HOUSE_NUMBER, STREET_NAME, CITY, STATE, ZIPCODE, DISTRICT, 
                CITY_PERMITABLE, ISHOA, HOA_ALLOWED, PHONE_NUMBER, STATUS, NOTES) 
                VALUES 
                (:PROPERTY_NAME, :CONTACT, :HOUSE_NUMBER, :STREET_NAME, :CITY, :STATE, :ZIPCODE, :DISTRICT, 
                :CITY_PERMITABLE, :ISHOA, :HOA_ALLOWED, :PHONE_NUMBER, :STATUS, :NOTES)";
        $stmt = $pdo->prepare($sql);
    }

    $stmt->execute($data);
    header('Location: list.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $id ? 'Edit' : 'Add' ?> Property</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f9f9f9;
        }
        .form-container {
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            padding: 30px;
            max-width: 500px;
            margin: 40px auto;
        }
        .btn-danger {
            margin-top: 10px;
        }
    </style>
    <script>
        function toggleHOAField() {
            const isHOA = document.getElementById('ISHOA').value;
            const hoaAllowedField = document.getElementById('hoa-allowed-field');

            if (isHOA === 'yes') {
                hoaAllowedField.style.display = 'block';
            } else {
                hoaAllowedField.style.display = 'none';
                document.getElementById('HOA_ALLOWED').value = null; // Reset HOA_ALLOWED if HOA is not applicable
            }
        }

        function checkDuplicatePhone() {
            const phoneInput = document.getElementById('PHONE_NUMBER').value;
            const matchResults = document.getElementById('duplicate-matches');
            if (phoneInput.length < 3) {
                matchResults.innerHTML = "";
                return;
            }

            fetch('check_duplicates.php?phone=' + phoneInput)
                .then(response => response.json())
                .then(data => {
                    if (data.length > 0) {
                        matchResults.innerHTML = "<strong>Possible Matches:</strong><br>";
                        data.forEach(entry => {
                            matchResults.innerHTML += `${entry.CONTACT} - ${entry.PHONE_NUMBER} (${entry.PROPERTY_NAME})<br>`;
                        });
                    } else {
                        matchResults.innerHTML = "";
                    }
                });
        }

        document.addEventListener('DOMContentLoaded', () => {
            toggleHOAField();
        });
        
         function formatPhoneNumber() {
            let phone = document.getElementById('PHONE_NUMBER').value;
            phone = phone.replace(/\D/g, ''); // Remove all non-numeric characters
            if (phone.length > 10) phone = phone.substring(0, 10); // Max 10 digits

            if (phone.length >= 7) {
                phone = `(${phone.substring(0, 3)}) ${phone.substring(3, 6)}-${phone.substring(6)}`;
            } else if (phone.length >= 4) {
                phone = `(${phone.substring(0, 3)}) ${phone.substring(3)}`;
            } else if (phone.length >= 1) {
                phone = `(${phone}`;
            }
            document.getElementById('PHONE_NUMBER').value = phone;
        }


        function toggleHOAField() {
    const isHOA = document.getElementById('ISHOA').value;
    const hoaAllowedField = document.getElementById('hoa-allowed-field');

    if (isHOA === 'yes') {
        hoaAllowedField.style.display = 'block';
    } else {
        hoaAllowedField.style.display = 'none';
        document.getElementById('HOA_ALLOWED').value = ''; // Reset HOA_ALLOWED if HOA is not applicable
    }
}

document.addEventListener('DOMContentLoaded', () => {
    toggleHOAField();
});

    </script>
</head>
<body>
<div class="container">
    <div class="form-container">
        <h1 class="text-center"><?= $id ? 'Edit' : 'Add' ?> Property</h1>

        <form method="POST">
    <input type="hidden" name="RECORD_ID" value="<?= htmlspecialchars($property['RECORD_ID'] ?? '') ?>">

    <div class="mb-3">
        <label class="form-label">Status</label>
        <input type="checkbox" name="STATUS" <?= (isset($property['STATUS']) && $property['STATUS'] === 'yes') ? 'checked' : '' ?>> Active
    </div>

    <div class="mb-3">
        <label class="form-label">Property Name</label>
        <input type="text" class="form-control" name="PROPERTY_NAME" value="<?= htmlspecialchars($property['PROPERTY_NAME'] ?? '') ?>" required>
    </div>

    <div class="mb-3">
        <label class="form-label">District</label>
        <input type="text" class="form-control" name="DISTRICT" value="<?= htmlspecialchars($property['DISTRICT'] ?? '') ?>">
    </div>

    <div class="mb-3">
        <label class="form-label">Contact Person</label>
        <input type="text" class="form-control" name="CONTACT" value="<?= htmlspecialchars($property['CONTACT'] ?? '') ?>">
    </div>

    <div class="mb-3">
        <label class="form-label">Address Number</label>
        <input type="text" class="form-control" name="HOUSE_NUMBER" value="<?= htmlspecialchars($property['HOUSE_NUMBER'] ?? '') ?>" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Address Street</label>
        <input type="text" class="form-control" id="STREET_NAME" name="STREET_NAME" value="<?= htmlspecialchars($property['STREET_NAME'] ?? '') ?>">
    </div>

    <div class="mb-3">
        <label class="form-label">City</label>
        <input type="text" class="form-control" id="CITY" name="CITY" value="<?= htmlspecialchars($property['CITY'] ?? '') ?>">
    </div>

    <div class="mb-3">
        <label class="form-label">State</label>
        <input type="text" class="form-control" id="STATE" name="STATE" value="<?= htmlspecialchars($property['STATE'] ?? '') ?>">
    </div>

    <div class="mb-3">
        <label class="form-label">ZIP Code</label>
        <input type="text" class="form-control" id="ZIPCODE" name="ZIPCODE" value="<?= htmlspecialchars($property['ZIPCODE'] ?? '') ?>">
    </div>

    <div class="mb-3">
        <label class="form-label">Phone Number</label>
        <input type="text" class="form-control" id="PHONE_NUMBER" name="PHONE_NUMBER" value="<?= htmlspecialchars($property['PHONE_NUMBER'] ?? '') ?>" onkeyup="formatPhoneNumber()">
    </div>

 <div class="mb-3">
    <label class="form-label">City Permitted</label>
    <select class="form-select" id="CITY_PERMITABLE" name="CITY_PERMITABLE">
        <option value="" <?= (!isset($property['CITY_PERMITABLE']) || is_null($property['CITY_PERMITABLE'])) ? 'selected' : '' ?>>Not Set</option>
        <option value="yes" <?= (isset($property['CITY_PERMITABLE']) && $property['CITY_PERMITABLE'] === 'yes') ? 'selected' : '' ?>>Yes</option>
        <option value="no" <?= (isset($property['CITY_PERMITABLE']) && $property['CITY_PERMITABLE'] === 'no') ? 'selected' : '' ?>>No</option>
    </select>
</div>

<div class="mb-3">
    <label class="form-label">HOA</label>
    <select class="form-select" id="ISHOA" name="ISHOA" onchange="toggleHOAField()">
        <option value="" <?= (!isset($property['ISHOA']) || is_null($property['ISHOA'])) ? 'selected' : '' ?>>Not Set</option>
        <option value="yes" <?= (isset($property['ISHOA']) && $property['ISHOA'] === 'yes') ? 'selected' : '' ?>>Yes</option>
        <option value="no" <?= (isset($property['ISHOA']) && $property['ISHOA'] === 'no') ? 'selected' : '' ?>>No</option>
    </select>
</div>

<div class="mb-3" id="hoa-allowed-field" style="display: none;">
    <label class="form-label">HOA Allowed</label>
    <select class="form-select" name="HOA_ALLOWED">
        <option value="" <?= (!isset($property['HOA_ALLOWED']) || is_null($property['HOA_ALLOWED'])) ? 'selected' : '' ?>>Not Set</option>
        <option value="yes" <?= (isset($property['HOA_ALLOWED']) && $property['HOA_ALLOWED'] === 'yes') ? 'selected' : '' ?>>Yes</option>
        <option value="no" <?= (isset($property['HOA_ALLOWED']) && $property['HOA_ALLOWED'] === 'no') ? 'selected' : '' ?>>No</option>
    </select>
</div>


    <div class="mb-3">
        <label class="form-label">Notes</label>
        <textarea class="form-control" name="NOTES" rows="3"><?= htmlspecialchars($property['NOTES'] ?? '') ?></textarea>
    </div>

    <button type="submit" class="btn btn-success w-100"><?= $id ? 'Update' : 'Add' ?> Property</button>
    <?php if ($id): ?>
        <a href="delete.php?id=<?= $property['RECORD_ID'] ?>" class="btn btn-danger w-100">Delete</a>
    <?php endif; ?>
</form>


    </div>
</div>
</body>
</html>
