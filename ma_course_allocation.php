<?php
    session_start();
    include 'database_connection.php';
   $_SESSION['MAID'] = 'MA01';

    if(isset($_SESSION['MAID']))
    {
        $MAID = $_SESSION['MAID'];
    }
    else
    {
        header("Location: Login.php");
        exit;
    }


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Course Allocation</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        body{
            padding: 3em;    
        }
        input{
            width: 10px;
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
<div class="container-fluid">
<div class="toggle-btn" onclick="toggleNav()" style=" padding-top: 45px; ">&#9776;</div>
<?php include 'header.php'; ?>
    <div class="row">
                <h1 class="text">COURSE ALLOCATION</h1>   
    </div>
    <hr style="height: 2px; margin: 10px 0;">
    <div class="row">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="test_Madashbord.php">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Course Allocation</li>
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
    <a href="notice.php">Notice</a>
    <a href="ma_reset_password.php">Reset Password</a>
    <a href="Login.php">Log Out</a>
</div>

<div class="row-p-5">
        <h4>Add new lecturer</h4>
        <hr style="width: 200px;">

        <form action="add_new_lecturer_process.php" method="POST">
            <div class="form-group">
                <label for="LecID" class="form-label">Lecturer ID :</label>
                <input type="text" class="form-control" id="LecID" name="LecID" style="width: 50%;"  required>

                <label for="FName" class="form-label">First Name :</label>
                <input type="text" class="form-control" id="FName" name="FName" style="width: 50%;"  required>

                <label for="LName" class="form-label">Last Name :</label>
                <input type="text" class="form-control" id="LName" name="LName" style="width: 50%;"  required>

                <label for="Email" class="form-label">Email :</label>
                <input type="text" class="form-control" id="Email" name="Email" style="width: 50%;"  required>

                <label for="Password" class="form-label">Password :</label>
                <input type="password" class="form-control" id="Password" name="Password" style="width: 50%;"  required>

                <label class="form-label">Department</label>
                <select class="form-select" name="department" style="width: 50%;" required>
                <option value="">Select the department</option >
                <?php
                    $stmt2 = $pdo->query("SELECT DepID,DepName FROM department ");

                    while($data = $stmt2->fetch(PDO::FETCH_ASSOC))
                    {
                        echo "<option value='" . $data['DepID'] . "'>" . $data['DepName'] . "</option>";
                    }
                ?>
               </select>
                <div class="div-p-5" style="padding: 20px; padding-left:0px;">
                    <input class="btn btn-primary" type="submit" value="Submit" style="width: 100px" >
                </div>    
            </form>
    
</div>

<div class="row-p-5">
        <h4>Add new course</h4>
        <hr style="width: 200px;">

        <form action="add_new_course_process.php" method="POST">
            <div class="form-group">
                <label for="CourseCode" class="form-label">Course Code :</label>
                <input type="text" class="form-control" id="CourseCode" name="CourseCode" style="width: 50%;"  required>

                <label for="CourseName" class="form-label">Course Name :</label>
                <input type="text" class="form-control" id="CourseName" name="CourseName" style="width: 50%;"  required>

                <label class="form-label">Department</label>
                <select class="form-select" name="department" style="width: 50%;" required>
                <option value="">Select the department</option >
                <?php
                    $stmt2 = $pdo->query("SELECT DepID,DepName FROM department ");

                    while($data = $stmt2->fetch(PDO::FETCH_ASSOC))
                    {
                        echo "<option value='" . $data['DepID'] . "'>" . $data['DepName'] . "</option>";
                    }
                ?>
               </select>

                <label for="semester" class="form-label">Semester :</label>
                <input type="text" class="form-control" id="semester" name="semester" style="width: 50%;"  required>

                
                
                <div class="form-group">
                    <label for="lecturers" class="form-label">Select Lecturer(s):</label>
                    <select class="form-select" id="lecturers" name="lecturers[]" multiple required style="width: 50%;">
                    <?php
                    // Fetching lecturers from the database
                        $stmt = $pdo->query("SELECT LecID, FName,LName FROM lecturer");
                        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) 
                        {
                            echo "<option value='" . $row['LecID'] . "'>" . $row['LecID']."-".$row['FName']." ".$row['LName'] . "</option>";
                        }
                    ?>
                    </select>
                </div>
                
                
                <label class="form-label">Course Cordinator</label>
                <select class="form-select" name="coordinator" style="width: 50%;" required>
                <option value="">Select the coordinator</option >
                <?php
                    $stmt2 = $pdo->query("SELECT LecID,FName,LName FROM lecturer");

                    while($data = $stmt2->fetch(PDO::FETCH_ASSOC))
                    {
                        $fullname = $data['FName']." ".$data['LName'];
                        echo "<option value='" . $data['LecID'] . "'>" .$data['LecID']." - ". $fullname . "</option>";                    }
                ?>
               </select>


                <div class="div-p-5" style="padding: 20px; padding-left:0px;">
                    <input class="btn btn-primary" type="submit" value="Submit" style="width: 100px" >
                </div>    
            </form>
</div>

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