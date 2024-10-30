<?php
// Include the database configuration file
@include 'config.php';

// Check if delete_id is set in the URL
if (isset($_GET['delete_id'])) {
    $delete_id = intval($_GET['delete_id']); // Sanitize the input

    // Prepare the SQL DELETE statement
    $sql = "DELETE FROM orders WHERE id = ?";
    
    // Prepare the statement
    if ($stmt = $conn->prepare($sql)) {
        // Bind the parameter
        $stmt->bind_param("i", $delete_id);
        
        // Execute the statement
        if ($stmt->execute()) {
            // Redirect back to orders.php with a success message
            header("Location: orders.php?message=Order deleted successfully");
            exit();
        } else {
            // Redirect back with an error message
            header("Location: orders.php?error=Error deleting order");
            exit();
        }
    } else {
        // Redirect back with an error message
        header("Location: orders.php?error=Error preparing statement");
        exit();
    }

    // Close the statement
    $stmt->close();
}

// Close the database connection
$conn->close();
?>