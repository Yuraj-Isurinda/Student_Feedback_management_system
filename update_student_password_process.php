<?php

include 'database_connection.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve updated values from the form
    
    if(isset($_POST['InputPassword']))
    {
        $pass = $_POST['InputPassword'];
    }
    else
    {
        echo "password not set";
    }
    
    try {
        // Prepare the UPDATE query
        $stmt = $pdo->prepare("UPDATE student SET Password = ?");

        // Execute the query with the updated values
        $stmt->execute([$pass]);

        // Redirect to a success page or back to the form
        echo "<script>
                if(confirm('Password changed successfully'))
                {
                    window.location.href = 'student_interface.php';
                }              
              </script>";
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    echo "Invalid request method.";
    header('Location: student_interface.php');
}

?>