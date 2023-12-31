<?php
require("settings.php");

if (isset($_POST['email'])) {
  $email = $_POST['email'];
  $first_name = $_POST['first_name'];
  $last_name = $_POST['last_name'];

  if (isset($_POST['class_id'])) {
    $class_id = $_POST['class_id'];
    $add_one = 1;

    // Add teacher's details
    $insertQuery = "INSERT INTO `teachers` (`first_name`, `last_name`, `email`, `classes_no`) VALUES (:first_name, :last_name, :email, :classes_no)";
    $insertQ = $pdo->prepare($insertQuery);
    $insertQ->bindParam(':first_name', $first_name, PDO::PARAM_STR);
    $insertQ->bindParam(':last_name', $last_name, PDO::PARAM_STR);
    $insertQ->bindParam(':email', $email, PDO::PARAM_STR);
    $insertQ->bindParam(':classes_no', $add_one, PDO::PARAM_INT);
    $insertQ->execute();

    $lastInsertedId = $pdo->lastInsertId();

    $updateQuery = "UPDATE classes SET teacher_id = :lastInsertedId WHERE id = :class_id";
    $updateStmt = $pdo->prepare($updateQuery);
    $updateStmt->bindParam(':lastInsertedId', $lastInsertedId, PDO::PARAM_INT);
    $updateStmt->bindParam(':class_id', $class_id, PDO::PARAM_INT);
    $updateStmt->execute();

    // Respond with a success message
    $response = ['success' => true, 'response' => 'success', 'message' => 'New Teacher: ' . $first_name . ' ' . $last_name . ' added and assigned to class successfully'];
    echo json_encode($response);
    exit();
  } else {
    // Add teacher's details
    $insertQuery = "INSERT INTO `teachers` (`first_name`, `last_name`, `email`) VALUES (:first_name, :last_name, :email)";
    $insertQ = $pdo->prepare($insertQuery);
    $insertQ->bindParam(':first_name', $first_name, PDO::PARAM_STR);
    $insertQ->bindParam(':last_name', $last_name, PDO::PARAM_STR);
    $insertQ->bindParam(':email', $email, PDO::PARAM_STR);
    $insertQ->execute();

    $response = ['success' => true, 'response' => 'success', 'message' => 'New Teacher: ' . $first_name . ' ' . $last_name . ' added successfully'];
    echo json_encode($response);
    exit();
  }
}
?>
