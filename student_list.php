<?php
    session_start();
    if(isset($_SESSION['MAID']))
    {
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
<?php include 'header.php'?>
</div>

<div class="content">
    <div class="toggle-btn" onclick="toggleNav()" style=" padding-top: 40px; ">&#9776;</div>
    <h1 style="margin-top:-30px;">Student List</h1>
    <hr style="height: 2px; margin: 10px 0;">
    <div class="row">
            <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="test_Madashbord.php">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Student List</li>
            </ol>
            </nav>
    </div>
<form method="post" action="">
    <div class="filter-container">
        <div class="filter-item">
            <label for="filter1">Select the Badge</label>
            <select id="filter1" name="filter1">
                <option value="">Select</option>
                <?php
                require_once "database_connection.php";

                // Fetch badges
                $query = "SELECT DISTINCT Batch FROM student";
                $stmt = $pdo->query($query);
                $badges = $stmt->fetchAll(PDO::FETCH_ASSOC);

                foreach ($badges as $row) {
                    echo '<option value="' . $row['Batch'] . '">' . $row['Batch'] . '</option>';
                }
                ?>
            </select>
        </div>
        <div class="filter-item">
            <label for="filter2">Student Status</label>
            <select id="filter2" name="filter2">
                <option value="">Select</option>
                <?php
                // Fetch statuses
                $query = "SELECT DISTINCT status FROM student";
                $stmt = $pdo->query($query);
                $statuses = $stmt->fetchAll(PDO::FETCH_ASSOC);

                foreach ($statuses as $row) {
                    echo '<option value="' . $row['status'] . '">' . $row['status'] . '</option>';
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
            <th>Reg No</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Semester</th>
            <th>Email</th>
            <th>Password</th>
            <th>Badge</th>
            <th>Department</th>
            <th>Status</th>
            <th>Operation</th>
        </tr>
    </thead>
    <tbody>
        <?php
        require_once "database_connection.php";

        $sql = "SELECT * FROM student";
        $conditions = [];
        $params = [];

        if (isset($_POST['filter1']) && !empty($_POST['filter1'])) {
            $filter1 = $_POST['filter1'];
            $conditions[] = "Batch = :filter1";
            $params[':filter1'] = $filter1;
        }

        if (isset($_POST['filter2']) && !empty($_POST['filter2'])) {
            $filter2 = $_POST['filter2'];
            $conditions[] = "status = :filter2";
            $params[':filter2'] = $filter2;
        }

        if (count($conditions) > 0) {
            $sql .= " WHERE " . implode(' AND ', $conditions);
        }

        $stmt = $pdo->prepare($sql);
        $stmt->execute($params);
        $students = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($students as $row) {
            $id = $row["RegNo"];
            $fname = $row["FName"];
            $lname = $row["LName"];
            $semester = $row["Current_semester"];
            $email = $row["Email"];
            $password = $row["Password"];
            $badge = $row["Batch"];
            $status = $row["status"];
            $dep = $row["DepID"];

            echo '<tr>
            <th scope="row">' . $id . '</th>
            <td>' . $fname . '</td>
            <td>' . $lname . '</td>
            <td>' . $semester . '</td>
            <td>' . $email . '</td>
            <td>' . $password . '</td>
            <td>' . $badge . '</td>
            <td>' . $dep . '</td>
            <td>' . $status . '</td>
            <td>
            <button class="update-btn"><a href="update_student.php?updateid=' . $id . '">Update</a></button>
            <button class="delete-btn"><a href="test_deleteStudent.php?deleteid=' . $id . '">Delete</a></button>
            </td>
            </tr>';
        }
        ?>
    </tbody>
</table>
    <button class="add-new-btn"><a href="test_add-newStudent.php">Add New Student</a></button>

<div class="sidenav" id="mySidenav" style="padding-top: 90px;">
    <a href="test_Madashbord.php">Dashboard</a>
    <a href="test_feedback.php">Feedback</a>
    <a href="courselist.php">Course List</a>
    <a href="lecturelist.php">Lecture List</a>
    <a href="test_studentlist.php">Student List</a>
    <a href="ma_course_allocation.php">Course Allocation</a>
    <a href="summary.php">Summary</a>
    <a href="notice.php">Notice</a>
    <a href="resetPassword.php">Reset Password</a>
    <a href="Login.php">Log Out</a>
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
