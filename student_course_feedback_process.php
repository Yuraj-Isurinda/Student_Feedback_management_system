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


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Loop through the POST data to get all responses
    foreach ($_POST as $key => $value) {
        if (strpos($key, 'options-outlined-') === 0) {
            $question_id = str_replace('options-outlined-', '', $key);
            $response = $value;
            
            $checkstmt = $pdo->prepare("SELECT COUNT(*) FROM course_feedback WHERE CFeedbackID = :question_id AND StudentID = :student_id AND CourseID = :course_id");
           
            $checkstmt->bindParam(':question_id', $question_id, PDO::PARAM_STR);
            $checkstmt->bindParam(':student_id', $student_id, PDO::PARAM_STR);
            $checkstmt->bindParam(':course_id', $CourseID, PDO::PARAM_STR);
           
            $checkstmt ->execute();
            
            if($checkstmt->fetchColumn())
            {
                $feedbackExists = true;
                break;
            }
            
            else
            {
                $stmt = $pdo->prepare("INSERT INTO course_feedback (CFeedbackID, StudentID, CourseID, Rating) VALUES (:question_id, :student_id, :course_id, :response)");


                $stmt->bindParam(':question_id', $question_id, PDO::PARAM_STR);
                $stmt->bindParam(':student_id', $student_id, PDO::PARAM_STR);
                $stmt->bindParam(':course_id', $CourseID, PDO::PARAM_STR);  
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
