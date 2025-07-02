<?php

require_once "database_connection.php"; // Ensure your PDO connection is included

if (isset($_GET["deleteid"])) {
    $id = $_GET["deleteid"];

    // Prepare and execute DELETE query
    $sql = "DELETE FROM notice WHERE notice_no = :id";
    $stmt = $pdo->prepare($sql);

    // Bind the parameter as a string
    $stmt->bindParam(':id', $id, PDO::PARAM_STR);

    // Execute the statement and check for success
    if ($stmt->execute()) {
        header("Location: ./test_notice.php");
        exit();
    } else {
        echo "Connection failed: " . implode(", ", $stmt->errorInfo());
    }
}
?>
