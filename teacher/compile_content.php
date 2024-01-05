<?php
// Assuming $pdo is already established
require("../settings.php");

try {
  // Check if the form is submitted
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Extract form data

    if (isset($_POST['content'])) {
      $id = $_POST['id_div'];
      $content = $_POST['content'];


      $userMessage = "convert this content: '" . $content . "'. to json in this format: 
        {
          'ObjectiveQuestions': [
            {'Question': '', 'Options': ['', '', '', '']},
          ],
          'EssayQuestions': [
            {'Question': ''},
          ]
        }
        ";

      // Your OpenAI API key
      $api_key = "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";

      // Data to send in the POST request
      $data = json_encode([
        'model' => 'gpt-3.5-turbo',
        'messages' => [
          [
            "role" => "system",
            "content" => "You're a class teacher responsible for formatting generated exam questions in json format. If you're able to successfully execute the command, include 'status code: 200' in your response and if for any reason you're unable to successfully execute the command, explain why and include 'status code: 400' in your response",
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
        // Execute the query only if the status code is 200
        $stmtUpdate = $pdo->prepare("UPDATE assessments SET questions = :content WHERE id = :id");
        $stmtUpdate->bindParam(':content', $rinda_response, PDO::PARAM_STR);
        $stmtUpdate->bindParam(':id', $id, PDO::PARAM_INT);
        $stmtUpdate->execute();

        // Echo the success response outside the foreach loop
        $response = ['success' => true, 'response' => 'success', 'content' => $content, 'message' => 'Changes Saved Successfully', 'id' => $id];
        echo json_encode($response);
      } else {
        // // Output an error response if the status code is not 200
        // $response = ['success' => false, 'response' => 'error', 'content' => $rinda_response, 'message' => 'Failed to execute the query. Invalid status code: ' . $status];
        // echo json_encode($response);


          // Execute the query only if the status code is 200
          $stmtUpdate = $pdo->prepare("UPDATE assessments SET questions = :content WHERE id = :id");
          $stmtUpdate->bindParam(':content', $rinda_response, PDO::PARAM_STR);
          $stmtUpdate->bindParam(':id', $id, PDO::PARAM_INT);
          $stmtUpdate->execute();
  
          // Echo the success response outside the foreach loop
          $response = ['success' => true, 'response' => 'success', 'content' => $content, 'message' => 'Changes Saved Successfully', 'id' => $id];
          echo json_encode($response);
      }








    } elseif (isset($_POST['id'])) {
      $date = $_POST['date'];
      $time = $_POST['time'];
      $mode = $_POST['mode'];
      $type = $_POST['type'];
      $id = $_POST['id'];

      $stmtUpdate = $pdo->prepare("UPDATE assessments 
                            SET date = :date,        
                                time = :time,
                                mode = :mode,
                                type = :type
                            WHERE id = :id");

      $stmtUpdate->bindParam(':date', $date, PDO::PARAM_STR);
      $stmtUpdate->bindParam(':time', $time, PDO::PARAM_STR);
      $stmtUpdate->bindParam(':mode', $mode, PDO::PARAM_STR);
      $stmtUpdate->bindParam(':type', $type, PDO::PARAM_STR);

      $stmtUpdate->bindParam(':id', $id, PDO::PARAM_INT);
      $stmtUpdate->execute();


      // Echo the success response outside the foreach loop
      $response = ['success' => true, 'response' => 'success', 'message' => 'Changes Saved Successfully'];
      echo json_encode($response);
    } elseif (isset($_POST['original'])) {
      $lesson_content = $_POST['original'];
      $lesson_content = $_POST['generated_content'];
      $lesson_id = $_POST['lesson_id'];

      $InsertStmt = $pdo->prepare("INSERT INTO `lesson_plan` (`topic_id`, `class`) VALUES (:subject, :class)");

      $InsertStmt->bindParam(':generated_content', $generated_content, PDO::PARAM_STR);
      $InsertStmt->bindParam(':lesson_id', $$lesson_id, PDO::PARAM_INT);
      $InsertStmt->execute();


      // Echo the success response outside the foreach loop
      $response = ['success' => true, 'response' => 'success', 'message' => 'Changes Saved Successfully'];
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