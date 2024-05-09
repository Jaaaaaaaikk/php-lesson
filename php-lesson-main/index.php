<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registered Users</title>
    <style>
        table {
            margin-top: 2em;
        }
    </style>
    <?php require ('php/dbconfig.php'); ?>
</head>

<body>
    <h1>Users</h1>
    <a href="registration.php">
        <button>Register New User</button>
    </a>
    <table border="1" width="100%">
        <thead>
            <tr>
                <th>Name</th>
                <th>Gender</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $stmt = $conn->prepare("SELECT id, first_name, last_name, gender FROM users");
            $stmt->execute();
            while ($row = $stmt->fetch()) {
                echo "<tr>";
                echo "<td>" .
                    htmlspecialchars($row["first_name"]) . " " . htmlspecialchars($row["last_name"]) .
                    "</td>";
                echo "<td>" .
                    htmlspecialchars($row["gender"]) .
                    "</td>";
                echo "<td>";
                if (is_numeric($row["id"])) {
                    echo "<a href='php/edit.php?id=" . htmlspecialchars($row["id"]) . "'>Edit</a>";
                    echo "<a href='php/delete.php?id=" . htmlspecialchars($row["id"]) . "' onclick=\"return confirm('Are you sure you want to delete this user?')\">Delete</a>";
                }
                echo "</td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
</body>

</html>