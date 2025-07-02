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
            background-color: #137e91;
            color: #fff;
            padding: 10px;
            text-align: center; /* Center the text */
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

        .update-btn {
            background-color: #0056b3;
            color: #fff;
            border: none;
            padding: 10px 10px;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 5px;
            display: inline-block;
        }
        .update-btn:hover {
            background-color:#4543DC;
        }

        .update-btn a {
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
<div>
       <?php include 'header.php';?>
</div>
<div class="toping">
    <h2 style="margin: 0;">Questions And Categories</h2>
</div>

<div class="row py-3">
            <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="test_Madashbord.php">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Feedback Questionnaire</li>
            </ol>
            </nav>
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
    <a href="test_showNotice.php">Notice</a>
    <a href="ma_reset_password.php">Reset Password</a>
    <a href="Login.php">Log Out</a>
</div>

<div class="content">
<div class="toggle-btn" onclick="toggleNav()" style=" padding-top: 40px; ">&#9776;</div>
    <table>
    <thead>
        <tr>
            <th>Question ID</th>
            <th>Type</th>
            <th>Category</th>
            <th>Content</th>
            <th>Operation</th>
        </tr>
    </thead>
    <tbody>
        <?php
        require_once "database_connection.php";

        $sql = "SELECT * FROM question";
        $stmt = $pdo->query($sql);

        if ($stmt) {
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $Qid = $row["QuestionID"];
                $Qtype = $row["Type"];
                $Qcat = $row["Category"];
                $Qcontent = $row["Content"];

                echo '<tr>
                <th scope="row">' . $Qid . '</th>
                <td>' . $Qtype . '</td>
                <td>' . $Qcat . '</td>
                <td>' . $Qcontent . '</td>
                <td>
                <button class="update-btn"><a href="test_updateQuestion.php?updateid=' . $Qid . '">Edit</a></button>
                <button class="delete-btn"><a href="test_deleteQuestion.php?deleteid=' . $Qid . '">Delete</a></button>
                </td>
                </tr>';
            }
        }
        ?>
    </tbody>
</table>
    <button class="add-new-btn"><a href="test_add-newQuestion.php">Add New Question</a></button>

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
