<?php

include "database_connection.php";
session_start();

if (!(isset($_SESSION['MAID']))) {
    header("Location: Login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $CourseCode = $_POST['CourseCode'];
    $CourseName = $_POST['CourseName'];
    $department = $_POST['department']; 
    $coordinator = $_POST['coordinator']; 
    $semester = $_POST['semester'];
    $selectedLecturers = $_POST['lecturers'];

    try {
        // Start a transaction
        $pdo->beginTransaction();

        // Check if the course already exists
        $stmt = $pdo->prepare("SELECT COUNT(*) FROM course WHERE CourseCode = ? AND DepID = ?");
        $stmt->execute([$CourseCode, $department]);
        $courseExists = $stmt->fetchColumn();

        if ($courseExists > 0) {
            throw new Exception("Course already exists.");
        }

        // Insert the new course
        $stmt = $pdo->prepare("INSERT INTO course (CourseCode, CourseName, Semester, DepID, CoID) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$CourseCode, $CourseName, $semester, $department, $coordinator]);

        // Insert the selected lecturers for the course
        $stmt = $pdo->prepare("SELECT COUNT(*) FROM lecturer_course WHERE LecID = ? AND CourseID = ?");
        $lecturerStmt = $pdo->prepare("INSERT INTO lecturer_course (CourseID, LecID) VALUES (:course_id, :lec_id)");
        foreach ($selectedLecturers as $lecturerID) {
            $stmt->execute([$lecturerID, $CourseCode]);
            $lecturerCourseExists = $stmt->fetchColumn();
            if ($lecturerCourseExists == 0) {
                $lecturerStmt->execute(['course_id' => $CourseCode, 'lec_id' => $lecturerID]);
            }
        }

        // Check if the offer already exists
        $stmt = $pdo->prepare("SELECT COUNT(*) FROM offer WHERE DepID = ? AND CourseID = ?");
        $stmt->execute([$department, $CourseCode]);
        $offerExists = $stmt->fetchColumn();

        if ($offerExists == 0) {
            // Insert into the offer table
            $stmt = $pdo->prepare("INSERT INTO offer (DepID, Semester, CourseID) VALUES (?, ?, ?)");
            $stmt->execute([$department, $semester, $CourseCode]);
        }

        // Commit the transaction
        $pdo->commit();

        // JavaScript alert and redirect
        echo "<script>
                if(confirm('New course added to database. Thank you')) {
                    window.location.href = 'ma_course_allocation.php';
                }              
              </script>";
    } catch (Exception $e) {
        // Rollback the transaction in case of an error
        $pdo->rollBack();
        echo "Error inserting the course: " . $e->getMessage();
        header('Location: ma_course_allocation.php');
        exit;
    }
} else {
    echo "Invalid request method.";
}
?>
