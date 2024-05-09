<?php

require_once 'dbconfig.php';


$id = $_POST['id'];
$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$gender = $_POST['gender'];


if (!is_numeric($id) || empty($firstname) || empty($lastname) || empty($gender)) {
    header("location: ../index.php?");
    exit;
}


$stmt = $conn->prepare('UPDATE users SET first_name = :firstname, last_name = :lastname, gender = :gender WHERE id = :id');
$stmt->bindParam(':id', $id);
$stmt->bindParam(':firstname', $firstname);
$stmt->bindParam(':lastname', $lastname);
$stmt->bindParam(':gender', $gender);
$stmt->execute();


header("location: ../index.php?");
exit;