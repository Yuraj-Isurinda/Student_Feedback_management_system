<?php
require_once "database_connection.php"; // Ensure your PDO connection is included

if (isset($_POST["addnew"])) {
    $Nid = $_POST["Nid"];
    $Ncon = $_POST["Ncon"];

    // Prepare and execute INSERT query
    $sql = "INSERT INTO notice (notice_no, notice_content) VALUES (:Nid, :Ncon)";
    $stmt = $pdo->prepare($sql);

    // Bind parameters
    $stmt->bindParam(':Nid', $Nid);
    $stmt->bindParam(':Ncon', $Ncon);

    // Execute the statement and check for success
    if ($stmt->execute()) {
        header("Location: ./test_notice.php");
        exit();
    } else {
        echo "Query failed: " . implode(", ", $stmt->errorInfo());
    }
}
?>
