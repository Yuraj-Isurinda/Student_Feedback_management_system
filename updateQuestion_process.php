<?php
require_once "database_connection.php"; // Ensure your PDO connection is included

// Initialize variables to hold data
$Qid = $Qtype = $Qcat = $Qcon = "";

// Check if form was submitted and process update
if (isset($_POST["update"])) {
    $Qid = $_POST["Qid"];
    $Qtype = $_POST["Qtype"];
    $Qcat = $_POST["Qcat"];
    $Qcon = $_POST["Qcon"];

    // Prepare UPDATE query
    $sql = "UPDATE question SET Type=?, Category=?, Content=? WHERE QuestionID=?";
    $stmt = $pdo->prepare($sql);

    // Bind parameters and execute query
    $result = $stmt->execute([$Qtype, $Qcat, $Qcon, $Qid]);

    // Check if update was successful
    if ($result) {
        header("Location: ./test_questions.php"); // Redirect to questions.php after successful update
        exit;
    } else {
        echo "Update failed: " . $stmt->errorInfo()[2]; // Print error message if update fails
    }
}
?>
