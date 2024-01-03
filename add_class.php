<?php
require("settings.php");

if (isset($_POST['new_class'])) {
  $new_class = $_POST['new_class'];

  if (isset($_POST['teacher_id'])) {
    $teacher_id = $_POST['teacher_id'];

    // Fetch teacher's details
    $query = "SELECT * FROM `teachers` WHERE `id` = :teacher_id";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':teacher_id', $teacher_id, PDO::PARAM_INT);
    $stmt->execute();
    $teachers_details = $stmt->fetch(PDO::FETCH_ASSOC); // Use fetch instead of fetchAll

    // Add class details
    $insertQuery = "INSERT INTO `classes` (`class`, `teacher_id`) VALUES (:class, :teacher_id)";
    $insertQ = $pdo->prepare($insertQuery);
    $insertQ->bindParam(':class', $new_class, PDO::PARAM_STR);
    $insertQ->bindParam(':teacher_id', $teacher_id, PDO::PARAM_INT);
    $insertQ->execute();

    // Fetch the updated classes_no
    $query = "SELECT `classes_no` FROM `teachers` WHERE `id` = :teacher_id";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':teacher_id', $teacher_id, PDO::PARAM_INT);
    $stmt->execute();
    $classes_numbers = $stmt->fetchColumn();

    $add_one = 1;

    $updateBalanceQuery = "UPDATE teachers SET classes_no = :classes_numbers + :add_one WHERE id = :teacher_id";
    $updateBalanceStmt = $pdo->prepare($updateBalanceQuery);
    $updateBalanceStmt->bindParam(':teacher_id', $teacher_id, PDO::PARAM_INT);
    $updateBalanceStmt->bindParam(':classes_numbers', $classes_numbers, PDO::PARAM_INT);
    $updateBalanceStmt->bindParam(':add_one', $add_one, PDO::PARAM_INT);
    $updateBalanceStmt->execute();

    // Respond with a success message
    $response = ['success' => true, 'response' => 'success', 'message' => 'New `Class: ' . $new_class . ' added successfully'];
    echo json_encode($response);
    exit();
  } else {
    // Add class details
    $insertQuery = "INSERT INTO `classes` (`class`) VALUES (:class)";
    $insertQ = $pdo->prepare($insertQuery);
    $insertQ->bindParam(':class', $new_class, PDO::PARAM_STR);
    $insertQ->execute();


    $response = ['success' => true, 'response' => 'success', 'message' => 'New `Class: ' . $new_class . ' added successfully'];
    echo json_encode($response);
    exit();
  }


}

?>