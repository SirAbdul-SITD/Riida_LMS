<?php
// Assuming $pdo is already established
require("../settings.php");

try {
  // Check if the form is submitted
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['topicContent'])) {
      // Extract form data
      $message = $_POST['message'];
      $content = $_POST['topicContent'];
  
      $userMessage = "regenerate this content :'" . $content . "', but this time around use this instructions: '" .$message . "'.";
  
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
  
      // Echo the success response outside the foreach loop
      $response = ['success' => true, 'response' => 'success', 'content' => $assistantContent];
      echo json_encode($response);
    } else if (isset($_POST['questionContent'])) {


      // Extract form data
      $message = $_POST['focus'];
      $content = $_POST['questionContent'];
  
      $userMessage = "regenerate this :'" . $content . "', but this time around use this instructions: '" .$message . "'.  return response in json format";
  
      // Your OpenAI API key
      $api_key = "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";
  
      // Data to send in the POST request
      $data = json_encode([
        'model' => 'gpt-3.5-turbo',
        'messages' => [
          [
            "role" => "system",
            "content" => "You're a class teacher responsible for generating exam questions.",
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
  
      // Echo the success response outside the foreach loop
      $response = ['success' => true, 'response' => 'success', 'content' => $assistantContent];
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