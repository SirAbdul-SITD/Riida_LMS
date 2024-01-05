<?php
require("settings.php");

try {
    // Check if the form is submitted
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Extract form data
        $class = $_POST['class'];
        $term = $_POST['term'];
        $subject = $_POST['subject'];
        $teacher_id = $_POST['teacher_id'];

        $query = "SELECT * FROM teachers WHERE id = :teacher_id";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':teacher_id', $teacher_id, PDO::PARAM_INT);
        $stmt->execute();
        $teachers = $stmt->fetch(PDO::FETCH_ASSOC);

        
        $teacher_name = $teachers['first_name']. ' ' .$teachers['last_name'];
        $mode = $_POST['mode'];

        $topics = $_POST['topics'];
        $schedule_days = $_POST['schedule_day'];
        $schedule_times = $_POST['schedule_time'];
        $topics_no = count($topics) - 1;

        // foreach ($topics as $topic) {
        //     if ($topic !== '') {
        //         ;
        //     }
        // }

        $schedule_no = count($schedule_times);

        // Execute the INSERT query for schedule_table
        $stmt = $pdo->prepare("INSERT INTO subjects (class, term, subject, teacher_id, teacher_name, mode, topics_no, schedule_no) VALUES (:class, :term, :subject, :teacher_id, :teacher_name, :mode, :topics_no, :schedule_no)");
        $stmt->bindParam(':class', $class, PDO::PARAM_STR);
        $stmt->bindParam(':term', $term, PDO::PARAM_STR);
        $stmt->bindParam(':subject', $subject, PDO::PARAM_STR);
        $stmt->bindParam(':teacher_id', $teacher_id, PDO::PARAM_STR);
        $stmt->bindParam(':teacher_name', $teacher_name, PDO::PARAM_STR);
        $stmt->bindParam(':mode', $mode, PDO::PARAM_STR);
        $stmt->bindParam(':topics_no', $topics_no, PDO::PARAM_STR);
        $stmt->bindParam(':schedule_no', $schedule_no, PDO::PARAM_STR);

        // Execute the statement and get the last inserted ID
        $stmt->execute();
        $lastInsertedId = $pdo->lastInsertId();

        // Iterate through the submitted schedule days data
        for ($i = 0; $i < count($schedule_days); $i++) {
            $schedule_day = $schedule_days[$i];
            $schedule_time = $schedule_times[$i];

            // Execute the INSERT query for schedule_days_table
            $stmt = $pdo->prepare("INSERT INTO class_schedule (subject_id, subject, schedule_day, schedule_time) VALUES (:subject_id, :subject, :schedule_day, :schedule_time)");
            $stmt->bindParam(':subject_id', $lastInsertedId, PDO::PARAM_INT);
            $stmt->bindParam(':schedule_day', $schedule_day, PDO::PARAM_STR);
            $stmt->bindParam(':schedule_time', $schedule_time, PDO::PARAM_STR);
            $stmt->bindParam(':subject', $subject, PDO::PARAM_STR);
            $stmt->execute();
        }

        // Iterate through the submitted topics data
        foreach ($topics as $topic) {
            if ($topic !== '') {
                // Execute the INSERT query for topics_table
                $stmt = $pdo->prepare("INSERT INTO topics (subject_id, topic) VALUES (:subject_id, :topic)");
                $stmt->bindParam(':subject_id', $lastInsertedId, PDO::PARAM_INT);
                $stmt->bindParam(':topic', $topic, PDO::PARAM_STR);
                $stmt->execute();

                $lastInsertedTopicId = $pdo->lastInsertId();

                $userMessage = "Generate detailed steps on how to effectively teach this topic: " . $topic . " to " .$class . " pupils";

                // Your OpenAI API key
                $api_key = "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";

                // Data to send in the POST request
                $data = json_encode([
                    'model' => 'gpt-3.5-turbo',
                    'messages' => [
                        [
                            "role" => "system",
                            "content" => "You're an class teacher responsible for generating detailed lesson plan with step by step instructions on how to teach a given topic.",
                        ],
                        [
                            'role' => 'user',
                            'content' => $userMessage,
                        ],
                    ],
                ]);

                // Set the cURL options
                $ch = curl_init('https://api.openai.com/v1/chat/completions');
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
                curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_HTTPHEADER, [
                    'Content-Type: application/json',
                    'Authorization: Bearer ' . $api_key,
                ]);

                // Execute the cURL request
                $api_response = curl_exec($ch);

                // Check for cURL errors
                if (curl_errno($ch)) {
                    echo 'cURL error: ' . curl_error($ch);
                } else {
                    // Decode the JSON response
                    $responseData = json_decode($api_response, true);

                    // Access and echo the assistant's message content
                    $assistantContent = $responseData['choices'][0]['message']['content'];

                    // Insert the generated content into your database or process it as needed
                    // Execute the INSERT query for topic_contents table
                    $stmtUpdate = $pdo->prepare("UPDATE topics SET content = :content WHERE id = :id");
                    $stmtUpdate->bindParam(':content', $assistantContent, PDO::PARAM_STR);
                    $stmtUpdate->bindParam(':id', $lastInsertedTopicId, PDO::PARAM_INT);
                    $stmtUpdate->execute();
                }

                // Close the cURL session outside of the else block
                curl_close($ch);
            }
        }

        // Echo the success response outside the foreach loop
        $response = ['success' => true, 'response' => 'success', 'message' => 'Subject successfully created, content generating...'];
        echo json_encode($response);
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
