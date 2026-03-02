<?php
session_start();
include "db.php";

if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit();
}

$id = isset($_GET['id']) && is_numeric($_GET['id']) ? (int)$_GET['id'] : null;

if (!$id) {
    echo "Invalid ID.";
    exit();
}

$get = $conn->prepare("SELECT * FROM students WHERE id = ?");
$get->bind_param("i", $id);
$get->execute();
$student = $get->get_result()->fetch_assoc();

if (!$student) {
    echo "Student not found.";
    exit();
}

$message = "";

if (isset($_POST['update'])) {
    $id     = (int)$_POST['id'];
    $name   = $_POST['name'];
    $email  = $_POST['email'];
    $course = $_POST['course'];

    if ($name == "" || $email == "") {
        $message = "Name and Email are required!";
    } else {
        $stmt = $conn->prepare("UPDATE students SET name=?, email=?, course=? WHERE id=?");
        $stmt->bind_param("sssi", $name, $email, $course, $id);

        if ($stmt->execute()) {
            header("Location: index.php");
            exit();
        } else {
            $message = "Update failed. Please try again.";
        }
        $stmt->close();
    }
}
?>

<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Edit Student</title>
    <link rel="stylesheet" href="style.css">

</head>
<body>

<h2>Edit Student Record</h2>

<?php if ($message) echo "<p style='color:red;'>$message</p>"; ?>

<form method="post">
    <label>Student ID</label><br>
    <input type="number" name="id" value="<?php echo $student['id']; ?>" readonly><br><br>

    <label>Name</label><br>
    <input type="text" name="name" value="<?php echo htmlspecialchars($student['name']); ?>" required><br><br>

    <label>Email</label><br>
    <input type="email" name="email" value="<?php echo htmlspecialchars($student['email']); ?>" required><br><br>

    <label>Course</label><br>
    <input type="text" name="course" value="<?php echo htmlspecialchars($student['course']); ?>" required><br><br>

    <button type="submit" name="update">Update</button>
</form>

<br>
<a href="index.php">Back</a>

</body>
</html>
<?php $conn->close(); ?>
