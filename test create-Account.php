<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Account - Student Feedback Management System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        body {
            padding: 3em;
        }
        .container {
            width: 600px;
            margin: 100px auto;
            background: #fff;
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
            background-color: #137e91;
            color: #fff;
            border: none;
            padding: 10px;
            border-radius: 3px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        input[type="submit"]:hover {
            background-color: #0056b3;
        }
        .create-account {
            text-align: center;
            margin-top: 15px;
        }
        .create-account a {
            color: #007bff;
            text-decoration: none;
        }
        .create-account a:hover {
            text-decoration: underline;
        }
    </style>       
</head>
<body>
    <?php
    // Show alert messages
    if (isset($_GET['err'])) {
        $error = $_GET['err'];
        $errorMessage = "";

        switch ($error) {
            case "empty_index":
                $errorMessage = "Please fill in all required fields.";
                break;
            case "password_not_match":
                $errorMessage = "Passwords do not match. Please try again.";
                break;
            case "email_available_the_system":
                $errorMessage = "This registration number is already registered. Please use a different one.";
                break;
            default:
                $errorMessage = "An unknown error occurred. Please try again.";
        }

        if (!empty($errorMessage)) {
            echo "<script>alert('$errorMessage');</script>";
        }
    }
    ?>

    <?php
        include 'header.php';
        ?>
    <div class="container">
        <h2>Register Form</h2>
        <form action="test register.php" method="POST">
            <input type="text" name="regNo" placeholder="Registration Number   Eg-20XX/E/XXX" required>
            <input type="text" name="indexNo" placeholder="Index Number   Eg-EXXXX" required>
            <input type="text" name="firstname" placeholder="First Name" required>
            <input type="text" name="lastname" placeholder="Last Name" required>
            <input type="text" name="semester" placeholder="Semester" required>
            <input type="email" name="email" placeholder="Student Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <input type="password" name="confirm_password" placeholder="Confirm Password" required>
            <select name="badge">
                <option value="" disabled selected>Select Batch</option>
                <option value="E19">E19</option>
                <option value="E20">E20</option>
                <option value="E21">E21</option>
                <option value="E22">E22</option>
                <option value="E23">E23</option>
            </select>
            <select name="department">
                <option value="" disabled selected>Select Department</option>
                <option value="5">General Program</option>
                <option value="2">Department of Civil Engineering</option>
                <option value="3">Department of Electrical and Electronic Engineering</option>
                <option value="1">Department of Computer Engineering</option>
                <option value="4">Department of Mechanical Engineering</option>
            </select>
            <input type="submit" name="btn-submit" value="Create Account">
        </form>
        <div class="login-link">
            Already have an account? <a href="Login.php">Login</a>.
        </div>
    </div>
</body>
</html>
