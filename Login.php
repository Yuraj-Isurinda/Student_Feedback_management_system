<?php
session_start();
$_SESSION = array();
session_destroy();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Feedback Management System - Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        body {
            padding: 3em;
        }
        .container {
            width: 300px;
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
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Get the URL parameters
            const params = new URLSearchParams(window.location.search);
            // Check if the 'error' parameter is set
            if (params.has('error')) {
                alert('There was an error processing your login. Please try again.');
            }
        });
    </script>
</head>
<body>
<div class="container-fluid">    
<?php include 'header.php'; ?>    
    <div class="row">
                <h1 class="text-center">FEEDBACK MANAGEMENT SYSTEM</h1>   
    </div>
    <hr style="height: 2px; margin: 10px 0;">
    <div class="container">
        <h2>Login</h2>

        <form action="login_process.php" method="POST">
            <input type="text" name="email" placeholder="User email" required>
            <input type="password" name="password" placeholder="Password" required>
            <select name="userType">
                <option value="" disabled selected>Select User Type</option>
                <option value="student">Student</option>
                <option value="lecture">Lecture</option>
                <option value="admin">Admin</option>
            </select>
            <input type="submit" value="Login">
        </form>

        <div class="create-account">
            <p>Don't have an account? <a href="test create-Account.php">Create one</a>.</p>
        </div>
    </div>
</div>    
</body>
</html>
