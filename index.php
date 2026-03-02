<<<<<<< HEAD
<?php
session_start();
include "db.php";
if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit();
}

$sql = "SELECT * FROM students ORDER BY id DESC";
$result = $conn->query($sql);
=======

<?php
include "db.php";

if(isset($_POST['add'])){

    $id     = $_POST['id'];
    $name   = $_POST['name'];
    $email  = $_POST['email'];
    $course = $_POST['course'];

    $add= $conn->prepare("INSERT INTO students (id, name, email, course) VALUES (?, ?, ?, ?)");
    }
>>>>>>> ea37ff5cf8619eb3b321777cd28589af5f7a24d5
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
<<<<<<< HEAD
    <link rel="stylesheet" href="style.css">

=======
      <h2>Student Record</h2>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
>>>>>>> ea37ff5cf8619eb3b321777cd28589af5f7a24d5
</head>
<body>
    <h2>Student Record</h2>

<<<<<<< HEAD
    <table border="1" cellpadding="10">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Course</th>
            <th>Action</th>
        </tr>
        <?php if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) { ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo htmlspecialchars($row['name']); ?></td>
                    <td><?php echo htmlspecialchars($row['email']); ?></td>
                    <td><?php echo htmlspecialchars($row['course']); ?></td>
                    <td>
                        <a href="edit.php?id=<?php echo $row['id']; ?>">Edit</a> |
                        <a href="delete.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure you want to delete?');">Delete</a>
                    </td>
                </tr>
        <?php }
        } else {
            echo "<tr><td colspan='5'>No records found</td></tr>";
        } ?>
    </table>

    <br>
    <a href="add.php">Add Student</a> |
    <a href="logout.php">Logout</a>
</body>
</html>
<?php $conn->close(); ?>
=======
<form method="POST">
    <label>ID Number</label><br>
    <input type="number" name="id" required><br><br>

    <label>Name</label><br>
    <input type="text" name="name" required><br><br>

    <label>Email</label><br>
    <input type="email" name="email" required><br><br>

    <label>Course</label><br>
    <input type="text" name="course" required><br><br>

    <button type="submit" name="add">Add Student →</button>

</form>

<br>
<a href="student_records.php">View Records</a>

</body>
</html>
>>>>>>> ea37ff5cf8619eb3b321777cd28589af5f7a24d5
