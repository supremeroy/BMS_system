<?php
@include 'config.php';
session_start();

// Check if the user is logged in
if (!isset($_SESSION['email'])) {
    header('location:login.php');
    exit;
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve form data
    $product_id = $_POST['product_name'];
    $quantity_sold = $_POST['quantity_sold'];
    $price_per_unit = $_POST['price_per_unit'];
    $total_sale = $_POST['total_sale'];
    $sale_date = date('Y-m-d H:i:s'); // Current date and time
    $payment_method = $_POST['payment_method'];
    $amount_given = $_POST['amount_given'];
    $change_amount = $_POST['change_amount'];

    // Prepare SQL statement to insert sales data
    $insert_stmt = $pdo->prepare("INSERT INTO sales (product_id, quantity_sold, price_per_unit, total_sale, sale_date, payment_method, amount_given, change_amount) 
                                   VALUES (:product_id, :quantity_sold, :price_per_unit, :total_sale, :sale_date, :payment_method, :amount_given, :change_amount)");

    // Bind parameters
    $insert_stmt->bindParam(':product_id', $product_id);
    $insert_stmt->bindParam(':quantity_sold', $quantity_sold);
    $insert_stmt->bindParam(':price_per_unit', $price_per_unit);
    $insert_stmt->bindParam(':total_sale', $total_sale);
    $insert_stmt->bindParam(':sale_date', $sale_date);
    $insert_stmt->bindParam(':payment_method', $payment_method);
    $insert_stmt->bindParam(':amount_given', $amount_given);
    $insert_stmt->bindParam(':change_amount', $change_amount);


    
    // Execute the statement
    if ($insert_stmt->execute()) {
        // Redirect or display a success message
        header('Location: sales.php?success=1');
        exit;
    } else {
        // Handle error
        echo "Error: Could not record the sale.";
    }
}

// Prepare SQL statement to fetch products data
$stmt = $pdo->prepare("SELECT id, product_name FROM bakery_products");
$stmt->execute();
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);


$stmt = $pdo->prepare("SELECT s.id, p.product_name, s.quantity_sold, s.price_per_unit, s.total_sale, s.sale_date, s.payment_method, s.amount_given, s.change_amount 
                        FROM sales s 
                        JOIN bakery_products p ON s.product_id = p.id 
                        ORDER BY s.sale_date DESC");
$stmt->execute();
$sales = $stmt->fetchAll(PDO::FETCH_ASSOC);
 if (isset($_GET['success'])): ?>
<p style="color: green;">Sale recorded successfully!</p>
<?php endif; ?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Sale</title>
    <link rel="stylesheet" href="style.css"> <!-- Optional CSS file -->
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
            <li><a href="stock.php">STOCK</a></li>
            <li><a href="logout.php">LOGOUT</a></li>
        </ul>
    </nav>

    <div class="form-container">

        <form action="sales.php" method="POST">
            <h1 class="h2title">Add Sale</h1>
            <br>
            <label for="product_name">Product:</label>
            <select name="product_name" id="product_name" required>
                <option value="">Select a product</option>
                <?php foreach ($products as $product): ?>
                <option value="<?= $product['id']; ?>"><?= $product['product_name']; ?></option>
                <?php endforeach; ?>
            </select>


            <label for="price_per_unit">Price Per Unit:</label>
            <input type="number" name="price_per_unit" id="price_per_unit" required>

            <label for="quantity_sold">Quantity Sold:</label>
            <input type="number" name="quantity_sold" id="quantity_sold" required>

            <label for="total_sale">Total Sale:</label>
            <input type="number" name="total_sale" id="total_sale" required>

            <label for="payment_method">Payment Method:</label>
            <select name="payment_method" id="payment_method" required>
                <option value="cash">Cash</option>
                <option value="mpesa">M-Pesa</option>

            </select>

            <label for="amount_given">Amount Given:</label>
            <input type="number" name="amount_given" id="amount_given" required>

            <label for="change_amount">Change Amount:</label>
            <input type="number" name="change_amount" id="change_amount" required>

            <input type="submit" value="Add Sale" class="form-btn">
        </form>


        <div class="table-container">
            <h1 class="h2title">Sales Data</h1>

            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Product Name</th>
                        <th>Quantity Sold</th>
                        <th>Price Per Unit</th>
                        <th>Total Sale</th>
                        <th>Sale Date</th>
                        <th>Payment Method</th>
                        <th>Amount Given</th>
                        <th>Change Amount</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (count($sales) > 0): ?>
                    <?php foreach ($sales as $sale): ?>
                    <tr>
                        <td><?= htmlspecialchars($sale['id']); ?></td>
                        <td><?= htmlspecialchars($sale['product_name']); ?></td>
                        <td><?= htmlspecialchars($sale['quantity_sold']); ?></td>
                        <td><?= htmlspecialchars($sale['price_per_unit']); ?></td>
                        <td><?= htmlspecialchars($sale['total_sale']); ?></td>
                        <td><?= htmlspecialchars($sale['sale_date']); ?></td>
                        <td><?= htmlspecialchars($sale['payment_method']); ?></td>
                        <td><?= htmlspecialchars($sale['amount_given']); ?></td>
                        <td><?= htmlspecialchars($sale['change_amount']); ?></td>
                    </tr>
                    <?php endforeach; ?>
                    <?php else: ?>
                    <tr>
                        <td colspan="9">No sales data available.</td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        <script src="script.js"></script>
</body>

</html>