<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Request Sent - Student Feedback Management System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        body{
            padding: 3em;
        }
        .container {
            width: 700px;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="row">
        <div class="container-fluid">
             <?php include "header.php";?>
        </div>
    </div>
 
    <div class="row">
        <div class="container">
            <h2>Your Request Has Been Sent</h2>
            <p></p>
            <p>Thank you for creating an account. Your request has been sent to the management assistant. You will receive further instructions via email. <a href="login.php">Return to Login</a></p>
        </div>
    </div>


</body>
</html>
