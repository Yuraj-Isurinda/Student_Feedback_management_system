<?php
require_once "database_connection.php"; // Ensure your PDO connection is included
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Student Feedback Management System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        body {
            padding: 3em;
        }
        .toping {
            margin-top: -40px;
            text-align: center; 
        }
        .sidenav {
            height: 100%;
            width: 0; /* Initially hidden */
            position: fixed;
            z-index: 1;
            top: 0;
            left: 0;
            background-color: #137e91;
            padding-top: 60px;
            overflow-x: hidden;
            transition: 0.5s; /* Smooth transition */
        }
        .sidenav a {
            padding: 10px 15px;
            text-decoration: none;
            font-size: 18px;
            color: #fff;
            display: block;
        }
        .sidenav a:hover {
            background-color: #555;
        }
        .content {
            padding: 20px;
            transition: margin-left 0.5s; /* Smooth transition */
        }
        .welcome-section {
            margin-bottom: 20px;
        }
        /* Student Details Section */
        .student-details {
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            border-radius: 20px;
        }
        .student-details h3 {
            margin-top: 0;
        }
        /* Course Information Section */
        .course-info {
            margin-top: 20px;
            padding: 20px ;
            background-color: #e9b97f;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .course-info h3 {
            margin-top: 0;
        }
        /* Buttons */
        .feedback-btn {
            background-color: #137e91;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            margin-right: 10px;
        }
        /* Toggle button style */
        .toggle-btn {
            position: fixed; /* Fixed position */
            top: 20px;
            left: 20px; /* Adjusted position */
            font-size: 20px;
            cursor: pointer;
            z-index: 2;
        }
        .submit {
            position: right;
            bottom: 20px;
            left: 20px;
        }

        .submit:hover {
            background-color: #0056b3;
        }
        /* Table Styles */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid ;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #137e91;
            color: #fff;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        .add-new-btn {
            background-color: #137e91;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 20px;
            display: inline-block;
        }
        .add-new-btn:hover {
            background-color: #0056b3;
        }
        .add-new-btn a {
            color: #fff;
            text-decoration: none;
        }
        .delete-btn {
            background-color: #850909;
            color: #fff;
            border: none;
            padding: 10px 10px;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 5px;
            display: inline-block;
        }

        .delete-btn:hover {
            background-color:#B90A1E;
        }

        .delete-btn a {
            color: #fff;
            text-decoration: none;
        }
        
    </style>
</head>
<body>

<div class="sidenav" id="mySidenav">
<a href="Madashbord.php">Dashboard</a>
    <a href="feedback.php">Feedback</a>
    <a href="courselist.php">Course List</a>
    <a href="lecturelist.php">Lecture List</a>
    <a href="studentlist.php">Student List</a>
    <a href="courseallocation.php">Course Allocation</a>
    <a href="summary.php">Summary</a>
    <a href="test_showNotice.php">Notice</a>
    <a href="questions.php">Questions</a>
    <a href="resetPassword.php">Reset Password</a>
    <a href="login.php">Log Out</a>
</div>
<body>
    <div>
        <?php include 'header.php';?>
    </div>
<div class="toggle-btn" onclick="toggleNav()" style=" padding-top: 40px; ">&#9776;</div>


<div class="content">
    
<div class="toping">
    <h1 style="margin: 0;">NOTICES</h1>
    <hr style="height: 2px; margin: 10px 0;">

</div>

<div class="row py-3">
            <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="test_Madashbord.php">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Notices</li>
            </ol>
            </nav>
</div>
    <table>
    <thead>
        <tr>
            <th>Notice Number</th>
            <th>Notice Content</th>
            <th>Operation</th>
        </tr>
    </thead>
    <tbody>
        <?php

        $sql = "SELECT * FROM notice";
        $stmt = $pdo->query($sql);

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $Nid = $row["notice_no"];
            $Ncon = $row["notice_content"];

            echo '<tr>
            <th scope="row">' . $Nid . '</th>
            <td>' . $Ncon . '</td>
            <td>
            <button class="delete-btn"><a href="test_deleteNotice.php?deleteid=' . $Nid . '">Delete</a></button>
            </td>
            </tr>';
        }
        ?>
    </tbody>
</table>
    <button class="add-new-btn"><a href="test_add-newNotice.php">Add New Notice</a></button>

<script>
    function toggleNav() {
        var sidenav = document.getElementById("mySidenav");
        var content = document.getElementsByClassName("content")[0];
        if (sidenav.style.width === "250px") {
            sidenav.style.width = "0";
            content.style.marginLeft = "0";
        } else {
            sidenav.style.width = "250px";
            content.style.marginLeft = "250px";
        }
    }
</script>

</body>
</html>
