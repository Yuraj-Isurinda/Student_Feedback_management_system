<?php
    session_start();
    include 'database_connection.php';

    if(isset($_SESSION['UserID']))
    {
        $_SESSION['LecID'] = $_SESSION['UserID'];
        $LecID = $_SESSION['LecID'];
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
    <title>Lecturer Interface</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <script src= "https://code.jquery.com/jquery-3.2.1.slim.min.js"> </script> 
    <style>
        body{
            padding: 3em;
        }
    </style>
</head>
<body>
<?php
        $stmt = $pdo->query("SELECT FName,LName,Email,LecID,DepID FROM lecturer WHERE LecID='$LecID'");

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
              <h5 class="text-center" id="offcanvasLabel">Lecturer Dashboard</h5>
              <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>

            <div class="offcanvas-body">
                <div class="row p-2">
                    <a class="btn btn-primary" href="lecturer_password_reset.php" role="button">Reset Password</a>
                </div>
                <div class="row p-2">
                    <a class="btn btn-primary" href="test_showNotice.php" role="button">Notices</a>
                </div>
                <div class="row p-2">
                    <a class="btn btn-primary" href="Login.php" role="button">Logout</a>
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
                    <h4>Lecturer ID</h4>
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
           </div>

           <div class="col-4">
                <div class="row">
                    <h4><?php echo $data['LecID'] ?></h4>
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
                    <a class="btn btn-primary" href="update_lecturer_details.php" role="button">Edit</a>
                    </div>
                </div>
           </div>


            <?php
                $stmt = $pdo->query("SELECT DISTINCT course.CourseCode,course.CourseName FROM course INNER JOIN lecturer_course 
                ON course.CourseCode = lecturer_course.CourseID 
                WHERE lecturer_course.LecID= '$LecID' ");
            ?>

           <div class="row-4">
                <h3>My Courses </h3>
                <hr>
                <table class="table table-striped table-hover">
                    <?php
                        while($data = $stmt->fetch(PDO::FETCH_ASSOC))
                        {   
                            $courseUrl = "lecturer_interface_view_feedback.php?CourseCode=" . urlencode($data['CourseCode']);
                            echo "<tr onclick=\"window.location.href='$courseUrl'\">";                                echo "<td>";
                                    echo "<h4>{$data['CourseCode']}</h4>";
                                    echo "<h5>{$data['CourseName']}</h5>";
                                echo "</td>";
                            echo "</tr>";
                        }    
                    ?>    
                </table>
           </div>
        </div>

        <!--  -->    
    
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</html>