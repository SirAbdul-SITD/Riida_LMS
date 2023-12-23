<?php
// Assuming $pdo is already established
require("../settings.php");

try {
  // Check if the form is submitted
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['topic_id'])) {

      // Extract form data
      $topic_id = $_POST['topic_id'];

      $query = "SELECT content FROM topics WHERE id = :topic_id";
      $stmt = $pdo->prepare($query);
      $stmt->bindParam(':topic_id', $topic_id, PDO::PARAM_INT); // Corrected binding
      $stmt->execute();
      $topic_content = $stmt->fetch(PDO::FETCH_ASSOC);

      $content = $topic_content['content'];

      // Echo the success response outside the foreach loop
      $response = ['success' => true, 'response' => 'success', 'content' => $content, 'id' => $topic_id];
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

      // Convert JSON to associative array
      $data = json_decode($content, true);

      // Function to convert JSON data to plain text
      // Convert JSON data to plain text
      function convertToPlainText($data)
      {
        $output = '';

        foreach ($data['ObjectiveQuestions'] as $question) {
          $output .= "Question: " . $question['Question'] . "\n";
          if (isset($question['Options'])) {
            foreach ($question['Options'] as $optionIndex => $option) {
              $output .= "  " . chr(97 + $optionIndex) . ") $option\n";
            }
          }
          $output .= "\n"; // Add a new line space after each question
        }

        foreach ($data['EssayQuestions'] as $question) {
          $output .= "Question: " . $question['Question'] . "\n";
          $output .= "\n"; // Add a new line space after each question
        }

        return $output;
      }


      // Convert JSON data to plain text
      $plainText = convertToPlainText($data);

      // Output the result
      // echo $plainText;

      // Echo the success response outside the foreach loop
      $response = ['success' => true, 'message' => 'Assessment Content Retrieved', 'response' => 'success', 'content' => $plainText, 'id' => $assessment_id];
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