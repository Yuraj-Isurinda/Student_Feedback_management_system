<?php
include 'database_connection.php'; // Ensure this file has the PDO connection setup
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $email = $_POST['email'];
    $password = $_POST['password'];
    $userType = $_POST['userType'];

    if (empty($email) || empty($password) || empty($userType)) {
        header("Location: login.php?error=true");
        exit();
    }

    $email = filter_var($email, FILTER_SANITIZE_EMAIL);
    $password = htmlspecialchars($password);
    $userType = htmlspecialchars($userType);

    if ($userType == 'student') {
        $sql = "SELECT RegNo, Password, status FROM student WHERE Email = :email";
    } elseif ($userType == 'lecture') {
        $sql = "SELECT LecID, Password FROM lecturer WHERE Email = :email";
    } elseif ($userType == 'admin') {
        $sql = "SELECT MAID, Password FROM managing_assistant WHERE Email = :email";
    } else {
        header("Location: login.php?error=true");
        exit();
    }

    try {
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            // Check if the password is hashed or not
            if (password_verify($password, $row['Password'])) {
                // Password is hashed and matches
                if ($userType == 'student') {
                    if ($row['status'] == "Pending") {
                        header("Location: ./test_request.php");
                        exit();
                    } elseif ($row['status'] == "Active") {
                        $_SESSION['UserID'] = $row['RegNo'];
                        header("Location: student_interface.php");
                        exit();
                    } else {
                        header("Location: login.php?error=true");
                        exit();
                    }
                } elseif ($userType == 'lecture') {
                    $_SESSION['UserID'] = $row['LecID'];
                    header("Location: lecturer_interface.php");
                    exit();
                } elseif ($userType == 'admin') {
                    $_SESSION['UserID'] = $row['MAID'];
                    header("Location: test_Madashbord.php");
                    exit();
                }
            } elseif ($password == $row['Password']) {
                // Password is not hashed and matches (for legacy purposes)
                if ($userType == 'student') {
                    if ($row['status'] == "Pending") {
                        header("Location: ./test_request.php");
                        exit();
                    } elseif ($row['status'] == "Active") {
                        $_SESSION['UserID'] = $row['RegNo'];
                        header("Location: student_interface.php");
                        exit();
                    } else {
                        header("Location: login.php?error=true");
                        exit();
                    }
                } elseif ($userType == 'lecture') {
                    $_SESSION['UserID'] = $row['LecID'];
                    header("Location: lecturer_interface.php");
                    exit();
                } elseif ($userType == 'admin') {
                    $_SESSION['UserID'] = $row['MAID'];
                    header("Location: test_Madashbord.php");
                    exit();
                }
            } else {
                // Password does not match
                header("Location: login.php?error=true");
                exit();
            }
        } else {
            // No user found with the given email
            header("Location: login.php?error=true");
            exit();
        }
    } catch (PDOException $e) {
        // Database query error
        header("Location: login.php?error=true");
        exit();
    }
}
?>
