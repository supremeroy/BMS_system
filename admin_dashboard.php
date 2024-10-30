<?php
@include 'config.php'; // Include your database configuration
session_start();
if (!isset($_SESSION['email'])) {
    header('location:login.php');
    exit;
}

// Function to get the count of records
function getCount($table) {
    global $conn; // Use the database connection from config
    $query = "SELECT COUNT(*) as count FROM $table";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    return $row['count'];
}

// Fetch counts
$stockCount = getCount('stock');
$productCount = getCount('bakery_products');
$salesCount = getCount('sales');

$sql = "SELECT id, name, id_number, hiring_date, salary FROM employees";
$result = mysqli_query($conn, $sql);

// Fetch bakery equipment inventory data
$sqlEquipment = "SELECT * FROM bakery_equipment_inventory";
$resultEquipment = mysqli_query($conn, $sqlEquipment);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <nav>
        <label class="logo">DESTINY BAKERY PRODUCTS</label>
        <ul>
            <li><a href="index.html">Home</a></li>
            <li><a class="active" href="admin_dashboard.php">DASHBOARD</a></li>
            <li><a href="recipes.php">RECIPES</a></li>
            <li><a href="products.php">PRODUCTS</a></li>
            <li><a href="orders.php">ORDERS</a></li>
            <li><a href="stock.php">STOCKS</a></li>
            <li><a href="sales.php">SALES</a></li>
            <li><a href="logout.php">LOGOUT</a></li>
        </ul>
    </nav>
    <br>
    <br>
    <h2 class="h2title">WELCOME TO THE ADMIN DASHBOARD
        <br>
        <p style="font-size: medium;">We're excited to have you onboard! This dashboard is
            designed to simplify your management tasks and keep the bakery running smoothly.<br>From tracking ingredient
            inventory and monitoring equipment to managing orders and analyzing sales performance, everything you need
            is right here.</p>
    </h2>

    <br><br>
    <h2 class="h2title">Counts Overview</h2>
    <div class="dashboard-stats">
        <div class="stat-item">
            <h3>Number of Stock Items</h3>
            <p><?php echo $stockCount; ?></p>
        </div>
        <div class="stat-item">
            <h3>Number of Products</h3>
            <p><?php echo $productCount; ?></p>
        </div>
        <div class="stat-item">
            <h3>Number of Sales</h3>
            <p><?php echo $salesCount; ?></p>
        </div>
    </div>
    <br>
    <br>
    <br>
    <h2 class="h2title">Employee Directory</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>ID Number</th>
                <th>Hiring Date</th>
                <th>Salary</th>
            </tr>
        </thead>
        <tbody>
            <?php
     
            if (mysqli_num_rows($result) > 0) {
                while($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . $row["id"] . "</td>";
                    echo "<td>" . $row["name"] . "</td>";
                    echo "<td>" . $row["id_number"] . "</td>";
                    echo "<td>" . $row["hiring_date"] . "</td>";
                    echo "<td>" . number_format($row["salary"], 2) . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='5'>No employees found.</td></tr>";
            }

            mysqli_close($conn);
            ?>
        </tbody>
    </table>

    <br>
    <h2 class="h2title">Bakery Equipment Inventory</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Item Name</th>
                <th>Category</th>
                <th>Serial Number</th>
                <th>Purchase Date</th>
                <th>Status</th>
                <th>Last Service</th>
                <th>Maintenance Schedule</th>
                <th>Purchase Cost</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (mysqli_num_rows($resultEquipment) > 0) {
                while($row = mysqli_fetch_assoc($resultEquipment)) {
                    echo "<tr>";
                    echo "<td>" . $row["id"] . "</td>";
                    echo "<td>" . $row["item_name"] . "</td>";
                    echo "<td>" . $row["category"] . "</td>";
                    echo "<td>" . $row["serial_no"] . "</td>";
                    echo "<td>" . $row["purchase_date"] . "</td>";
                    echo "<td>" . $row["status"] . "</td>";
                    echo "<td>" . $row["last_service"] . "</td>";
                    echo "<td>" . $row["maintenance_schedule"] . "</td>";
                    echo "<td>" . number_format($row["purchase_cost"], 2) . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='9'>No equipment found.</td></tr>";
            }
            ?>
        </tbody>
    </table>


</body>

</html>