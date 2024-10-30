<?php
// After successfully uploading the file
if (move_uploaded_file($_FILES['recipe_image']['tmp_name'], $target_file)) {
    // Save recipe details to the database
    $stmt = $pdo->prepare("INSERT INTO recipes (name, description, image_path) VALUES (?, ?, ?)");
    $stmt->execute([$recipe_name, $recipe_description, $target_file]);
    echo "The file " . htmlspecialchars(basename($_FILES['recipe_image']['name'])) . " has been uploaded and recipe saved.";
}
?>