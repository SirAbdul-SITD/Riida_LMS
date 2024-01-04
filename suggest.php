<?php
// var_dump($_POST);


// Check if the message parameter is set in the POST request
// if (isset($_POST['subject'])) {

    $subject = 'Physics';
    $class = 'SSS 1';

    // $subject = $_POST['new_subject'];
    // $class = $_POST['new_class'];


    $userMessage = "Generate 5 suggestions of topics in subject :" . $subject . ". i can teach students in:" . $class . " class\n";

    // $question = $ask;

    // Your OpenAI API key
    $api_key = "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";


    // Data to send in the POST request
    $data = json_encode([
        'model' => 'gpt-3.5-turbo',
        'messages' => [
            [
                "role" => "system",
                "content" => "You're an class teacher responsible for given suggestions on topics to treat der a given subject for a given class. Format the output in JSON.",                  
            ],
            [
                'role' => 'user',
                'content' => $userMessage,
            ],
            // Include the conversation history
            // [
            //     'role' => 'assistant',
            //     'content' => $conversationHistory,
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
    $response = curl_exec($ch);

    // Check for cURL errors
    if (curl_errno($ch)) {
        echo 'cURL error: ' . curl_error($ch);
    } else {
        // Decode the JSON response
        $responseData = json_decode($response, true);

        // Access and echo the assistant's message content
        $assistantContent = $responseData['choices'][0]['message']['content'];

        // Update the conversation history in the PHP session
        $_SESSION['conversation_history'] = $conversationHistory;

        echo $assistantContent;
    }

    // Close the cURL session
    curl_close($ch);
// } else {
//     echo "No message received."; // Handle cases where no message is sent
// }
?>