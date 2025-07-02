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
        .sidenav {
            height: 100%;
            width: 0; /* Initially hidden */
            position: fixed;
            z-index: 1;
            top: 0;
            left: 0;
            background-color: #137e91;
            padding-top: 60px;
            overflow-x: hidden;
            transition: 0.5s; /* Smooth transition */
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
        .toggle-btn {
            position: fixed; /* Fixed position */
            top: 20px;
            left: 20px; /* Adjusted position */
            font-size: 20px;
            cursor: pointer;
            z-index: 2;
        }

    </style>
</head>
<body>
<div>
       <?php include 'header.php';?>
</div>

<div class="toping">
    <h2 style="margin: 0;">Add New Question Form</h2>
</div>

<div class="row py-3">
            <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="test_Madashbord.php">Home</a></li>
            <li class="breadcrumb-item"><a href="test_Madashbord.php">Feedback Questionnaire</a></li>
            <li class="breadcrumb-item active" aria-current="page">Add New Question</li>
            </ol>
            </nav>
</div>


<div class="content">
    <form action="test_add-QuestionQuery.php " method="post">

        <label for="Qid">Question ID:</label>
        <input type="text" id="Qid" name="Qid" placeholder="Question ID eg-QXX"  required>

        <label for="Qtype">Question Type:</label>
        <input type="text" id="Qtype" name="Qtype" placeholder="L-lecturer or C-Course"  required>

        <label for="Qcat">Question Category:</label>
        <input type="text" id="Qcat" name ="Qcat"  placeholder="Enter the Question Catagory"  required>

        <label for="Qcon">Question Content:</label>
        <input type="text" id="Qcon" name="Qcon" placeholder="Enter the Question Content" required>


        <button type="submit" class="submit-btn" name="addnew">Add Question</button>
    </form>
</div>

<div class="sidenav" id="mySidenav" style="padding-top: 90px;">
    <a href="test_Madashbord.php">Dashboard</a>
    <a href="ma_view_course_feedback.php">Course Feedback</a>
    <a href="ma_view_lecturer_feedback.php">Lecturer Feedback</a>
    <a href="courselist.php">Course List</a>
    <a href="lecturelist.php">Lecture List</a>
    <a href="student_list.php">Student List</a>
    <a href="ma_course_allocation.php">Course Allocation</a>
    <a href="test_questions.php">Feedback Questionnaire</a>
    <a href="summary.php">Summary</a>
    <a href="notice.php">Notice</a>
    <a href="ma_reset_password.php">Reset Password</a>
    <a href="Login.php">Log Out</a>
</div>

<div class="toggle-btn" onclick="toggleNav()" style=" padding-top: 40px; ">&#9776;</div>

<script>
    function toggleNav() {
        var sidenav = document.getElementById("mySidenav");
        var content = document.getElementsByClassName("content")[0];
        if (sidenav.style.width === "250px") {
            sidenav.style.width = "0";
            content.style.marginLeft = "0";
        } else {
            sidenav.style.width = "250px";
            content.style.marginLeft = "250px";
        }
    }
</script>

</body>
</html>
