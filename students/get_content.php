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


    } elseif (isset($_POST['assessment_id'])) {

      // Extract form data
      $assessment_id = $_POST['assessment_id'];

      $query = "SELECT questions FROM assessments WHERE id = :assessment_id";
      $stmt = $pdo->prepare($query);
      $stmt->bindParam(':assessment_id', $assessment_id, PDO::PARAM_INT);
      $stmt->execute();
      $question_content = $stmt->fetch(PDO::FETCH_ASSOC);

      $content = $question_content['questions'];



      $userMessage = "convert this json content: '" . $content . "'. into plain text";

      // Your OpenAI API key
      

      // Data to send in the POST request
      $data = json_encode([
        'model' => 'gpt-3.5-turbo',
        'messages' => [
          [
            "role" => "system",
            "content" => "You're a class teacher responsible for converting json exam questions into plain text. If you're able to successfully execute the command, include 'status code: 200' in your response and if for any reason you're unable to successfully execute the command, explain why and include 'status code: 400' in your response",
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

      if ($status === 200) {

        // Echo the success response outside the foreach loop
        $response = ['success' => true, 'message' => 'Assessment Content Retrieved', 'response' => 'success', 'content' => $rinda_response, 'id' => $assessment_id];
        echo json_encode($response);
      } else {
        // Output an error response if the status code is not 200
        $response = ['success' => false, 'response' => 'error', 'content' => $assistantContent,  'message' => 'Failed to retrieve content. Status code: ' . $status];
        echo json_encode($response);
      }

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