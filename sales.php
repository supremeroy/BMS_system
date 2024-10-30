<?php
@include 'config.php';
session_start();

// Check if the user is logged in
if (!isset($_SESSION['email'])) {
    header('location:login.php');
    exit;
}

// Initialize a variable for the success message
$success_message = '';

// Check if the form has been submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get form data and validate
    $product_name = $_POST['product_name'] ?? null; // Use null coalescing operator
    $quantity_sold = $_POST['quantity_sold'] ?? null;
    $price_per_unit = $_POST['price_per_unit'] ?? null;
    $total_sale = $_POST['total_sale'] ?? null;
    $payment_method = $_POST['payment_method'] ?? null;
    $amount_given = $_POST['amount_given'] ?? null;
    $change_amount = $_POST['change_amount'] ?? null;

    // Basic validation
    if ($product_name && $quantity_sold && $price_per_unit && $total_sale && $payment_method) {
        try {
            // Prepare SQL statement to insert sale data
            $stmt = $pdo->prepare("INSERT INTO sales (product_id, quantity_sold, price_per_unit, total_sale, sale_date, payment_method, amount_given, change_amount) VALUES (?, ?, ?, ?, NOW(), ?, ?, ?)");

            // Execute the statement with the form data
            $stmt->execute([$product_name, $quantity_sold, $price_per_unit, $total_sale, $payment_method, $amount_given, $change_amount]);

            // Set success message
            $success_message = "Sale recorded successfully!";
        } catch (PDOException $e) {
            // Handle the exception
            echo "Error: " . $e->getMessage();
        }
    } else {
        echo "Please fill in all required fields.";
    }
}

// Prepare SQL statement to fetch products data
$stmt = $pdo->prepare("SELECT id, product_name, price FROM bakery_products");
$stmt->execute();
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Prepare SQL statement to fetch sales data
$sales_stmt = $pdo->prepare("SELECT sales.id, 
                                      bakery_products.product_name, 
                                      sales.quantity_sold, 
                                      sales.price_per_unit, 
                                      sales.total_sale, 
                                      sales.sale_date, 
                                      sales.payment_method, 
                                      sales.amount_given, 
                                      sales.change_amount
                              FROM sales
                              JOIN bakery_products ON sales.product_id = bakery_products.id
                              ORDER BY sales.sale_date DESC");
$sales_stmt->execute();
$sales_data = $sales_stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sales</title>
    <link rel="stylesheet" href="style.css">

</head>

<body>
    <nav>
        <label class="logo">DESTINY BAKERY PRODUCTS</label>
        <ul>
            <li><a href="index.html">Home</a></li>
            <li><a href="admin_dashboard.php">DASHBOARD</a></li>
            <li><a href="recipes.php">RECIPES</a></li>
            <li><a href="products.php">PRODUCTS</a></li>
            <li><a href="orders.php">ORDERS</a></li>
            <li><a class="active" href="sales.php">SALES</a></li>
            <li><a href="stock.php">STOCKS</a></li>
            <li><a href="logout.php">LOGOUT</a></li>
        </ul>
    </nav>

    <div class="form-container">

        <form action="" method="POST">
            <h2>Record Sale</h2>
            <br>
            <label for="product_name">Product Name:</label>
            <select id="product_name" name="product_name" onchange="updatePrice()" required>
                <option value="">Select a product</option>
                <?php foreach ($products as $product): ?>
                <option value="<?php echo htmlspecialchars($product['id']); ?>"
                    data-price="<?php echo htmlspecialchars($product['price']); ?>">
                    <?php echo htmlspecialchars($product['product_name']); ?>
                </option>
                <?php endforeach; ?>
            </select>
            <br><br>

            <label for="quantity_sold">Quantity Sold:</label>
            <input type="number" id="quantity_sold" name="quantity_sold" required oninput="calculateTotal()">
            <br><br>

            <label for="price_per_unit">Price per Unit:</label>
            <input type="number" step="0.01" id="price_per_unit" name="price_per_unit" required readonly>
            <br><br>


            <label for="total_sale">Total Sale Amount:</label>
            <input type="number" step="0.01" id="total_sale" name="total_sale" required readonly>
            <br><br>
            <label for="payment_method">Payment Method:</label>
            <select id="payment_method" name="payment_method" required onchange="toggleCashFields()">
                <option value="">Select a payment method</option>
                <option value="cash">Cash</option>
                <option value="mpesa">M-Pesa</option>
            </select>
            <br><br>

            <div id="cash_fields" style="display:none;">
                <label for="amount_given">Amount Given:</label>
                <input type="number" id="amount_given" name="amount_given" step="0.01" oninput="calculateChange()">
                <br><br>

                <label for="change_amount">Change Amount:</label>
                <input type="number" step="0.01" id="change_amount" name="change_amount" readonly>
                <br><br>

                <div id="mpesa_fields" style="display:none;">
                    <label for="mpesa_phone">M-Pesa Phone Number:</label>
                    <input type="tel" id="mpesa_phone" name="mpesa_phone" placeholder="Enter phone number" required>
                    <br><br>
                </div>
                <input type="submit" value="Add Sale" class="form-btn">

        </form>
    </div>
    <br>
    <br>
    <div class="sales-table">
        <h2 class="h2title">Sales Records</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Product Name</th>
                    <th>Quantity Sold</th>
                    <th>Price per Unit</th>
                    <th>Total Sale</th>
                    <th>Payment Method</th>
                    <th>Amount Given</th>
                    <th>Change Amount</th>
                    <th>Sale Date</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($sales_data as $sale): ?>
                <tr>
                    <td><?php echo htmlspecialchars($sale['id']); ?></td>
                    <td><?php echo htmlspecialchars($sale['product_name']); ?></td>
                    <td><?php echo htmlspecialchars($sale['quantity_sold']); ?></td>
                    <td><?php echo htmlspecialchars($sale['price_per_unit']); ?></td>
                    <td><?php echo htmlspecialchars($sale['total_sale']); ?></td>
                    <td><?php echo htmlspecialchars($sale['payment_method']); ?></td>
                    <td><?php echo htmlspecialchars($sale['amount_given']); ?></td>
                    <td><?php echo htmlspecialchars($sale['change_amount']); ?></td>
                    <td><?php echo htmlspecialchars($sale['sale_date']); ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
<script src="script.js">

</script>

</html>