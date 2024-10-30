<?php
@include 'config.php';
session_start();

// Check if the user is logged in
if (!isset($_SESSION['email'])) {
    header('location:login.php');
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recipes</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <nav>
        <label class="logo">DESTINY BAKERY PRODUCTS</label>
        <ul>
            <li><a href="index.html">Home</a></li>
            <li><a href="admin_dashboard.php">DASHBOARD</a></li>
            <li><a class="active" href="recipes.php">RECIPES</a></li>
            <li><a href="products.php">PRODUCTS</a></li>
            <li><a href="orders.php">ORDERS</a></li>
            <li><a href="stock.php">STOCKS</a></li>
            <li><a href="sales.php">SALES</a></li>
            <li><a href="logout.php">LOGOUT</a></li>
        </ul>
    </nav>



    <div class="banner-card">
        <img src="images/store1.jpg" alt="picture of bakery" height="1000px">
        <div class="banner-text">
            <h1>Explore Bakery Recipes</h1>
            <p>Check out these links for delicious bakery recipes:</p>
            <a class="login-button" href="https://www.allrecipes.com">AllRecipes -
                Bread
                Recipes</a>
            <a class=" login-button" href="https://www.foodnetwork.com">Food
                Network - Bakery
                Recipes</a>
            <a class="login-button" href="https://www.bbcgoodfood.com">BBC Good
                Food -
                Bakery Recipes</a>
        </div>

    </div>

</body>

</html>