<?php
include "db.php";

$id = $_GET['id'] ?? '';
if ($id === '' || !is_numeric($id)) {
    header("Location: student_records.php");
    exit();
}

$row = null;
$errors = [];
$message = '';

$stmt = $conn->prepare("SELECT id, id_number, name, email, course FROM students WHERE id = ?");
if ($stmt) {
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $stmt->close();
}

if (!$row) {
    header("Location: student_records.php");
    exit();
}

$id_number = $row['id_number'];
$name = $row['name'];
$email = $row['email'];
$course = $row['course'];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update'])) {
    $id_number = trim($_POST['id_number'] ?? '');
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $course = trim($_POST['course'] ?? '');

    if ($id_number === '') { $errors[] = 'ID number is required.'; }
    if ($name === '') { $errors[] = 'Name is required.'; }
    if ($email === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) { $errors[] = 'Valid email is required.'; }
    if ($course === '') { $errors[] = 'Course is required.'; }

    if (empty($errors)) {
        $stmt = $conn->prepare("UPDATE students SET id_number = ?, name = ?, email = ?, course = ? WHERE id = ?");
        if ($stmt) {
            $stmt->bind_param("ssssi", $id_number, $name, $email, $course, $id);
            if ($stmt->execute()) {
                $message = 'Student updated successfully.';
            } else {
                $errors[] = 'Database error: ' . $stmt->error;
            }
            $stmt->close();
        } else {
            $errors[] = 'Prepare failed: ' . $conn->error;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Student</title>
</head>
<body>

<h2>Edit Student</h2>

<?php if ($message): ?>
    <p><?php echo htmlspecialchars($message); ?></p>
<?php endif; ?>

<?php if (!empty($errors)): ?>
    <ul>
        <?php foreach ($errors as $e): ?>
            <li><?php echo htmlspecialchars($e); ?></li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>

<form method="POST">
    <label>ID Number</label>
    <input type="text" name="id_number" value="<?php echo htmlspecialchars($id_number); ?>" required>

    <label>Name</label>
    <input type="text" name="name" value="<?php echo htmlspecialchars($name); ?>" required>

    <label>Email</label>
    <input type="email" name="email" value="<?php echo htmlspecialchars($email); ?>" required>

    <label>Course</label>
    <input type="text" name="course" value="<?php echo htmlspecialchars($course); ?>" required>

    <button type="submit" name="update">Update Student</button>
</form>

<a href="student_records.php">Back to Records</a>

</body>
</html>
