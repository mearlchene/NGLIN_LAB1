<?php
include "db.php";

$id = $_GET['id'] ?? null;

$get = mysqli_query($conn, "SELECT * FROM students WHERE id = $id");
$student = mysqli_fetch_assoc($get);

$message = "";

if (isset($_POST['update'])) {
    $name   = $_POST['name'];
    $email  = $_POST['email'];
    $course = $_POST['course'];

    if ($name == "" || $email == "") {
        $message = "Name and Email are required!";
    } else {
        $sql = "UPDATE students 
                SET name='$name', email='$email', course='$course'
                WHERE id=$id";
        if (mysqli_query($conn, $sql)) {
            header("Location: student_records.php");
            exit;
        }
    }
}
?>

<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Edit Student</title>
</head>
<body>

<h2>Edit Students Records</h2>

<form method="post">
    <label>Name</label><br>
    <input type="text" name="name" value="<?php echo ($student['name']); ?>"><br><br>

    <label>Email</label><br>
    <input type="email" name="email" value="<?php echo ($student['email']); ?>"><br><br>

    <label>Course</label><br>
    <input type="text" name="course" value="<?php echo ($student['course']); ?>"><br><br>

    <button type="submit" name="update">Update</button>
</form>

<br>
<a href="student_records.php">Back</a>

</body>
</html>