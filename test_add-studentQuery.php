<?php

require_once "database_connection.php";

if (isset($_POST["addnew"])) {

    $id = $_POST["regno"];
    $index =$_POST["index"];
    $fname = $_POST["fname"];
    $lname = $_POST["lname"];
    $semester = $_POST["semester"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $badge = $_POST["badge"];
    $status = $_POST["status"];
    $depID = $_POST["department"];

    $sql = "INSERT INTO student (RegNo,IndexNo, FName, LName, Current_semester, Email, Password, Batch, status, DepID) 
            VALUES (:regno, :index, :fname, :lname, :semester, :email, :password, :badge, :status, :depID)";
    
    $stmt = $pdo->prepare($sql);
    
    $result = $stmt->execute([
        ':regno' => $id,
        ':index' => $index,
        ':fname' => $fname,
        ':lname' => $lname,
        ':semester' => $semester,
        ':email' => $email,
        ':password' => $password,
        ':badge' => $badge,
        ':status' => $status,
        ':depID' => $depID
    ]);

    if ($result) {
        header("Location: ./student_list.php");
    } else {
        echo "Connection failed";
    }
}

?>
