<?php
require_once "database_connection.php"; // Ensure your PDO connection is included

// Check if form was submitted
if(isset($_POST["addnew"])){
    // Retrieve form data
    $Qid = $_POST["Qid"];
    $Qtype = $_POST["Qtype"];
    $Qcat = $_POST["Qcat"];
    $Qcon = $_POST["Qcon"];

    try {
        // Prepare INSERT query
        $sql = "INSERT INTO question (QuestionID, Type, Category, Content) VALUES (?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);

        // Bind parameters and execute query
        $stmt->execute([$Qid, $Qtype, $Qcat, $Qcon]);

        // Check if insertion was successful
        if ($stmt->rowCount() > 0) {
            header("Location: ./test_questions.php");
            exit;
        } else {
            echo "Insert failed: No rows affected.";
        }
    } catch (PDOException $e) {
        echo "Insert failed: " . $e->getMessage();
        header("Location: ./test_questions.php");

    }
}
?>
