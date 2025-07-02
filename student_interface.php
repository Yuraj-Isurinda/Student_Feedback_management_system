<?php 
    session_start();
    if($_SESSION['UserID']){
        $_SESSION['student_id'] = $_SESSION['UserID'];
        $regNo = $_SESSION['student_id'];
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
    <title>Student Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <?php include 'database_connection.php'; ?>
   <style>
        body{
            padding: 3em;
        }
    </style>

</head>
<body>

<?php
        $stmt = $pdo->query("SELECT FName,LName,Current_semester,Batch,RegNo,IndexNo,Email,DepID FROM student WHERE Regno='$regNo'");

        $data = $stmt->fetch(PDO::FETCH_ASSOC);
    ?>

    <div class="container-fluid">    
    <?php include 'header.php'; ?>
        <!-- first row -->
        <div class="row align-items-center">

            <div class="col-1">
                <button class="btn btn-outline-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvas" aria-controls="offcanvas">
                        <span>
                            <i class="bi bi-list"></i>
                        </span>
                </button>
             </div>

             <div class="col">
                <h1 class="text-center">FEEDBACK MANAGEMENT SYSTEM</h1>
             
             </div>
             <hr style="height: 2px; margin: 10px 0;">
        </div>
        <!--  -->

        <div class="row">
            <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">Home</li>
            </ol>
            </nav>
        </div>


        <!-- off canvas div -->
        <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvas" aria-labelledby="offcanvasLabel">
           
            <div class="offcanvas-header">
              <h5 class="text-center" id="offcanvasLabel">Student Dashboard</h5>
              <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>

            <div class="offcanvas-body">
                <div class="row p-2">
                    <a class="btn btn-primary" href="student_password_reset.php" role="button">Reset Password</a>
                </div>
                <div class="row p-2">
                    <a class="btn btn-primary" href="test_showNotice.php" role="button">Notices</a>
                </div>
                <div class="row p-2">
                    <a class="btn btn-primary" href="login.php" role="button">Logout</a>
                </div>
            </div>
        </div>
        <!--  -->

        <!-- row 2 -->
        <div class="row py-4 px-1">
            <h4>Welcome, <?php echo $data['FName'] ?> <?php echo $data['LName'] ?></h3>
        </div>
        <!--  -->

        <!-- row 3 -->
        <div class="row offset-1 justify-content-center" id="row3">
          
            <div class="col-4">
                <div class="row">
                    <h4>Current Semester</h4>
                </div>
                <div class="row">
                    <h4>Batch</h4>
                </div>
                <div class="row">
                    <h4>Registration Number</h4>
                </div>
                <div class="row">
                    <h4>Index number</h4>
                </div>
                <div class="row">
                    <h4>Department</h4>
                </div>
                <div class="row">
                    <h4>Email</h4>
                </div>
           </div>

           <div class="col-1">
                <div class="row">
                    <h4>:</h4>
                </div>
                <div class="row">
                    <h4>:</h4>
                </div>
                <div class="row">
                    <h4>:</h4>
                </div>
                <div class="row">
                    <h4>:</h4>
                </div>
                <div class="row">
                    <h4>:</h4>
                </div>
                <div class="row">
                    <h4>:</h4>
                </div>
           </div>

           <div class="col-4">
                <div class="row">
                    <h4><?php echo $data['Current_semester'] ?></h4>
                </div>
                <div class="row">
                    <h4><?php echo $data['Batch'] ?></h4>
                    <?php $_SESSION['StudentBatch'] = $data['Batch'] ;?>
                </div>
                <div class="row">
                    <h4><?php echo $data['RegNo'] ?></h4>
                </div>
                <div class="row">
                    <h4><?php echo $data['IndexNo'] ?></h4>
                </div>
                <div class="row">
                    <?php
                        $DepID= $data['DepID'];
                        $stmt2 = $pdo->query("SELECT DepName FROM department WHERE DepID='$DepID'");

                        $data2 = $stmt2->fetch(PDO::FETCH_ASSOC);
                    ?>

                    <h4><?php echo $data2['DepName'] ?></h4>
                </div>
                <div class="row">
                    <h4><?php echo $data['Email'] ?></h4>
                </div>
                <div class="row py-3">
                    <div class="text-center">
                    <a class="btn btn-primary" href="update_student_details.php" role="button">Edit</a>
                    </div>
                </div>
           </div>

        </div>
        <?php $_SESSION['StudentBatch'] = $data['Batch'];?>

        <!--  -->

        <!-- row 4 -->
        <div class="row py-3">
            <table class="table table-striped">
                <?php
                    $stmt = $pdo->query("SELECT DISTINCT course.CourseName,course.CourseCode
                    FROM course
                    INNER JOIN student_course ON student_course.CourseID = course.CourseCode
                    WHERE student_course.StudentID= $regNo");

                    while($data = $stmt->fetch(PDO::FETCH_ASSOC)){

                        $CourseCode = $data['CourseCode'];
                        
                        echo "<tr>";
                        echo "<td><div>{$data['CourseCode']}</div>";
                        echo "<div>{$data['CourseName']}</div>";
                        echo "</td>";
                        echo "<td class=\"text-center py-3\"><a class=\"btn btn-primary\" href=\"student_course_feedback.php?CourseCode=$CourseCode\" role=\"button\">Course Feedback</a></td>";
                        echo "<td class=\"text-center py-3\"><a class=\"btn btn-primary\" href=\"student_lecturer_feedback.php?CourseCode=$CourseCode\" role=\"button\">Lecturer Feedback</a></td>";
                        echo "</tr>";
                    }

                ?>
            </table>
        </div>
        <!--  -->


    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>