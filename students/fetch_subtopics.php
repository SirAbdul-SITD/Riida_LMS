<?php

// Assuming $pdo is already established
require("../settings.php");

// Get the selectedTopicId from the JSON body
$jsonData = file_get_contents('php://input');
$data = json_decode($jsonData, true);

if (isset($data['selectedTopicId'])) {
    // Retrieve the id parameter
    $id = $data['selectedTopicId'];

    try {
        // Fetch subtopics based on the provided id
        $query = "SELECT * FROM topics WHERE id = :topic_id";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':topic_id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $sub_topics = $stmt->fetch(PDO::FETCH_ASSOC);

        if (empty($sub_topics['subtopics'])) {
            // If subtopics are not available, send an API request to generate them
            $topicName = $sub_topics['topic'];

            // Assuming you have an API endpoint for subtopic generation
            $apiEndpoint = 'https://example.com/generate-subtopics';


            $userMessage = "generate 5 subtopics with a detailed explanation for each subtopic for this topic: '$topicName', let the response be in this json format: { 'subtopics': [ { 'name': '', 'status': 'Queued', 'content': '' } ] }. where the name is the topic name and the content is the detailed explanation you generated";

            // Your OpenAI API key
            $api_key = "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";

            // Data to send in the POST request
            $data = json_encode([
                'model' => 'gpt-3.5-turbo',
                'messages' => [
                    [
                        "role" => "system",
                        "content" => "You're a class teacher responsible for generating subtopics with a detailed explanation for a given topic. If you're able to successfully execute the command, include 'status code: 200' in your response and if for any reason you're unable to successfully execute the command, explain why and include 'status code: 400' in your response",
                    ],
                    [
                        'role' => 'user',
                        'content' => $userMessage,
                    ],
                    //  Include the conversation history
                    // [
                    //   'role' => 'assistant',
                    //   'content' => $conversationHistory,
                    // ],
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


            }

            // Close the cURL session outside of the else block
            curl_close($ch);

            // Extract status code from the response
            preg_match('/status code: (\d+)/', $assistantContent, $matches);
            $status = isset($matches[1]) ? intval($matches[1]) : null;

            // Remove the status code from the response
            $rinda_response = preg_replace('/status code: \d+/', '', $assistantContent);

            if ($status != 200) {


                // Decode the API response
                $subtopicData = json_decode($rinda_response, true);
                $subtopics = json_encode($subtopicData);
                // Update the database with the received subtopics
                $query = "UPDATE topics SET subtopics = :subtopics WHERE id = :topic_id";
                $stmt = $pdo->prepare($query);
                $stmt->bindParam(':subtopics', $subtopics, PDO::PARAM_STR);
                $stmt->bindParam(':topic_id', $id, PDO::PARAM_INT);
                $stmt->execute();


                // Return the subtopics data as JSON
                header('Content-Type: application/json');
                echo json_encode($subtopicData);



            } else {
                // Output an error response if the status code is not 200
                $response = ['success' => false, 'response' => 'error', 'content' => $assistantContent, 'message' => 'Failed to retrieve content. Status code: ' . $status];
                echo json_encode($response);
            }





        } else {
            // Subtopics are available, use them directly
            $subtopicData = json_decode($sub_topics['subtopics'], true);
            echo json_encode($subtopicData);
        }




    } catch (PDOException $e) {
        // Handle PDO exceptions
        http_response_code(500);
        echo json_encode(['error' => $e->getMessage()]);
    }
} else {
    // 'id' parameter is missing
    http_response_code(400);
    echo json_encode(['error' => 'Missing id parameter']);
}
?>