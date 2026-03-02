<?php
session_start();
include 'db.php';

if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $studid = (int)$_POST['id'];
    $name   = $_POST['name'];
    $email  = $_POST['email'];
    $course = $_POST['course'];

    $stmt = $conn->prepare("INSERT INTO students (id, name, email, course) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("isss", $studid, $name, $email, $course);

    if ($stmt->execute()) {
        header("Location: index.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Student</title>
    <link rel="stylesheet" href="style.css">

</head>
<body>
    <h2>Add New Student</h2>
    <form action="add.php" method="POST">
        <p>
            <label>Student ID:</label><br>
            <input type="number" name="id" required>
        </p>
        <p>
            <label>Full Name:</label><br>
            <input type="text" name="name" required>
        </p>
        <p>
            <label>Email Address:</label><br>
            <input type="email" name="email" required>
        </p>
        <p>
            <label>Course:</label><br>
            <input type="text" name="course" required>
        </p>
        <button type="submit">Add Student</button>
        <a href="index.php">Cancel</a>
    </form>
</body>
</html>
<?php $conn->close(); ?>