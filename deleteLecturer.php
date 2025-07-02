<?php

require_once "database_connection.php";

if (isset($_GET["deleteid"])) {
    $id = $_GET["deleteid"];

    try {
        $sql = "DELETE FROM lecturer WHERE LecID = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['id' => $id]);

        if ($stmt->rowCount() > 0) {
            header("location: ./lecturelist.php");
            exit; // Optional exit after header redirect
        } else {
            echo "No records were deleted."; // Optional error message
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

?>
