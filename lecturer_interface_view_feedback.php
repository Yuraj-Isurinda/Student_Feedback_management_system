<?php
session_start();
include "database_connection.php";

if (isset($_GET['CourseCode'])) {
    $CourseCode = $_GET['CourseCode'];
} else {
    echo "CourseCode not set";
    exit;
}

if (isset($_GET['batch'])) {
    $batch = $_GET['batch'];

    // Prepare and execute the query to get ratings count, ordered by Rating
    $stmt = $pdo->prepare("
        SELECT LFeedbackID, Rating, COUNT(*) AS count
        FROM lecturer_feedback
        WHERE StudentBatch = :batch AND LecID = :LecID AND CourseCode = :CourseCode
        GROUP BY LFeedbackID, Rating
        ORDER BY Rating ASC
    ");
    $stmt->execute(['batch' => $batch, 'LecID' => $_SESSION['LecID'], 'CourseCode' => $CourseCode]);
    $ratings = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Prepare and execute the query to get total feedback count per LFeedbackID
    $stmt = $pdo->prepare("
        SELECT LFeedbackID, COUNT(*) AS total_count
        FROM lecturer_feedback
        WHERE StudentBatch = :batch AND LecID = :LecID AND CourseCode = :CourseCode
        GROUP BY LFeedbackID
    ");
    $stmt->execute(['batch' => $batch, 'LecID' => $_SESSION['LecID'], 'CourseCode' => $CourseCode]);
    $totalCounts = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Organize total counts by LFeedbackID for easy access
    $totalCountsMap = [];
    foreach ($totalCounts as $totalCount) {
        $totalCountsMap[$totalCount['LFeedbackID']] = $totalCount['total_count'];
    }

    // Prepare and execute the query to get questions content
    $stmt = $pdo->prepare("
        SELECT QuestionID, Content
        FROM question
        WHERE QuestionID IN (
            SELECT DISTINCT LFeedbackID
            FROM lecturer_feedback
            WHERE StudentBatch = :batch AND LecID = :LecID AND CourseCode = :CourseCode
        )
    ");
    $stmt->execute(['batch' => $batch, 'LecID' => $_SESSION['LecID'], 'CourseCode' => $CourseCode]);
    $questions = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    // Organize questions by QuestionID for easy access
    $questionsMap = [];
    foreach ($questions as $question) {
        $questionsMap[$question['QuestionID']] = $question['Content'];
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <title>My Feedbacks <?php echo htmlspecialchars($CourseCode); ?></title>
    <style>
        body {
            padding: 3em;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <?php include "header.php"; ?>
        <div class="row">
            <h1 class="text">FEEDBACK SUMMARY</h1>
        </div>
        <hr style="height: 2px; margin: 10px 0;">
        <div class="row">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="lecturer_interface.php">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Feedback Summary</li>
                </ol>
             </nav> 
        </div>
        <div class="row">
            <?php
                // Fetch distinct student batches for the dropdown
                $stmt = $pdo->prepare("SELECT DISTINCT StudentBatch FROM lecturer_feedback WHERE LecID = :LecID AND CourseCode = :CourseCode");
                $stmt->execute(['LecID' => $_SESSION['LecID'], 'CourseCode' => $CourseCode]);
            ?>

            <select name="batch" id="batch" class="form-control" style="width: 35%;">
                <option value="">Select Batch</option>
                <?php
                    while ($data = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        echo "<option value=\"" . htmlspecialchars($data['StudentBatch']) . "\">" . htmlspecialchars($data['StudentBatch']) . "</option>";
                    }
                ?>
            </select>
        </div>

        <?php if (isset($ratings) && isset($questionsMap)): ?>
            <div class="feedback-summary">
                <?php 
                $questionNumber = 1;
                foreach ($questionsMap as $questionID => $content): ?>
                    <div class="feedback-item">
                        <h2><?php echo $questionNumber . ". " . htmlspecialchars($content); ?></h2>
                        <?php
                            $total = isset($totalCountsMap[$questionID]) ? $totalCountsMap[$questionID] : 0;
                            foreach ($ratings as $rating) {
                                if ($rating['LFeedbackID'] == $questionID) {
                                    $percentage = $total > 0 ? ($rating['count'] / $total) * 100 : 0;
                                    ?>
                                    <p class="px-5"><strong>Rating: <?php echo htmlspecialchars($rating['Rating']); ?></strong></P>
                                    <p class="px-5">Count: <?php echo htmlspecialchars($rating['count']); ?></p>
                                    <div class="progress">
                                        <div class="progress-bar" role="progressbar" style="width: <?php echo number_format($percentage, 2); ?>%;" aria-valuenow="<?php echo number_format($percentage, 2); ?>" aria-valuemin="0" aria-valuemax="100"><?php echo number_format($percentage, 2); ?>%</div>
                                    </div>
                                    <hr>
                                    <?php
                                }
                            }
                        ?>
                    </div>
                <?php 
                $questionNumber++;
                endforeach; ?>
            </div>
        <?php endif; ?>

        <script>
            document.getElementById("batch").addEventListener("change", function() {
                var selectedBatch = this.value;
                window.location.href = window.location.pathname + "?batch=" + encodeURIComponent(selectedBatch) + "&CourseCode=" + encodeURIComponent("<?php echo $CourseCode; ?>");
            });
        </script>
    </div>
</body>
</html>
