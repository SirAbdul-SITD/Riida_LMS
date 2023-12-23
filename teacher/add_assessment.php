<?php
// Assuming $pdo is already established
require("../settings.php");

try {
  // Check if the form is submitted
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {

     // Extract form data
     $class = isset($_POST['class']) ? $_POST['class'] : null;
     $subject = isset($_POST['subject']) ? $_POST['subject'] : null;
     $subject_id = isset($_POST['subject_id']) ? $_POST['subject_id'] : null;
     $type = isset($_POST['type']) ? $_POST['type'] : null;
     $date = isset($_POST['date']) ? $_POST['date'] : null;
     $time = isset($_POST['time']) ? $_POST['time'] : null;
     $mode = isset($_POST['mode']) ? $_POST['mode'] : null;
     $objective = isset($_POST['objective']) ? $_POST['objective'] : null;
     $essay = isset($_POST['essay']) ? $_POST['essay'] : null;
     $focus = isset($_POST['focus']) ? $_POST['focus'] : null;
     $create_by = isset($_POST['tutor']) ? $_POST['tutor'] : null;
     
    // Extract form data
        $class = $_POST['class'];
        $subject = $_POST['subject'];
        $subject_id = $_POST['subject_id'];
        $type = $_POST['type'];
        $date = $_POST['date'];
        $time = $_POST['time'];
        $mode = $_POST['mode'];
        $objective = $_POST['objective'];
        $essay = $_POST['essay'];
        $focus = $_POST['focus'];
        $create_by = $_POST['tutor'];
        // $create_datetime = date("Y-m-d H:i:s");
        $status = 'Queued';

        if ($objective == '') {
          $objective = 0;
        }
        if ($essay == '') {
          $essay = 0;
        }
        


    $query = "SELECT content FROM topics WHERE subject_id = :subject_id";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':subject_id', $subject_id, PDO::PARAM_INT); // Corrected binding
    $stmt->execute();
    $topic_content = $stmt->fetchAll(PDO::FETCH_ASSOC);


    $content = ''; 

    foreach ($topic_content as $row) {
      // Assuming 'content' is the key in your associative array
      $content .= $row['content'] . "\n"; // Add a newline after each content
  }


     $userMessage = "generate " . $objective . " objective questions and " . $essay . " essay questions from this content:'" . $content . "' using these instructions: '" . $focus . "'. return response in json in this format: 
      {
        'ObjectiveQuestions': [
          {'Question': '', 'Options': ['', '', '', '']},
        ],
        'ObjectiveAnswers': [
          {'Answers': ['', '', '']},
        ]
        'EssayQuestions': [
          {'Question': ''},
        ]
      }
      ";



      
  //  "merge this. to fit into this content: properly";

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


      $stmt = $pdo->prepare("INSERT INTO assessments 
      (class, subject_id, subject, type, date, time, mode, objectives, essay, focus, create_by, questions, status) VALUES
       (:class, :subject_id, :subject, :type, :date, :time, :mode, :objectives, :essay, :focus, :create_by, :questions, :status)");
      $stmt->bindParam(':class', $class, PDO::PARAM_STR);
      $stmt->bindParam(':subject_id', $subject_id, PDO::PARAM_INT);
      $stmt->bindParam(':subject', $subject, PDO::PARAM_STR);
      $stmt->bindParam(':type', $type, PDO::PARAM_STR);
      $stmt->bindParam(':questions', $assistantContent, PDO::PARAM_STR);
      $stmt->bindParam(':date', $date, PDO::PARAM_STR);
      $stmt->bindParam(':time', $time, PDO::PARAM_STR);
      $stmt->bindParam(':mode', $mode, PDO::PARAM_STR);
      $stmt->bindParam(':objectives', $objective, PDO::PARAM_STR);
      $stmt->bindParam(':essay', $essay, PDO::PARAM_STR);
      $stmt->bindParam(':focus', $focus, PDO::PARAM_STR);
      $stmt->bindParam(':create_by', $create_by, PDO::PARAM_STR);
      $stmt->bindParam(':status', $status, PDO::PARAM_STR);
      // $stmt->bindParam(':create_datetime', $create_datetime, PDO::PARAM_STR);

      // Execute the statement and get the last inserted ID
      $stmt->execute();
 

    }

    // Close the cURL session outside of the else block
    curl_close($ch);
    // Echo the success response outside the foreach loop
    $response = ['success' => true, 'response' => 'success', 'message' => 'Assessments questions generated successfully', 'content' => $assistantContent];
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





