<?php
    session_start();
    if(isset($_SESSION['MAID']))
    {
        $MAID = $_SESSION['MAID'];
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
    <title>Add New Student</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        body {
            padding: 3em;
        }
        .toping {
            background-color: #137e91;
            color: #fff;
            padding: 10px;
            text-align: center;
        }
        .content {
            padding: 20px;
            margin: 0 auto;
            max-width: 600px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
        }
        .content h3 {
            margin-top: 0;
        }
        .content label {
            display: block;
            margin: 10px 0 5px;
        }
        .content input[type="text"], .content input[type="email"], .content input[type="password"], .content select {
            width: calc(100% - 22px);
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .content .submit-btn {
            background-color: #137e91;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 10px;
            display: inline-block;
        }
        .content .submit-btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
<div class="">
    <?php include 'header.php'?>
</div>
<div class="toping">
    <h2 style="margin: 0;">Add New Student </h2>
</div>
<div class="row py-3">
            <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="test_Madashbord.php">Home</a></li>
            <li class="breadcrumb-item"><a href="student_list.php">Student List</a></li>
                <li class="breadcrumb-item active" aria-current="page">Add New Student</li>
            </ol>
            </nav>
</div>

<div class="content">
    <form action="test_add-studentQuery.php " method="post">

        <label for="regno">Registration Number:</label>
        <input type="text" id="regno" name="regno" placeholder="Registration Number eg-2021/E/xxx"  required>

        <label for="index">Index Number:</label>
        <input type="text" id="index" name="index" placeholder="Index Number eg-EXXXX"  required>

        <label for="fname">First Name:</label>
        <input type="text" id="fname" name="fname" placeholder="First name"  required>

        <label for="lname">Last Name:</label>
        <input type="text" id="lname" name ="lname"  placeholder="Last name"  required>

        <label for="department">Department:</label>
        <select id="department" name="department">
            <option value="">Select Department</option>
            <?php
            require_once "database_connection.php";

            $sql = "SELECT DepID, DepName FROM department";
            $stmt = $pdo->query($sql);
            $departments = $stmt->fetchAll(PDO::FETCH_ASSOC);

            foreach ($departments as $dept) {
                echo '<option value="' . $dept['DepID'] . '">' . $dept['DepName'] . '</option>';
            }
            ?>
        </select>

        <label for="semester">Semester:</label>
        <input type="text" id="semester" name="semester" placeholder="Current learning Semeseter" required>

        <label for="email">Student email:</label>
        <input type="email" id="email" name="email" placeholder="Student Email" required>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" placeholder="Password" required>

        <label for="badge">Badge:</label>
        <input type="text" id="badge" name="badge" placeholder="Current Badge eg-EXX" required>

        <label for="status">Status:</label>
        <input type="text" id="status" name="status" placeholder="Active or pending" required>
   
        </select>

        <button type="submit" class="submit-btn" name="addnew">Add Student</button>
    </form>
</div>

</body>
</html>
