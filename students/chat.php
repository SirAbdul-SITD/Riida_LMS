<?php
// Assuming $pdo is already established
require("../settings.php");

try {
  // Check if the form is submitted
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['subject_id'])) {

      // Extract form data
      $subject_id = $_POST['subject_id'];

      $query = "SELECT content FROM topics WHERE id = :subject_id";
      $stmt = $pdo->prepare($query);
      $stmt->bindParam(':subject_id', $subject_id, PDO::PARAM_INT);
      $stmt->execute();
      $topic_content = $stmt->fetch(PDO::FETCH_ASSOC);

      $content = $topic_content['content'];

      // Echo the success response outside the foreach loop
      $response = ['success' => true, 'response' => 'success', 'content' => $content, 'id' => $subject_id];
      echo json_encode($response);


    } elseif (isset($_POST['message'])) {

      // Extract form data
      $userMessage = $_POST['message'];
      $history = $_POST['history'];

      // Convert the conversation history to the required format
      $historyString = implode("\n", array_map(function ($message) {
        return $message['role'] . ': ' . $message['content'];
      }, $history));


      // Your OpenAI API key
      $api_key = "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";

      // Initialize or retrieve the conversation history from the PHP session
      $conversationHistory = isset($_SESSION['conversation_history']) ? $_SESSION['conversation_history'] : $_SESSION['conversation_history'] = $history;


      // Data to send in the POST request
      $data = json_encode([
        'model' => 'gpt-3.5-turbo',
        'messages' => [
          [
            "role" => "system",
            "content" => "You're a casual teacher for grade 7 students, make use of the provided conversation history to provide your next response",
          ],
          [
            'role' => 'user',
            'content' => $userMessage,
          ],
          //  Include the conversation history
          [
            'role' => 'assistant',
            'content' => "conversation history: $historyString",
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

        // Update the conversation history in the PHP session
        //  $_SESSION['conversation_history'] = $conversationHistory;


      }

      // Close the cURL session outside of the else block
      curl_close($ch);

      $response = ['success' => true, 'message' => $assistantContent, 'response' => 'success', 'content' => $assistantContent];
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