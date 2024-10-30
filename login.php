<?php
@include 'config.php';

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

session_start();

$error = array();

if(isset($_POST['submit'])){

   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $pass = mysqli_real_escape_string($conn, $_POST['password']);

   $select = " SELECT * FROM admin WHERE email = '$email'";

   $result = mysqli_query($conn, $select);

   if(mysqli_num_rows($result) > 0){

      $row = mysqli_fetch_array($result);

      if($pass == $row['password']){

         $_SESSION['email'] = $row['email'];
         header('location:admin_dashboard.php');

      }else{

         $error[] = 'Incorrect password!';
      }

   }else{
      $error[] = 'Email not found!';
   }

};

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700&display=swap" rel="stylesheet">


</head>

<body>
    <nav>
        <label class="logo">DESTINY BAKERY PRODUCTS</label>
        <ul>
            <li><a href="index.html">Home</a></li>
            <li><a class="active" href="login.php">LOGIN</a></li>


        </ul>
    </nav>


    <div class="form-container">

        <form action="" method="post" style="margin-top: 0px;">
            <h3>Admin Login</h3>
            <?php
            if(isset($error)){
               foreach($error as $error){
                  echo '<span class="error-msg">'.$error.'</span>';
               };
            };
            ?>
            <br>
            <p>Enter email<sup>*</sup></p>
            <input type="email" name="email" required placeholder="email">
            <p>Enter password<sup>*</sup></p>
            <input type="password" name="password" required placeholder="password">
            <input type="submit" name="submit" value="login now" class="form-btn">
        </form>
    </div>


</html>