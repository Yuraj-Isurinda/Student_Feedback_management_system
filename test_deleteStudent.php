<?php

include_once "database_connection.php";

if (isset($_GET["deleteid"])) {
    $id = $_GET["deleteid"];

    $sql = "DELETE FROM student WHERE RegNo = :id";
    $stmt = $pdo->prepare($sql);

    if ($stmt->execute(['id' => $id])) {
        header("location: ./student_list.php");
    } else {
        echo "Deletion failed";
    }
}
?>
