<?php

function inputEmptyReg($regNo,$index ,$fname, $lname, $semester, $email, $password, $repass, $badge, $dep) {
    return empty($regNo) || empty($index) || empty($fname) || empty($lname) || empty($semester) || empty($email) || 
           empty($password) || empty($repass) || empty($badge) || empty($dep);
}

function passwordMatch($password, $repass) {
    return $password !== $repass;
}

function regNoAvailable($pdo, $regNo) {
    $sql = "SELECT * FROM student WHERE RegNo = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$regNo]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    return $row ? true : false;
}

function registerNewUser($pdo, $regNo, $index, $badge, $semester, $fname, $lname, $email, $password, $dep) {
    $sql = "INSERT INTO student(RegNo, indexNo, Batch, Current_semester, Fname, Lname, Email, Password, DepID, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$regNo, $index, $badge, $semester, $fname, $lname, $email, $password, $dep, "Pending"]);
   
    $sql = "
    INSERT INTO student_course (studentID, courseID)
    SELECT ?, courseID
    FROM offer
    WHERE depID = ? AND semester = ?
    ";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([$regNo, $dep, $semester]);
   
   
    header("Location: ./test_request.php");
    exit();
}


function inputEmptylogin($email, $password, $usertype) {
    return empty($email) || empty($password) || empty($usertype);
}

function loginUser($pdo, $email, $password, $usertype) {
    if ($usertype == "student") {
        $sql = "SELECT * FROM student WHERE Email = ?";
    } elseif ($usertype == "admin") {
        $sql = "SELECT * FROM ma WHERE Email = ?";
    } else {
        header("Location: ./login.php?err=invalid_user_type");
        exit();
    }

    $stmt = $pdo->prepare($sql);
    $stmt->execute([$email]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($row) {
        if ($row["Password"] == $password) {
            if ($row["status"] !== "Pending") {
                session_start();
                $_SESSION["UserID"] = $row["Regno"];
                header("Location: ./student.php");
                exit();
            } else {
                header("Location: ./login.php?err=your_account_is_pending");
                exit();
            }
        } else {
            header("Location: ./login.php?err=Invalid_Password");
            exit();
        }
    } else {
        header("Location: ./login.php?err=Invalid_Email");
        exit();
    }
}

?>
