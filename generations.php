<?php
// var_dump($_POST);


// Check if the message parameter is set in the POST request
if (isset($_POST['material'])) {
    $question = $_POST['material'];
    $objective_numbers = $_POST['objective'];
    $theory_numbers = $_POST['theory'];
    $question_level = $_POST['level'];


    $userMessage = "Generate " . $objective_numbers . " objective questions and " . $theory_numbers . " Theory Questions from this document between parenthesis: {{" . $question . "}} .The questions should be " . $question_level . " to answer for a grade 1 student\n";

    // $question = $ask;

    // Your OpenAI API key
    $api_key = "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";


    // Data to send in the POST request
    $data = json_encode([
        'model' => 'gpt-3.5-turbo',
        'messages' => [
            [
                "role" => "system",
                "content" => "You're an examiner responsible for setting exam questions. ensure the correct answer is randomly distributed across the options. Only generate questions whose answers can be found within the document content. Please provide the document, and I will generate exam questions accordingly. Make sure the numbers of the objective and theory questions match the numbers of requested objective and theory questions respectively. Format the output in JSON.",                  
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
} else {
    echo "No message received."; // Handle cases where no message is sent
}
?>