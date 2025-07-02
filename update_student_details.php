<?php include 'database_connection.php'; ?>
<?php
    session_start();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Account - Student Feedback Management System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <?php
        $stmt = $pdo->query("SELECT FName,LName,Current_semester,Batch,RegNo,IndexNo,Email FROM student WHERE Regno={$_SESSION['student_id']}");

        $data = $stmt->fetch(PDO::FETCH_ASSOC);
    ?>

    <style>
        body {
            padding: 3em;
        }
        .container {
            width: 400px;
            margin: 50px auto;
            background: ;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        input[type="text"],
        input[type="email"],
        input[type="password"],
        select {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 3px;
            box-sizing: border-box;
        }
        input[type="submit"] {
            width: 100%;
        }
        input[type="submit"]:hover {
            background-color: #0056b3;
        }
        .login-link {
            text-align: center;
            margin-top: 15px;
        }
        .login-link a {
            color: #007bff;
            text-decoration: none;
        }
        .login-link a:hover {
            text-decoration: underline;
        }

    </style>
</head>
<body>
<div class="container-fluid">
    <?php include 'header.php'; ?>
    <div class="row" id="1">
            <h1>UPDATE ACCOUNT DETAILS</h1>
            <hr style="height: 2px; margin: 10px 0;">
        </div>
<div class="row">
    <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="student_interface.php">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Update Account Details</li>
    </ol>
    </nav>  
</div>
    
    <div class="container">
        <h2>Register Form</h2>
        <form action="update_student_details_process.php" method="POST">
            <input type="hidden" name="regNo" value="<?php echo htmlspecialchars($data['RegNo']); ?>">
            <input type="hidden" name="IndexNo" value="<?php echo htmlspecialchars($data['IndexNo']); ?>">
            <input type="text" name="regNo" placeholder="Registration Number   Eg-20XX/E/XXX" value="<?php echo $data['RegNo'] ?>" disabled required>
            <input type="text" name="IndexNo" placeholder="Index Number" value="<?php echo $data['IndexNo'] ?>" disabled required>
            <input type="text" name="firstname" placeholder="First Name" value="<?php echo $data['FName'] ?>" required>
            <input type="text" name="lastname" placeholder="Last Name" value="<?php echo $data['LName'] ?>" required>
            <input type="text" name="semester" placeholder="Semester " value="<?php echo $data['Current_semester'] ?>" required>
            <input type="email" name="email" placeholder="Student Email" value="<?php echo $data['Email'] ?>" disabled required>
            <select name="badge">
            <option value="E19" <?php if ($data['Batch'] == 'E19') echo 'selected'; ?>>E19</option>
                <option value="E20" <?php if ($data['Batch'] == 'E20') echo 'selected'; ?>>E20</option>
                <option value="E21" <?php if ($data['Batch'] == 'E21') echo 'selected'; ?>>E21</option>
                <option value="E22" <?php if ($data['Batch'] == 'E22') echo 'selected'; ?>>E22</option>
                <option value="E23" <?php if ($data['Batch'] == 'E23') echo 'selected'; ?>>E23</option>
            </select>
           <a href="request.php"> <input type="submit" class="btn btn-primary" value="Update Account"></a>
        </form>

    </div>
</div>    
</body>
</html>
