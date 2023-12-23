<?php
require("../settings.php");

$id = 1;

// Query to retrieve subtopics data
$query = "SELECT subtopics FROM topics WHERE id = :id";
$stmt = $pdo->prepare($query);
$stmt->bindParam(':id', $id, PDO::PARAM_INT);
$stmt->execute();

// Fetch the result
$result = $stmt->fetch(PDO::FETCH_ASSOC);

if ($result) {
  // JSON data is stored in the 'subtopics' column
  $subtopicsJSON = $result['subtopics'];

  // Output JSON response
  header('Content-Type: application/json');
  echo $subtopicsJSON;
} else {
  // Output an error message
  header('Content-Type: application/json');
  echo json_encode(['error' => 'No data found for the specified ID.']);
}

// if ($result) {
//     // JSON data is stored in the 'subtopics' column
//     $subtopicsJSON = $result['subtopics'];

//     // Decode JSON data
//     $subtopicsArray = json_decode($subtopicsJSON, true);

//     // Output the subtopics data
//     echo '<pre>';
//     print_r($subtopicsArray);
//     echo '</pre>';
// } else {
//     echo "No data found for the specified ID.";
// }
?>
