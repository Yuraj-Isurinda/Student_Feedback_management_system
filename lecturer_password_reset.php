<?php
include 'database_connection.php';
session_start();
if(isset($_SESSION['LecID'])) {
    $LecID = $_SESSION['LecID'];
} else {
    header("Location: Login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $password = $_POST['password'];
    // Encrypt the password (You should use a more secure encryption method)
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    
    // Update password in the database
    $stmt = $pdo->prepare("UPDATE lecturer SET Password = :password WHERE LecID = :LecID");
    $stmt->bindParam(':password', $hashed_password);
    $stmt->bindParam(':LecID', $LecID);
    $stmt->execute();
    // Redirect to some confirmation page
    header("Location: lecturer_interface.php");
    exit();
}

$stmt = $pdo->query("SELECT FName,LName,LecID,DepID,Email FROM lecturer WHERE LecID='$LecID'");
$data = $stmt->fetch(PDO::FETCH_ASSOC);
$stmt2 = $pdo->query("SELECT DepName FROM department WHERE DepID='{$data['DepID']}'");
$data2 = $stmt2->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Password - Student Feedback Management System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
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
            <h1>UPDATE PASSWORD</h1>
            <hr style="height: 2px; margin: 10px 0;">
        </div>
        <div class="row">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="lecturer_interface.php">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Update Password</li>
                </ol>
            </nav>  
        </div>
        <div class="container">
            <h2>Update Password</h2>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                <input type="password" name="password" placeholder="New Password" required>
                <input type="submit" class="btn btn-primary" value="Update Password">
            </form>
        </div>
    </div>
</body>
</html>
