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
    <title>Dashboard - Lecturer Feedback Management System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        body {
            padding: 3em;
        }
        .toping {
            background-color: #137e91;
            margin-top: -40px;
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
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        .filter-container {
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            display: flex;
            align-items: center;
            flex-wrap: wrap; /* Allow wrapping for smaller screens */
        }
        .filter-item {
            margin-right: 15px;
            flex: 1; /* Make filter items flexible */
            min-width: 200px; /* Ensure a minimum width */
        }
        .filter-item label {
            display: block;
            margin-bottom: 5px;
        }
        .filter-item select {
            width: 100%; /* Make the select elements span the full width */
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
            font-size: 16px;
        }
        .filter-button {
            padding: 10px 20px;
            border-radius: 5px;
            border: none;
            background-color: #137e91;
            color: #fff;
            font-size: 16px;
            cursor: pointer;
            align-self: flex-end; /* Align the button to the end */
            margin-top: 20px; /* Add some margin to the top for spacing */
        }
        .filter-button:hover {
            background-color: #005f6b;
        }
        
    </style>
</head>
<body>
<div>
        <?php include 'header.php';?>
</div>

<div class="toping">
    <h2 style="margin: 0;">Lecturer Feedbacks</h2>
</div>
<div class="row py-3">
            <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="test_Madashbord.php">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Lecturer Feedbacks</li>
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
    <a href="summary.php">Summary</a>
    <a href="test_showNotice.php">Notice</a>
    <a href="ma_reset_password.php">Reset Password</a>
    <a href="Login.php">Log Out</a>
</div>
<div class="toggle-btn" onclick="toggleNav()" style=" padding-top: 45px; ">&#9776;</div>
<div class="content">
    <form method="post" action="">
    <div class="filter-container">
        <div class="filter-item">
            <label for="filter1">Academic Year</label>
            <select id="filter1" name="filter1">
                <option value="">Select</option>
                <?php
                require_once "database_connection.php";

                $query = "SELECT DISTINCT StudentBatch AS Batch FROM lecturer_feedback";
                $stmt = $pdo->query($query);
                $selectedBatch = isset($_POST['filter1']) ? $_POST['filter1'] : '';

                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $selected = ($row['Batch'] == $selectedBatch) ? 'selected' : '';
                    echo '<option value="' . $row['Batch'] . '" ' . $selected . '>' . $row['Batch'] . '</option>';
                }
                ?>
            </select>
        </div>

        <div class="filter-item">
            <label for="filter2">Course Code</label>
            <select id="filter2" name="filter2">
                <option value="">Select</option>
                <?php
                $query = "SELECT DISTINCT CourseCode FROM lecturer_feedback";
                $stmt = $pdo->query($query);
                $selectedCourseCode = isset($_POST['filter2']) ? $_POST['filter2'] : '';

                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $selected = ($row['CourseCode'] == $selectedCourseCode) ? 'selected' : '';
                    echo '<option value="' . $row['CourseCode'] . '" ' . $selected . '>' . $row['CourseCode'] . '</option>';
                }
                ?>
            </select>
        </div>

        <div class="filter-item">
            <label for="filter3">Lecturer ID</label>
            <select id="filter3" name="filter3">
                <option value="">Select</option>
                <?php
                $query = "SELECT DISTINCT LecID FROM lecturer_feedback";
                $stmt = $pdo->query($query);
                $selectedLecID = isset($_POST['filter3']) ? $_POST['filter3'] : '';

                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $selected = ($row['LecID'] == $selectedLecID) ? 'selected' : '';
                    echo '<option value="' . $row['LecID'] . '" ' . $selected . '>' . $row['LecID'] . '</option>';
                }
                ?>
            </select>
        </div>

        <button type="submit" class="filter-button">Filter</button>
    </div>
</form>

    <table>
    <thead>
        <tr>
            <th>Course Code</th>
            <th>Student ID</th>
            <th>Lecturer ID</th>

            <?php
            // Step 1: Retrieve Question IDs for type L from the question table
            $questionQuery = "SELECT QuestionID FROM question WHERE Type='L'";
            $stmt = $pdo->query($questionQuery);
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo '<th>Question ' . $row['QuestionID'] . '</th>';
            }
            ?>
        </tr>
    </thead>
    <tbody>
        <?php
        // Step 2: Retrieve lecturers' feedback based on selected filters
        $whereClause = " WHERE 1=1 ";
        $parameters = array();

        if (!empty($_POST['filter1'])) {
            $whereClause .= " AND StudentBatch = :batch ";
            $parameters[':batch'] = $_POST['filter1'];
        }

        if (!empty($_POST['filter2'])) {
            $whereClause .= " AND CourseCode = :courseCode ";
            $parameters[':courseCode'] = $_POST['filter2'];
        }

        if (!empty($_POST['filter3'])) {
            $whereClause .= " AND LecID = :lecID ";
            $parameters[':lecID'] = $_POST['filter3'];
        }
        
        $feedbackQuery = "SELECT lf.CourseCode,lf.LecID,s.RegNo AS StudentId, GROUP_CONCAT(lf.Rating) AS Feedbacks 
        FROM student s
        INNER JOIN lecturer_feedback lf ON s.RegNo = lf.StudentId
        {$whereClause}
        GROUP BY s.RegNo,lf.CourseCode,lf.LecID";
        
        $stmt = $pdo->prepare($feedbackQuery);
        $stmt->execute($parameters);

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo '<tr>';
            echo '<td>' . $row['CourseCode'] . '</td>';
            echo '<td>' . $row['StudentId'] . '</td>';
            echo '<td>' . $row['LecID'] . '</td>';

            // Display feedback for each question
            $feedbacks = explode(',', $row['Feedbacks']);
            foreach ($feedbacks as $feedback) {
                echo '<td>' . $feedback . '</td>';
            }
            echo '</tr>';
        }
        ?>
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
