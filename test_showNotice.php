<?php
    session_start();
    if($_SESSION['UserID']){
        
    }
    else{
        header("location:./Login.php");
        exit();
    }
require_once "database_connection.php";

try {
    $sql = "SELECT * FROM notice";
    $stmt = $pdo->query($sql);
    ?>
    
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Notice Table</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <style>
        body {
            padding: 3em;
        }
        .toping {
            margin-top: -40px;
            text-align: center; 
        }
        .sidenav {
            height: 100%;
            width: 0; 
            position: fixed;
            z-index: 1;
            top: 0;
            left: 0;
            background-color: #137e91;
            padding-top: 60px;
            overflow-x: hidden;
            transition: 0.5s; 
        }
        .sidenav a {
            padding: 10px 15px;
            text-decoration: none;
            font-size: 18px;
            color: #fff;
            display: block;
        }
        .sidenav a:hover {
            background-color: #555;
        }
        .content {
            transition: margin-left 0.5s; 
        }
        
        .student-details {
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            border-radius: 20px;
        }
        .student-details h3 {
            margin-top: 0;
        }
        
        .course-info {
            margin-top: 20px;
            padding: 20px ;
            background-color: #e9b97f;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .course-info h3 {
            margin-top: 0;
        }
        
        .feedback-btn {
            background-color: #137e91;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            margin-right: 10px;
        }
        
        .toggle-btn {
            position: fixed; 
            top: 20px;
            left: 20px; 
            font-size: 20px;
            cursor: pointer;
            z-index: 2;
        }
        .submit {
            position: right;
            bottom: 20px;
            left: 20px;
        }

        .submit:hover {
            background-color: #0056b3;
        }

        .links-table {
            text-align: center; 
            margin: 0 auto; 
            max-width: 600px;
            width: 100%;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin-top:50px;
        }
        .links-table a {
            display: block;
            padding: 10px 20px;
            margin-bottom: 10px;
            color: #137e91;
            text-decoration: none;
            transition: background-color 0.3s;
        }
        .links-table a:hover {
            background-color: #137e91;
            color: #fff;
        }
        
    </style>
    </head>
    <body>
    <div>
        <?php include 'header.php';?>
    </div>
    <div class="col">
                <h1 class="text-center">FEEDBACK MANAGEMENT SYSTEM</h1>
             
             </div>
             <hr style="height: 2px; margin: 10px 0;">
        </div>
        <div class="links-table">
        <h2 class="text-center mb-4">Notices</h2>
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>Notice Number</th>
                    <th>Notice Content</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo '<tr>';
                    echo '<td>' . htmlspecialchars($row["notice_no"]) . '</td>';
                    echo '<td>' . htmlspecialchars($row["notice_content"]) . '</td>';
                    echo '</tr>';
                }
                ?>
            </tbody>
        </table>
        </div>
    </body>
    </html>
    
    <?php
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
