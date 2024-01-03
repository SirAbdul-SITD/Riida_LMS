<?php
require("settings.php");

if (isset($_POST['email'])) {
  $email = $_POST['email'];
  $first_name = $_POST['first_name'];
  $last_name = $_POST['last_name'];

  if (isset($_POST['class_id'])) {
    $class_id = $_POST['class_id'];

    // Add class details
    $insertQuery = "INSERT INTO `teachers` (`first_name`, `last_name`, `email`) VALUES (:first_name, :last_name, :email)";
    $insertQ = $pdo->prepare($insertQuery);
    $insertQ->bindParam(':first_name', $first_name, PDO::PARAM_STR);
    $insertQ->bindParam(':last_name', $last_name, PDO::PARAM_STR);
    $insertQ->bindParam(':email', $email, PDO::PARAM_STR);
    $insertQ->execute();


    $lastInsertedId = $pdo->lastInsertId();
    // Fetch the updated classes_no
    $query = "SELECT `classes_no` FROM `teachers` WHERE `id` = :lastInsertedId";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':lastInsertedId', $lastInsertedId, PDO::PARAM_INT);
    $stmt->execute();
    $classes_numbers = $stmt->fetchColumn();

    $add_one = 1;

    $updateBalanceQuery = "UPDATE teachers SET classes_no = :classes_numbers + :add_one WHERE id = :class_id";
    $updateBalanceStmt = $pdo->prepare($updateBalanceQuery);
    $updateBalanceStmt->bindParam(':class_id', $class_id, PDO::PARAM_INT);
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