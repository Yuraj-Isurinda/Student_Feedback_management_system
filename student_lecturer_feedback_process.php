<?php
include 'database_connection.php';
session_start();

if(isset($_SESSION['UserID']))
{
    $_SESSION['student_id'] = $_SESSION['UserID'];
    $student_id = $_SESSION['student_id'];
}
else
{
    echo "student id not set";
}

if(isset($_SESSION['CourseCode'])){
    $CourseID =  $_SESSION['CourseCode'];;
}
else
{
    echo "course id not set";
}

if (isset($_POST['lecturer']) && !empty($_POST['lecturer'])) {
    $_SESSION['LecID'] = $_POST['lecturer'];
    $lecturer_id = $_POST['lecturer'];
} else {
    echo "Error: Lecturer ID not set";
    exit;
}

if(isset($_SESSION['StudentBatch'])){
    $StudentBatch =  $_SESSION['StudentBatch'];
}
else
{
    echo "batch not set";
}

$feedbackExists = false;
$feedbackSubmitted = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Loop through the POST data to get all responses
    foreach ($_POST as $key => $value) {
        if (strpos($key, 'options-outlined-') === 0) {
            $question_id = str_replace('options-outlined-', '', $key);
            $response = $value;
            
            $checkstmt = $pdo->prepare("SELECT COUNT(*) FROM lecturer_feedback  WHERE LFeedbackID = :question_id AND CourseCode = :CourseCode AND StudentID = :student_id AND StudentBatch = :StudentBatch AND LecID = :lecturer_id");
           
            $checkstmt->bindParam(':question_id', $question_id, PDO::PARAM_STR);
            $checkstmt->bindParam(':CourseCode', $CourseID, PDO::PARAM_STR);
            $checkstmt->bindParam(':student_id', $student_id, PDO::PARAM_STR);
            $checkstmt->bindParam(':StudentBatch', $StudentBatch, PDO::PARAM_STR);
            $checkstmt->bindParam(':lecturer_id', $lecturer_id, PDO::PARAM_STR);
           
            $checkstmt ->execute();
            
            if($checkstmt->fetchColumn())
            {
                $feedbackExists = true;
                break;
            }
            
            else
            {
                $stmt = $pdo->prepare("INSERT INTO lecturer_feedback (LFeedbackID, CourseCode, StudentID, StudentBatch, LecID, Rating) VALUES (:question_id, :CourseCode, :student_id, :StudentBatch, :lecturer_id, :response)");


                $stmt->bindParam(':question_id', $question_id, PDO::PARAM_STR);
                $stmt->bindParam(':CourseCode', $CourseID, PDO::PARAM_STR);
                $stmt->bindParam(':student_id', $student_id, PDO::PARAM_STR);
                $stmt->bindParam(':StudentBatch', $StudentBatch, PDO::PARAM_STR);
                $stmt->bindParam(':lecturer_id', $lecturer_id, PDO::PARAM_STR);  
                $stmt->bindParam(':response', $response, PDO::PARAM_INT);

                try {
                    $stmt->execute();
                    $feedbackSubmitted = true;
     
                } catch (PDOException $e) {
                    echo "Error: " . $e->getMessage();
                }
            }

        }
    }
    

    if($feedbackExists)
    {
        echo "<script>
                if(confirm('Feedback already exists. Thank you'))
                {
                    window.location.href = 'student_interface.php';
                }              
              </script>";
    }

    elseif ($feedbackSubmitted) {
        echo "<script>
            alert('Feedback successfully submitted. Thank you');
            window.location.href = 'student_interface.php';
            </script>";
    }

}
else 
{
    echo "Invalid request method.";
}
?>
