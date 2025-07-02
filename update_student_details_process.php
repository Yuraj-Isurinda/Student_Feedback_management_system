<?php
include 'database_connection.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve updated values from the form
    $regNo = $_POST['regNo'];
    $indexNo = $_POST['IndexNo'];
    $firstName = $_POST['firstname'];
    $lastName = $_POST['lastname'];
    $semester = $_POST['semester'];
    $badge = $_POST['badge'];
    
    try {
        // Prepare the UPDATE query
        $stmt = $pdo->prepare("UPDATE student SET FName = ?, LName = ?, Current_semester = ?, Batch = ? WHERE RegNo = ?");

        // Execute the query with the updated values
        $stmt->execute([$firstName, $lastName, $semester, $badge, $regNo]);

        // Redirect to a success page or back to the form
        header('Location: student_interface.php');
        exit;
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    echo "Invalid request method.";
}
?>
