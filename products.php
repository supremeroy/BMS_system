<?php

@include 'config.php';
session_start();
if (!isset($_SESSION['email'])) {
    header('location:login.php');
    exit;
}

if (!isset($pdo)) {
    die("Database connection failed."); // Check if $pdo is defined
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $product_name = $_POST['product_name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];
    $expiry_date = $_POST['expiry_date']; // Get the expiry date

    // Prepare an SQL statement to prevent SQL injection
    $stmt = $pdo->prepare("INSERT INTO bakery_products (product_name, description, price, quantity ,expiry_date) VALUES (:product_name, :description, :price, :quantity, :expiry_date)");

    // Bind parameters to the SQL query
    $stmt->bindParam(':product_name', $product_name);
    $stmt->bindParam(':description', $description);
    $stmt->bindParam(':price', $price);
    $stmt->bindParam(':quantity', $quantity);
    $stmt->bindParam(':expiry_date', $expiry_date);

    // Execute the statement
    if ($stmt->execute()) {
        echo "Product added successfully!";
    } else {
        echo "Error adding product.";
    }
}

$stmt = $pdo->query("SELECT * FROM bakery_products");
$products = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
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
            <li><a class="active" href="products.php">PRODUCTS</a></li>
            <li><a href="orders.php">ORDERS</a></li>
            <li><a href="stock.php">STOCK</a></li>
            <li><a href="sales.php">SALES</a></li>
            <li><a href="logout.php">LOGOUT</a></li>
        </ul>
    </nav>

    <div class="form-container">

        <form action="" method="POST">
            <h2 class="h2title">Add Bakery Product</h2>
            <label for="product_name">Product Name:</label>
            <input type="text" id="product_name" name="product_name" required>
            <br>
            <br>
            <label for="description">Description:</label>
            <br>
            <br>
            <textarea id="description" name="description" rows="4"></textarea>
            <br>
            <br>
            <label for="price">Price (ksh):</label>
            <input type="number" step="0.01" id="price" name="price" required>
            <br>
            <br>
            <label for="quantity">Quantity:</label>
            <input type="number" id="quantity" name="quantity" required>
            <br>
            <br>
            <label for="expiry_date">Expiry Date:</label>
            <input type="date" id="expiry_date" name="expiry_date" required>
            <br>
            <br>
            <input type="submit" name="submit" value="Add Product" class="form-btn">
        </form>
        <?php if (isset($message)): ?>
        <p><?php echo $message; ?></p> <!-- Display success or error message -->
        <?php endif; ?>
    </div>
    </div>
    <div class="table-container">
        <h2 class="h2title">Bakery Products</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Product Name</th>
                    <th>Description</th>
                    <th>Price (ksh)</th>
                    <th>Quantity</th>
                    <th>Created At</th>
                    <th>Expiry Date</th>

                </tr>
            </thead>
            <tbody>
                <?php if ($products): ?>
                <?php foreach ($products as $product): ?>
                <tr>
                    <td><?php echo htmlspecialchars($product['id']); ?></td>
                    <td><?php echo htmlspecialchars($product['product_name']); ?></td>
                    <td><?php echo htmlspecialchars($product['description']); ?></td>
                    <td><?php echo htmlspecialchars($product['price']); ?></td>
                    <td><?php echo htmlspecialchars($product['quantity']); ?></td>
                    <td><?php echo htmlspecialchars($product['created_at']); ?></td>\
                    <td><?php echo htmlspecialchars($product['expiry_date']); ?></td>

                </tr>
                <?php endforeach; ?>
                <?php else: ?>
                <tr>
                    <td colspan="7">No products found.</td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>
<script src="script.js">

</script>

</html>