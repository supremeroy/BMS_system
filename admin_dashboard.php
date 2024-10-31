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

//fetch monthly operational bills
$sqlBills = "SELECT * FROM monthly_operational_bills";
$resultBills = mysqli_query($conn, $sqlBills);

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
    <div class="dashboard">
        <div class="sidebar">
            <ul>
                <li><a class="active" href="admin_dashboard.php">Dashboard</a></li>
                <li><a href="#employee">Employee</a></li>
                <li><a href="#equipment">Inventory</a></li>
                <li><a href="#operational-bills">Bills</a>
                <li>

            </ul>
        </div>
        <div class="main-content">
            <h2 class="h2title">WELCOME TO THE ADMIN DASHBOARD
                <br>

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
            <div class="print-button-container">
                <button class="print" onclick="printTable()">
                    PRINT REPORT
                </button>
            </div>
            <section id="employee">
                <h2 class="h2title">Employee Directory</h2>

                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>ID Number</th>
                            <th>Hiring Date
                            <th>Salary (Ksh)</th>
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
            </section>
            <br>
            <section id="equipment">
                <h2 class="h2title">Bakery Equipment Inventory</h2>
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Item Name</th>
                            <th>Category</th>
                            <th>Serial Number</th>
                            <th>Purchase Date</th>
                            <th>Purchase Cost (Ksh)</th>

                            <th>Status</th>
                            <th>Last Service</th>
                            <th>Maintenance Schedule</th>
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
                    echo "<td>" . $row["purchase_date"] . "</td>";                    echo "<td>" . number_format($row["purchase_cost"], 2) . "</td>";

                    echo "<td>" . $row["status"] . "</td>";
                    echo "<td>" . $row["last_service"] . "</td>";
                    echo "<td>" . $row["maintenance_schedule"] . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='9'>No equipment found.</td></tr>";
            }
            ?>
                    </tbody>
                </table>
            </section>


            <section id="operational-bills">
                <h2 class="h2title">Monthly Operational Bills</h2>
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Month</th>
                            <th>Year</th>
                            <th>Electricity Bill (Ksh)</th>
                            <th>Water Bill (Ksh)</th>
                            <th>Rent (Ksh)</th>
                            <th>Salaries (Ksh)</th>
                            <th>Other Expenses (Ksh)</th>
                            <th>Total (Ksh)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
        
            if (mysqli_num_rows($resultBills) > 0) {
                while($row = mysqli_fetch_assoc($resultBills)) {
                    echo "<tr>";
                    echo "<td>" . $row["id"] . "</td>";
                    echo "<td>" . $row["month"] . "</td>";
                    echo "<td>" . $row["year"] . "</td>";
                    echo "<td>" . number_format($row["electricity_bill"], 2) . "</td>";
                    echo "<td>" . number_format($row["water_bill"], 2) . "</td>";
                    echo "<td>" . number_format($row["rent"], 2) . "</td>";
                    echo "<td>" . number_format($row["salaries"], 2) . "</td>";
                    echo "<td>" . number_format($row["other_expenses"], 2) . "</td>";
                    echo "<td>" . number_format($row["total"], 2) . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='9'>No bills found.</td></tr>";
            }
            ?>
                    </tbody>
                </table>
            </section>



            <script>
            function printTable() {
                window.print();
            }
            </script>
        </div>
    </div>
</body>

</html>