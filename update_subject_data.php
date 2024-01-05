<?php
require("settings.php");

try {
    // Check if the form is submitted
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $subject_id = $_POST['subject_id'];
        $teacher_id = $_POST['teacher_id'];

        $query = "SELECT * FROM teachers WHERE id = :teacher_id";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':teacher_id', $teacher_id, PDO::PARAM_INT);
        $stmt->execute();
        $teachers = $stmt->fetch(PDO::FETCH_ASSOC);

        $teacher_name = $teachers['first_name'] . ' ' . $teachers['last_name'];
        $mode = $_POST['mode'];

        $schedule_days = $_POST['schedule_day'];
        $schedule_times = $_POST['schedule_time'];
        $schedule_no = count($schedule_times);

        // Check if the subject already exists
        $checkQuery = "SELECT * FROM subjects WHERE subject_id = :subject_id";
        $checkStmt = $pdo->prepare($checkQuery);
        $checkStmt->bindParam(':subject_id', $subject_id, PDO::PARAM_INT);
        $checkStmt->execute();

        if ($checkStmt->rowCount() > 0) {
            $subjectData = $checkStmt->fetch(PDO::FETCH_ASSOC);
            $subject = $subjectData['subject'];

            // Subject exists, update the existing record
            $updateStmt = $pdo->prepare("UPDATE subjects SET mode = :mode, schedule_no = :schedule_no, teacher_id = :teacher_id WHERE subject_id = :subject_id");
            $updateStmt->bindParam(':mode', $mode, PDO::PARAM_STR);
            $updateStmt->bindParam(':schedule_no', $schedule_no, PDO::PARAM_INT);
            $updateStmt->bindParam(':teacher_id', $teacher_id, PDO::PARAM_STR);
            $updateStmt->bindParam(':subject_id', $subject_id, PDO::PARAM_INT);
            $updateStmt->execute();

            // Delete existing schedule records
            $deleteScheduleStmt = $pdo->prepare("DELETE FROM class_schedule WHERE subject_id = :subject_id");
            $deleteScheduleStmt->bindParam(':subject_id', $subject_id, PDO::PARAM_INT);
            $deleteScheduleStmt->execute();

            // Iterate through the submitted schedule days data
            for ($i = 0; $i < count($schedule_days); $i++) {
                $schedule_day = $schedule_days[$i];
                $schedule_time = $schedule_times[$i];

                // Execute the INSERT query for schedule_days_table
                $stmt = $pdo->prepare("INSERT INTO class_schedule (subject_id, subject, schedule_day, schedule_time) VALUES (:subject_id, :subject, :schedule_day, :schedule_time)");
                $stmt->bindParam(':subject_id', $subject_id, PDO::PARAM_INT);
                $stmt->bindParam(':schedule_day', $schedule_day, PDO::PARAM_STR);
                $stmt->bindParam(':schedule_time', $schedule_time, PDO::PARAM_STR);
                $stmt->bindParam(':subject', $subject, PDO::PARAM_STR);
                $stmt->execute();
            }

            $response = ['success' => true, 'response' => 'success', 'message' => 'Subject successfully updated, content generating...'];
            echo json_encode($response);
        }
    }
} catch (PDOException $e) {
    // Handle PDO exceptions
    $response = ['success' => false, 'response' => 'error', 'message' => $e->getMessage()];
    echo json_encode($response);
} catch (Exception $e) {
    // Handle other exceptions
    $response = ['success' => false, 'response' => 'error', 'message' => $e->getMessage()];
    echo json_encode($response);
}
?>
