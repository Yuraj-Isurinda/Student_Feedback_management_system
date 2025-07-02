<?php

include_once "database_connection.php";

if(isset($_GET["deleteid"])){
    $id = $_GET["deleteid"];

    try {
        $sql = "DELETE FROM course WHERE CourseCode = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['id' => $id]);

        if ($stmt->rowCount()) {
            header("location:./courselist.php");
        } else {
            echo "Deletion failed or no record found.";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

?>
