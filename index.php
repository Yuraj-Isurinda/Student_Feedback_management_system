<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedback Management System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body::before {
            content: "";
            background-image: url('images.jpg');
            background-size: 2500px;
            background-position: center;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            z-index: -1;
            filter: blur(5px);
        }

        .overlay {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: -1;
        }

        .content {
            text-align: center;
            color: white;
            margin-top: 25vh;
            z-index: 1;
        }

        .btn-custom {
            background-color: #137e91;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            width: 150px; /* Make the buttons the same width */
        }

        .btn-custom:hover {
            background-color: #0056b3;
        }

        .head {
            padding: 3em;
        }
    </style>
</head>

<body>
    <div class="overlay"></div>

    <div class="head">
        <?php include 'header.php'; ?>
    </div>

    <div class="content">
        <h1>Feedback Management System</h1>
        <h2>Sabaragamuwa University of Sri Lanka - Faculty of Computing</h2>
        <a href="login.php" class="btn btn-custom mt-3">Login</a>
        <a href="test register.php" class="btn btn-custom mt-3">Register</a>
    </div>
</body>

</html>
