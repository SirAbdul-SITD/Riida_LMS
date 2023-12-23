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

        // Assuming 'subtopics' is the key in your associative array
        $subtopicData = json_decode($sub_topics['subtopics'], true);

        // Return the subtopics data as JSON
        header('Content-Type: application/json');
        echo json_encode($subtopicData);

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
