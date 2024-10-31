<?php
    // Connect to the database
    @include 'config.php';
                $sql = "SELECT * FROM orders";
                $result = $conn->query($sql);

         // Display messages
if (isset($_GET['message'])) {
    echo "<p style='color: green;'>{$_GET['message']}</p>";
} elseif (isset($_GET['error'])) {
    echo "<p style='color: red;'>{$_GET['error']}</p>";
}
              
                ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orders</title>
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
            <li><a class="active" href="orders.php">ORDERS</a></li>
            <li><a href="stock.php">STOCK</a></li>
            <li><a href="sales.php">SALES</a></li>
            <li><a href="logout.php">LOGOUT</a></li>
        </ul>
    </nav>

    <div class="form-container">

        <form action="" method="POST">
            <h1>Cake Order Form</h1>
            <br>
            <br>
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="order_number">Order Number:</label>
            <input type="text" id="order_number" name="order_number" required>

            <label for="cake_type">Type of Cake:</label>
            <select id="cake_type" name="cake_type" required>
                <option value="Chocolate">Cheesecake</option>
                <option value="Vanilla">Blackforest</option>
                <option value="Red Velvet">Red Velvet</option>
                <option value="Carrot">ButterCake</option>
                <option value="Lemon">LemonCake</option>
            </select>
            <br>
            <label for="cake_description">Cake Description:</label>
            <br>
            <textarea id="cake_description" name="cake_description" rows="4" required></textarea>

            <br>
            <label for="date_needed">Date Needed:</label>
            <input type="date" id="date_needed" name="date_needed" required>

            <input type="submit" value="Place Order" class="form-btn">
        </form>
        <div class="table-container">
            <table>
                <h1 class="h2title">Order List</h1>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Order Number</th>
                        <th>Cake Type</th>
                        <th>Cake Description</th>
                        <th>Created At</th>
                        <th>Date Needed</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>

                    <?php
                if ($result->num_rows > 0) {
                    // Output data for each row
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>{$row['id']}</td>
                                <td>{$row['name']}</td>
                                <td>{$row['email']}</td>
                                <td>{$row['order_number']}</td>
                                <td>{$row['cake_type']}</td>
                                <td>{$row['cake_description']}</td>
                                <td>{$row['created_at']}</td> <td>{$row['date_needed']}</td>
                       <td>         
                        <a href='delete_order.php?delete_id={$row['id']}' class='delete-link' style='color: #ffffff;
  background-color: crimson;
  border-radius: 5px;
  margin: 10px;
  padding: 5px 18px;' onclick='return confirm(\"Are you sure you want to delete this order?\");'>Delete</a>
                    </td>
                               
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='8'>No orders found</td></tr>";
                }

                // Close the database connection
                $conn->close();
                ?>
            </table>
        </div>

    </div>
</body>

</html>