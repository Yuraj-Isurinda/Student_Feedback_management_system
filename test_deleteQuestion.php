<?php
require_once "database_connection.php"; // Ensure your PDO connection is included

// Check if deleteid is set in GET parameters
if(isset($_GET["deleteid"])){
    $id = $_GET["deleteid"];

    // Prepare DELETE query
    $sql = "DELETE FROM question WHERE QuestionID = ?";
    $stmt = $pdo->prepare($sql);

    // Bind parameters and execute query
    $stmt->execute([$id]);

    // Check if deletion was successful
    if ($stmt->rowCount() > 0) {
        header("Location: ./test_questions.php");
        exit;
    } else {
        echo "Delete failed: No rows affected.";
    }
}
?>
