<?php
    session_start();
    include 'database_connection.php';

    if (isset($_SESSION['student_id'])) {
        $student_id = $_SESSION['student_id'];

    } else {
        echo "Error session variable";
    }

    if(isset($_GET['CourseCode'])){
        $_SESSION['CourseCode'] = $_GET['CourseCode'];
    }

    if (isset($_SESSION['CourseCode'])) {
        $course_code = $_SESSION['CourseCode'];
    } else {
        echo "Error: CourseCode not set";
        exit;
    }

    if (isset($_POST['lecturer']) && !empty($_POST['lecturer'])) {
        $_SESSION['LecID'] = $_POST['lecturer'];
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lecturer Feedback</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <?php include 'database_connection.php'; ?>

    <style>
        body{
            padding: 3em;
        }

        .modern-box {
            background-color: #0d6efd;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 20px;
            text-align: center;
            color: white;
        }
    </style>
</head>
<body>

    <div class="container-fluid">
    <?php include 'header.php'; ?>
        <div class="row" id="1">
            <h1>LECTURER FEEDBACK</h1>
            <hr style="height: 2px; margin: 10px 0;">
        </div>

        <div class="row">
            <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="student_interface.php">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Lecturer Feedback Form</li>
            </ol>
            </nav>  
        </div>


        <div class="row py-3" id="2">
            <p>This questionnaire intends to collect feedback from the students about the course unit. Your valuable feedback will be vital for us to strengthen the teaching-learning environment to achieve excellence in teaching and learning.</p>
        </div>

        <div class="row align-items-center text-center" id="3">
            <div class="col justify-content-center">
                <h5>Course Code : <?php echo $_SESSION['CourseCode']; ?></h5>
            </div>

            <?php
            $stmt = $pdo->query("SELECT lecturer.LecID,lecturer.FName,lecturer.LName FROM lecturer INNER JOIN lecturer_course on lecturer.LecID=lecturer_course.LecID WHERE lecturer_course.CourseID=\"{$_SESSION['CourseCode']}\"");
           ?>


            <div class="col justify-content-center">
                <h5>Lecturer(s) :  <?php while($data = $stmt->fetch(PDO::FETCH_ASSOC) ){echo $data['FName']." ". $data['LName']." , ";}?>
                </h5>
            </div>
            <div class="col justify-content-center">
                <h5 id="currentDate"></h5>
            </div>
        </div>

        <div class="row py-4" id="4">
            <div class="col">
                <div class="modern-box">1. Strongly Disagree</div>
            </div>
            <div class="col">
                <div class="modern-box">2. Disagree</div>
            </div>
            <div class="col">
                <div class="modern-box">3. Not Sure</div>
            </div>
            <div class="col">
                <div class="modern-box">4. Agree</div>
            </div>
            <div class="col">
                <div class="modern-box">5. Strongly Agree</div>
            </div>
        </div>

        <div class="row" id="5">
        <p>Please respond to the following statements by marking on the scale next to each statement (Ex.     ). The scale 1 to 5 refers to the following</p>
        </div>

        <div class="row align-items-center py-4 px-5"  id="6">
        <form method="post" action="student_lecturer_feedback_process.php">
            <h5 class="pb-3">Select the lecturer</h5>
            <select class="form-select" name="lecturer" required>
                <option value="">Select the lecturer</option >
                <?php

                    $stmt2 = $pdo->query("SELECT lecturer.LecID,lecturer.FName,lecturer.LName FROM lecturer INNER JOIN lecturer_course on lecturer.LecID=lecturer_course.LecID WHERE lecturer_course.CourseID=\"{$_SESSION['CourseCode']}\"");

                    // Loop through the results and create options
                    while($data = $stmt2->fetch(PDO::FETCH_ASSOC)) {
                        $fullName = $data['FName'] . ' ' . $data['LName'];
                        echo "<option value='" . $data['LecID'] . "'>" . $fullName . "</option>";
                    }
                ?>
            </select>

            <table class="table px-5" >
                <tbody>
            <?php

                $stmt3 = $pdo->query("SELECT Category,Content,QuestionID FROM question where Type='L'");
                $index = 1; // Initialize a counter for radio button names
                $currentCategory = null;

                while($data = $stmt3->fetch(PDO::FETCH_ASSOC)) {
                    // Check if the category has changed
                    if ($data['Category'] !== $currentCategory) {
                        // If the category has changed, display the new category row
                        $currentCategory = $data['Category'];
                        echo "<tr><td colspan='6'><strong>$currentCategory</strong></td></tr>";
                    }

                        // Generate a unique name for the radio button group
                        $radioGroupName = "options-outlined-".$data['QuestionID'];

                        echo "<tr>";
                        echo "<td style=\"padding: 10px;\">&starf;{$data['Content']}</td>";
                        echo "<td colspan=\"6\" class=\"text-center\">";
                        // Output radio buttons with unique names
                        for ($i = 1; $i <= 5; $i++) {
                            $radioValue = $i;
                            
                            echo "<input type=\"radio\" class=\"btn-check\" name=\"$radioGroupName\" id=\"option{$data['QuestionID']}_$i\" autocomplete=\"off\" value=\"$radioValue\">";
                            echo "<label class=\"btn btn-outline-primary\" for=\"option{$data['QuestionID']}_$i\">$i</label>";
                        }
                        echo "</td>";
                        echo "</tr>";

                        $index++; // Increment the counter for the next iteration
                    }
                $index++;
                ?>
                <tr>
                        <td colspan="6">
                            <div class="text-end p-5">
                                <input class="btn btn-primary ms-5" type="submit" value="Submit" style=" border-radius: 6px; padding:10px;">
                            </div>
                        </td>
                    </tr>
                </tbody>
        </form>
        </div>  
















<script>
    var currentDate = new Date();
    var currentDateElement = document.getElementById("currentDate");
    currentDateElement.textContent = currentDate.toDateString();
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>