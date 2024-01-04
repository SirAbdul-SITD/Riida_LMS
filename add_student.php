<?php
require("settings.php");

if (isset($_POST['adm_no'])) {
  $adm_no = $_POST['adm_no'];
  $first_name = $_POST['first_name'];
  $last_name = $_POST['last_name'];

  if (isset($_POST['class_id'])) {
    $class_id = $_POST['class_id'];
    $add_one = 1;

    // Add teacher's details
    $insertQuery = "INSERT INTO `students` (`first_name`, `last_name`, `adm_no`, `class`) VALUES (:first_name, :last_name, :adm_no, :class)";
    $insertQ = $pdo->prepare($insertQuery);
    $insertQ->bindParam(':first_name', $first_name, PDO::PARAM_STR);
    $insertQ->bindParam(':last_name', $last_name, PDO::PARAM_STR);
    $insertQ->bindParam(':adm_no', $adm_no, PDO::PARAM_STR);
    $insertQ->bindParam(':class', $class_id, PDO::PARAM_INT);
    $insertQ->execute();

    $lastInsertedId = $pdo->lastInsertId();

    $updateQuery = "UPDATE classes SET student_no =+ :add_one WHERE id = :class_id";
    $updateStmt = $pdo->prepare($updateQuery);
    $updateStmt->bindParam(':add_one', $add_one, PDO::PARAM_INT);
    $updateStmt->bindParam(':class_id', $class_id, PDO::PARAM_INT);
    $updateStmt->execute();

    // Respond with a success message
    $response = ['success' => true, 'response' => 'success', 'message' => 'New Teacher: ' . $first_name . ' ' . $last_name . ' added and assigned to class successfully'];
    echo json_encode($response);
    exit();
  } else {
    // Add teacher's details
    $insertQuery = "INSERT INTO `students` (`first_name`, `last_name`, `adm_no`) VALUES (:first_name, :last_name, :adm_no)";
    $insertQ = $pdo->prepare($insertQuery);
    $insertQ->bindParam(':first_name', $first_name, PDO::PARAM_STR);
    $insertQ->bindParam(':last_name', $last_name, PDO::PARAM_STR);
    $insertQ->bindParam(':adm_no', $adm_no, PDO::PARAM_STR);
    $insertQ->execute();

    $response = ['success' => true, 'response' => 'success', 'message' => 'New Teacher: ' . $first_name . ' ' . $last_name . ' added successfully'];
    echo json_encode($response);
    exit();
  }
}
?>
