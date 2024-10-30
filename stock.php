<?php
@include 'config.php'; // Include your database configuration file

session_start();
if (!isset($_SESSION['email'])) {
    header('location:login.php');
    exit;
}

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get form data
    $product_name = trim($_POST['product_name']);
    $supplier_name = trim($_POST['supplier_name']);
    $quantity = (int)$_POST['quantity'];
    $price = (float)$_POST['price'];
    $expiry_date = $_POST['expiry_date']; // Get the expiry date


    // Validate input
    if (empty($product_name) || empty($supplier_name) || $quantity <= 0 || $price < 0) {
        echo "Please fill in all fields correctly.";
        exit;
    }

    // Prepare SQL statement to insert stock data
     $stmt = $pdo->prepare("INSERT INTO stock (product_name, supplier_name, quantity, price, expiry_date, created_at) VALUES (?, ?, ?, ?, ?, NOW())");

    // Execute the statement
    if ($stmt->execute([$product_name, $supplier_name, $quantity, $price])) {
        echo "Stock added successfully!";
    } else {
        echo "Error adding stock.";
    }

}

$stmt = $pdo->prepare("SELECT * FROM stock");
$stmt->execute();
$stocks = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stock</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700&display=swap" rel="stylesheet">


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
            <li><a class="active" href="stock.php">STOCKS</a></li>
            <li><a href="sales.php">SALES</a></li>
            <li><a href="logout.php">LOGOUT</a></li>


        </ul>
    </nav>
    <div class="form-container">

        <form action="" method="POST">
            <h2>Add Stock from Supplier</h2>
            <br>


            <label for="product_name">Product Name:</label>
            <input type="text" id="product_name" name="product_name" required>
            <br><br>

            <label for="supplier_name">Supplier Name:</label>
            <input type="text" id="supplier_name" name="supplier_name" required>
            <br><br>

            <label for="quantity">Quantity Received:</label>
            <input type="number" id="quantity" name="quantity" required>
            <br><br>

            <label for="price">Price per Unit:</label>
            <input type="number" step="0.01" id="price" name="price" required>
            <br><br>

            <label for="expiry_date">Expiry Date:</label>
            <input type="date" id="expiry_date" name="expiry_date" required>
            <br><br>

            <input type="submit" value="Add Stock" class="form-btn">
        </form>
    </div>

    <div class="table-container">
        <h2 class="h2title">Available Stock</h2>
        <table>
            <thead>
                <tr>
                    <th>Product Name</th>
                    <th>Supplier Name</th>
                    <th>Quantity</th>
                    <th>Price per Unit</th>
                    <th>Date Added</th>
                    <th>Expiry Date</th>
                </tr>
            </thead>
            <tbody>
                <?php if (count($stocks) > 0): ?>
                <?php foreach ($stocks as $stock): ?>
                <tr>
                    <td><?php echo htmlspecialchars($stock['product_name']); ?></td>
                    <td><?php echo htmlspecialchars($stock['supplier_name']); ?></td>
                    <td><?php echo htmlspecialchars($stock['quantity']); ?></td>
                    <td><?php echo htmlspecialchars(number_format($stock['price'], 2)); ?></td>
                    <td><?php echo htmlspecialchars($stock['created_at']); ?></td>
                    <td><?php echo htmlspecialchars($stock['expiry_date']); ?></td>
                </tr>
                <?php endforeach; ?>
                <?php else: ?>
                <tr>
                    <td colspan="5">No stock available.</td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>
<script src="script.js">

</script>

</html>