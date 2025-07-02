<?php
include 'database_connection.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve updated values from the form
    $firstName = $_POST['firstname'];
    $lastName = $_POST['lastname'];
    $LecID = $_POST['LecID'];
    
    try {
        // Prepare the UPDATE query
        $stmt = $pdo->prepare("UPDATE lecturer SET FName = ?, LName = ? WHERE LecID = ?");

        // Execute the query with the updated values
        $stmt->execute([$firstName, $lastName, $LecID]);

        // Redirect to a success page or back to the form
        header('Location: lecturer_interface.php');
        exit;
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    echo "Invalid request method.";
}
?>
