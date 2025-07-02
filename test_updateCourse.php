<?php

require_once "database_connection.php";

$id = $_GET["updateid"];

try {
    $sql = "SELECT * FROM course WHERE CourseCode = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['id' => $id]);

    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($row) {
        $Cid = $row["CourseCode"];
        $Cname = $row["CourseName"];
        $Sem = $row["Semester"];
        $dep = $row["DepID"];
    } else {
        // Handle the case where no record is found
        echo "No record found.";
        exit;
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
    exit;
}

if (isset($_POST["update"])) {

    $Cid = $_POST["Ccode"];
    $Cname = $_POST["Cname"];
    $Sem = $_POST["Semester"];
    $dep = $_POST["Department"];

    try {
        $sql = "UPDATE course SET CourseCode = :Cid, CourseName = :Cname, Semester = :Sem, DepID = :dep WHERE CourseCode = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['Cid' => $Cid, 'Cname' => $Cname, 'Sem' => $Sem, 'dep' => $dep, 'id' => $id]);

        if ($stmt->rowCount()) {
            header("Location: ./courselist.php");
        } else {
            echo "Update failed or no changes made.";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Course</title>
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
        .content {
            padding: 20px;
            margin: 0 auto;
            max-width: 600px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
        }
        .content h3 {
            margin-top: 0;
        }
        .content label {
            display: block;
            margin: 10px 0 5px;
        }
        .content input[type="text"], .content input[type="email"], .content input[type="password"], .content select {
            width: calc(100% - 22px);
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .content .submit-btn {
            background-color: #137e91;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 10px;
            display: inline-block;
        }
        .content .submit-btn:hover {
            background-color: #0056b3;
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
                /* Toggle button style */
        .toggle-btn {
            position: fixed; /* Fixed position */
            top: 20px;
            left: 20px; /* Adjusted position */
            font-size: 20px;
            cursor: pointer;
            z-index: 2;
        }
    </style>
</head>
<body>
<div>
<?php include 'header.php'?>
</div>

<div class="toping">
    <h1 style="margin: 0;">Update Course</h1>
    <hr style="height: 2px; margin: 10px 0;">
</div>
<div class="row">
            <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="test_Madashbord.php">Home</a></li>
            <li class="breadcrumb-item"><a href="test_courselist.php">Course List</a></li>
                <li class="breadcrumb-item active" aria-current="page">Update Course</li>
            </ol>
            </nav>
    </div>

<div class="content">
<div class="toggle-btn" onclick="toggleNav()" style=" padding-top: 40px; ">&#9776;</div>

    <form action="" method="post">

        <label for="Ccode">Course Code:</label>
        <input type="text" id="Ccode" name="Ccode" placeholder="Enter Course Code" value="<?php echo htmlspecialchars($Cid); ?>" required>

        <label for="Cname">Course Name:</label>
        <input type="text" id="Cname" name="Cname" placeholder="Enter Course Name" value="<?php echo htmlspecialchars($Cname); ?>" required>

        <label for="Semester">Semester:</label>
        <input type="text" id="Semester" name="Semester" placeholder="Enter Course Offered Semester" value="<?php echo htmlspecialchars($Sem); ?>" required>

        <label for="Department">Department:</label>
        <input type="text" id="Department" name="Department" placeholder="Enter Course Offer Department" value="<?php echo htmlspecialchars($dep); ?>" required>

        <button type="submit" class="submit-btn" name="update">Update Course</button>
    </form>
</div>

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
