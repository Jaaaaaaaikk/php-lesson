<?php

require_once 'dbconfig.php';


$id = $_GET['id'];


if (!is_numeric($id)) {
    header("location: ../index.php?");
    exit;
}

$stmt = $conn->prepare('DELETE FROM users WHERE id = :id'); // Assuming the column name is 'id'
$stmt->bindParam(':id', $id);
$stmt->execute();

header("location: ../index.php?");
exit;