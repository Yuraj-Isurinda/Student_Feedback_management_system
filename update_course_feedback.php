<?php
include 'database_connection.php';
session_start();

if (isset($_SESSION['student_id'])) {
    $student_id = $_SESSION['student_id'];
} else {
    echo "student id not set";
    exit();
}

if (isset($_SESSION['CourseCode'])) {
    $CourseID = $_SESSION['CourseCode'];
} else {
    echo "course id not set";
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Delete existing feedback
    $deleteStmt = $pdo->prepare("DELETE FROM course_feedback WHERE StudentID = :student_id AND CourseID = :course_id");
    $deleteStmt->bindParam(':student_id', $student_id, PDO::PARAM_STR);
    $deleteStmt->bindParam(':course_id', $CourseID, PDO::PARAM_STR);
    try {
        $deleteStmt->execute();
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        exit();
    }

    // Insert new feedback
    foreach ($_POST as $key => $value) {
        if (strpos($key, 'options-outlined-') === 0) {
            $question_id = str_replace('options-outlined-', '', $key);
            $response = $value;

            $stmt = $pdo->prepare("INSERT INTO course_feedback (CFeedbackID, StudentID, CourseID, Rating) VALUES (:question_id, :student_id, :course_id, :response)");
            $stmt->bindParam(':question_id', $question_id, PDO::PARAM_STR);
            $stmt->bindParam(':student_id', $student_id, PDO::PARAM_STR);
            $stmt->bindParam(':course_id', $CourseID, PDO::PARAM_STR);
            $stmt->bindParam(':response', $response, PDO::PARAM_INT);

            try {
                $stmt->execute();
                $feedbackUpdated = true;
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
        }
    }

    if (isset($feedbackUpdated) && $feedbackUpdated) {
        echo "<script>
            alert('Feedback successfully updated');
            window.location.href = 'student_interface.php';
            </script>";
    }

} else {
    echo "Invalid request method.";
}
?>
