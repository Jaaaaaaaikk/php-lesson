<?php
require_once 'dbconfig.php';

$id = $_GET['id'];

if (!is_numeric($id)) {
    header('Location: index.php?error=Invalid+ID');
    exit;
}

$stmt = $conn->prepare('SELECT * FROM users WHERE id = :id'); // Assuming the column name is 'id'
$stmt->bindParam(':id', $id);
$stmt->execute();

$row = $stmt->fetch();

if (!$row) {
    header('Location: index.php?error=User+not+found');
    exit;
}

?>

<!DOCTYPE html>
<html>

<head>
    <title>Edit User</title>
    <style>
        form {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        label {
            margin-top: 1em;
        }

        input[type="text"],
        select {
            margin-top: 0.5em;
            margin-bottom: 1em;
        }

        input[type="submit"] {
            margin-top: 1em;
        }

        a {
            margin-top: 1em;
        }
    </style>
</head>

<body>
    <h2>Edit User</h2>
    <form method="POST" action="update.php">
        <label>Firstname:</label><input type="text" value="<?php echo htmlspecialchars($row['first_name']); ?>"
            name="firstname">
        <label>Lastname:</label><input type="text" value="<?php echo htmlspecialchars($row['last_name']); ?>"
            name="lastname">
        <label>Gender:</label>
        <label><input type="radio" name="gender" value="Male" <?php if ($row['gender'] == 'Male')
            echo 'checked'; ?>>
            Male</label>
        <label><input type="radio" name="gender" value="Female" <?php if ($row['gender'] == 'Female')
            echo 'checked'; ?>>
            Female</label>
        <label><input type="radio" name="gender" value="Others" <?php if ($row['gender'] == 'Others')
            echo 'checked'; ?>>
            Others</label>
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <input type="submit" name="submit" value="Update">
        <a href="../index.php">Back</a>
    </form>
</body>

</html>