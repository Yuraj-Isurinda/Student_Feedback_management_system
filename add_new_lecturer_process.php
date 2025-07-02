<?php

include "database_connection.php";
session_start();

if (!(isset($_SESSION['MAID']))) {
    header("Location: Login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $LecID = $_POST['LecID'];
    $FName = $_POST['FName'];
    $LName = $_POST['LName'];
    $Email = $_POST['Email'];
    $Password = password_hash($_POST['Password'], PASSWORD_DEFAULT); // Hash the password
    $department = $_POST['department'];

    try {

        $stmt = $pdo->prepare("INSERT INTO lecturer (LecID, FName, LName, Email, Password, DepID) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->execute([$LecID, $FName, $LName, $Email, $Password, $department]);

        echo "<script>
                if(confirm('New lecturer added to database.Thank you'))
                {
                    window.location.href = 'ma_course_allocation.php';
                }              
              </script>";
        exit;
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    echo "Invalid request method.";
}
?>
