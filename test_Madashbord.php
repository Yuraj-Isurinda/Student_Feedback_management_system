<?php
    session_start();
    if(isset($_SESSION['UserID']))
    {
        $_SESSION['MAID'] = $_SESSION['UserID'];
        $MAID = $_SESSION['MAID'];
    }
    else{
        header("location:./Login.php");
        exit();
    }
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
            width: 0; 
            position: fixed;
            z-index: 1;
            top: 0;
            left: 0;
            background-color: #137e91;
            padding-top: 60px;
            overflow-x: hidden;
            transition: 0.5s; 
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
            transition: margin-left 0.5s; 
        }
        
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
        
        .feedback-btn {
            background-color: #137e91;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            margin-right: 10px;
        }
        
        .toggle-btn {
            position: fixed; 
            top: 20px;
            left: 20px; 
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

        .links-table {
            text-align: center; 
            margin: 0 auto; 
            max-width: 600px;
            width: 100%;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin-top:50px;
        }
        .links-table a {
            display: block;
            padding: 10px 20px;
            margin-bottom: 10px;
            color: #137e91;
            text-decoration: none;
            transition: background-color 0.3s;
        }
        .links-table a:hover {
            background-color: #137e91;
            color: #fff;
        }
        
    </style>
</head>
<body>
    <div>
        <?php include 'header.php';?>
    </div>
<div class="toping">
    <h1 style="margin: 0;">Management Assistant Dashbord </h1>
</div>

<div class="sidenav" id="mySidenav" style="padding-top: 90px;">
    <a href="test_Madashbord.php">Dashboard</a>
    <a href="ma_view_course_feedback.php">Course Feedback</a>
    <a href="ma_view_lecturer_feedback.php">Lecturer Feedback</a>
    <a href="courselist.php">Course List</a>
    <a href="lecturelist.php">Lecture List</a>
    <a href="student_list.php">Student List</a>
    <a href="ma_course_allocation.php">Course Allocation</a>
    <a href="test_questions.php">Feedback Questionnaire</a>
    <a href="summary.php">Summary</a>
    <a href="test_notice.php">Notice</a>
    <a href="ma_reset_password.php">Reset Password</a>
    <a href="Login.php">Log Out</a>
</div>

<div class="content">
    <div class="toggle-btn" onclick="toggleNav()" style=" padding-top: 40px; ">&#9776;</div>
</div>

<div class="links-table">
    <h2 class="text-center mb-4">Navigation Links</h2>
    <table class="table table-striped">
        <tbody>
            <tr>
                <td><a href="ma_view_course_feedback.php">Course Feedback</a></td>
            </tr>
            <tr>
                <td><a href="ma_view_lecturer_feedback.php">Lecturer Feedback</a></td>
            </tr>
            <tr>
                <td><a href="courselist.php">Course List</a></td>
            </tr>
            <tr>
                <td><a href="lecturelist.php">Lecture List</a></td>
            </tr>
            <tr>
                <td><a href="student_list.php">Student List</a></td>
            </tr>
            <tr>
                <td><a href="ma_course_allocation.php">Course Allocation</a></td>
            </tr>
            <tr>
                <td><a href="test_questions.php">Feedback Questionnaire</a></td>
            </tr>
            <tr>
                 <td><a href="summary.php">Summary</a></td>
            </tr>
            <tr>
                <td><a href="test_notice.php">Notice</a></td>
            </tr>
        </tbody>
    </table>
</div>

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
