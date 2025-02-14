<?php
require 'config.php';

// Filter and Sort Parameters
$filterStatus = $_GET['status'] ?? 'active';
$sortColumn = $_GET['sort'] ?? 'STATE';
$sortOrder = $_GET['order'] ?? 'ASC';
$search = $_GET['search'] ?? '';

// Function to Convert State Abbreviations to Full Name
function getStateFullName($abbr) {
    $states = [
        "AL" => "Alabama", "AK" => "Alaska", "AZ" => "Arizona", "AR" => "Arkansas",
        "CA" => "California", "CO" => "Colorado", "CT" => "Connecticut", "DE" => "Delaware",
        "FL" => "Florida", "GA" => "Georgia", "HI" => "Hawaii", "ID" => "Idaho",
        "IL" => "Illinois", "IN" => "Indiana", "IA" => "Iowa", "KS" => "Kansas",
        "KY" => "Kentucky", "LA" => "Louisiana", "ME" => "Maine", "MD" => "Maryland",
        "MA" => "Massachusetts", "MI" => "Michigan", "MN" => "Minnesota", "MS" => "Mississippi",
        "MO" => "Missouri", "MT" => "Montana", "NE" => "Nebraska", "NV" => "Nevada",
        "NH" => "New Hampshire", "NJ" => "New Jersey", "NM" => "New Mexico", "NY" => "New York",
        "NC" => "North Carolina", "ND" => "North Dakota", "OH" => "Ohio", "OK" => "Oklahoma",
        "OR" => "Oregon", "PA" => "Pennsylvania", "RI" => "Rhode Island", "SC" => "South Carolina",
        "SD" => "South Dakota", "TN" => "Tennessee", "TX" => "Texas", "UT" => "Utah",
        "VT" => "Vermont", "VA" => "Virginia", "WA" => "Washington", "WV" => "West Virginia",
        "WI" => "Wisconsin", "WY" => "Wyoming"
    ];
    return $states[$abbr] ?? $abbr;
}

$query = "SELECT *, CONCAT(HOUSE_NUMBER, ' ', STREET_NAME)AS ADDRESS FROM properties WHERE STATUS = 'yes'";  // Default to active records only
$params = [];  // Array to store query parameters

if ($filterStatus === 'inactive') {
    $query = "SELECT * FROM properties WHERE STATUS = 'no'";
} elseif ($filterStatus === 'all') {
    $query = "SELECT * FROM properties";
}

if ($search) {
    $query .= " AND (LOWER(PROPERTY_NAME) LIKE LOWER(:search) OR LOWER(CONTACT) LIKE LOWER(:search))";
    $params['search'] = "%$search%"; // Bind the search parameter
}

$query .= " ORDER BY $sortColumn $sortOrder";

$stmt = $pdo->prepare($query);
$stmt->execute($params); // Pass only necessary parameters

$properties = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>Property List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f9f9f9;
        }
        
        .state-header {
            background-color: #f7c774;
            padding: 10px;
            font-size: 18px;
            font-weight: bold;
            border-bottom: 2px solid #e3a655;
        }

        .dot {
            height: 12px;
            width: 12px;
            border-radius: 50%;
            display: inline-block;
        }

        .dot-green {
            background-color: green;
        }

        .dot-red {
            background-color: red;
        }

        .property-notes {
            font-size: 12px;
            color: #555;
            word-wrap: break-word;
            white-space: normal;
            max-width: 400px;
            overflow-wrap: break-word;
        }

        .contact-info {
            font-size: 14px;
            line-height: 1.5;
            white-space: normal;
            max-width: 250px;
        }

        .clickable-row {
            cursor: pointer;
        }

        /* Make table responsive */
        .table-responsive {
            overflow-x: auto;
            white-space: nowrap;
        }

        /* Ensure table content fits on mobile */
        @media (max-width: 768px) {
            .table th, .table td {
                font-size: 12px;
                word-break: break-word;
            }
            
            .contact-info {
                max-width: 200px;
            }
            
            .property-notes {
                max-width: 250px;
            }
        }
    </style>
</head>
<body>
<div class="container mt-4">
    <h1 class="text-center mb-4">Property List</h1>

    <form class="row g-3 mb-4">
        <div class="col-md-4">
            <input type="text" class="form-control" name="search" value="<?= htmlspecialchars($search) ?>" placeholder="Search by Property Name or Contact">
        </div>
        <div class="col-md-3">
            <select class="form-select" name="status">
                <option value="active" <?= $filterStatus === 'active' ? 'selected' : '' ?>>Active</option>
                <option value="inactive" <?= $filterStatus === 'inactive' ? 'selected' : '' ?>>Inactive</option>
                <option value="all" <?= $filterStatus === 'all' ? 'selected' : '' ?>>All</option>
            </select>
        </div>
        <div class="col-md-2">
            <button type="submit" class="btn btn-primary w-100">Filter</button>
        </div>
    </form>
     <a href="edit.php" class="btn btn-info btn-md">Add New Property</a>
    <?php 
    $currentState = null;
    foreach ($properties as $property):
        $fullStateName = getStateFullName($property['STATE']);
        if ($property['STATE'] !== $currentState):
            if ($currentState !== null) echo '</table></div>'; // Close previous table
            $currentState = $property['STATE'];
    ?>
        <div class="state-header"><?= htmlspecialchars($fullStateName) ?></div>
       
        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>Property</th>
                        <th>Contact Info</th>
                        <th>District</th>
                        <th>City Permit</th>
                        <th>HOA</th>
                        <!-- <th>Notes</th> -->
                    </tr>
                </thead>
                <tbody>
    <?php endif; ?>
                    <tr class="clickable-row" data-href="edit.php?id=<?= $property['RECORD_ID'] ?>">
                        <td><?= htmlspecialchars($property['PROPERTY_NAME']) ?></td>
                        <td class="contact-info">
                            <?= htmlspecialchars($property['CONTACT']) ?><br>
                            <!-- ($property['HOUSE_NUMBER'] . ' ' . $property['STREET_NAME']) <br> -->
                            <?= htmlspecialchars($property['ADDRESS'] ) ?><br>
                            <?= htmlspecialchars($property['CITY'] . ', ' . getStateFullName($property['STATE']) . ' ' . $property['ZIPCODE']) ?><br>
                            <?= htmlspecialchars($property['PHONE_NUMBER']) ?>
                        </td>
                        <td><?= htmlspecialchars($property['DISTRICT'] ?? '--') ?></td>
                        <td><?= $property['CITY_PERMITABLE'] === 'yes' ? 'Yes' : 'No' ?></td>
                        <td>
                            <?= $property['ISHOA'] === 'yes' ? 'Yes' : 'No' ?>
                            <?php if ($property['ISHOA'] === 'yes'): ?>
                                <span class="dot <?= $property['HOA_ALLOWED'] === 'yes' ? 'dot-green' : 'dot-red' ?>"></span>
                            <?php endif; ?>
                        </td>
                        
                    </tr>
                    <tr>
                       
                        <td colspan="6">
                            <div class="property-notes">
                                <strong>Notes:</strong> 
                                <?= htmlspecialchars($property['NOTES'] ?? '') ?>
                            </div>
                        </td>
                    </tr>
    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
</div>

<script>
    // Clickable row to edit property
    document.querySelectorAll(".clickable-row").forEach(row => {
        row.addEventListener("click", function() {
            window.location = this.dataset.href;
        });
    });
</script>
</body>
</html>
