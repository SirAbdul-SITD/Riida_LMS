<?php
require("settings.php");

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Extract form data
    $class = $_POST['class'];
    $term = $_POST['term'];
    $subject = $_POST['subject'];
    $tutor = $_POST['tutor'];
    $mode = $_POST['mode'];

    $topics = $_POST['topics'];
    $schedule_days = $_POST['schedule_day'];
    $schedule_times = $_POST['schedule_time'];
    $topics_no = count($topics);
    $schedule_no = count($schedule_times);

    // Execute the INSERT query for subjects table
    $stmt = $pdo->prepare("INSERT INTO subjects (class, term, subject, tutor, mode, topics_no, schedule_no) VALUES (:class, :term, :subject, :tutor, :mode, :topics_no, :schedule_no)");
    $stmt->bindParam(':class', $class, PDO::PARAM_STR);
    $stmt->bindParam(':term', $term, PDO::PARAM_STR);
    $stmt->bindParam(':subject', $subject, PDO::PARAM_STR);
    $stmt->bindParam(':tutor', $tutor, PDO::PARAM_STR);
    $stmt->bindParam(':mode', $mode, PDO::PARAM_STR);
    $stmt->bindParam(':topics_no', $topics_no, PDO::PARAM_INT);
    $stmt->bindParam(':schedule_no', $schedule_no, PDO::PARAM_INT);

    // Execute the statement and get the last inserted ID
    $stmt->execute();
    $lastInsertedId = $pdo->lastInsertId();

    // Iterate through the submitted schedule days data
    for ($i = 0; $i < count($schedule_days); $i++) {
        $schedule_day = $schedule_days[$i];
        $schedule_time = $schedule_times[$i];

        // Execute the INSERT query for class_schedule table
        $stmt = $pdo->prepare("INSERT INTO class_schedule (subject_id, schedule_day, schedule_time) VALUES (:subject_id, :schedule_day, :schedule_time)");
        $stmt->bindParam(':subject_id', $lastInsertedId, PDO::PARAM_INT);
        $stmt->bindParam(':schedule_day', $schedule_day, PDO::PARAM_STR);
        $stmt->bindParam(':schedule_time', $schedule_time, PDO::PARAM_STR);
        $stmt->execute();
    }

    // Make an API call to Hugging Face Transformers for each topic
    foreach ($topics as $topic) {
        $api_url = 'https://api-inference.huggingface.co/models/HuggingFaceH4/zephyr-7b-beta';
        $data = ['inputs' => $topic];

        // Set up cURL to make the API call
        $ch = curl_init($api_url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
            'Authorization: Bearer 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',
        ]);

        // Execute the cURL request
        $api_response = curl_exec($ch);

        // Check for cURL errors
        if (curl_errno($ch)) {
            echo 'cURL error: ' . curl_error($ch);
            // Handle error appropriately
        } else {
            // Decode and process the API response
            $api_data = json_decode($api_response, true);

            // Assuming the generated content is in $api_data['generated_text']
            $generated_content = $api_data['generated_text'];

            // Insert the generated content into your database or process it as needed
            // Execute the INSERT query for class_schedule table
            $stmt = $pdo->prepare("INSERT INTO topic_contents (subject_id, topic, content) VALUES (:subject_id, :topic, :content)");
            $stmt->bindParam(':subject_id', $lastInsertedId, PDO::PARAM_INT);
            $stmt->bindParam(':topic', $topic, PDO::PARAM_STR);
            $stmt->bindParam(':content', $$generated_content, PDO::PARAM_STR);
            $stmt->execute();

            // Close the cURL session
            curl_close($ch);
        }
    }

    // Respond with a success message
    $response = ['success' => true, 'response' => 'success', 'message' => 'Subject successfully created, content generating...'];
    echo json_encode($response);
    exit();
}
?>