<?php
<<<<<<< HEAD
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
=======
include "db.php";

$id = $_GET['id'] ?? null;

$get = mysqli_query($conn, "SELECT * FROM students WHERE id = $id");
$student = mysqli_fetch_assoc($get);
>>>>>>> ea37ff5cf8619eb3b321777cd28589af5f7a24d5

$message = "";

if (isset($_POST['update'])) {
<<<<<<< HEAD
    $id     = (int)$_POST['id'];
=======
>>>>>>> ea37ff5cf8619eb3b321777cd28589af5f7a24d5
    $name   = $_POST['name'];
    $email  = $_POST['email'];
    $course = $_POST['course'];

    if ($name == "" || $email == "") {
        $message = "Name and Email are required!";
    } else {
<<<<<<< HEAD
        $stmt = $conn->prepare("UPDATE students SET name=?, email=?, course=? WHERE id=?");
        $stmt->bind_param("sssi", $name, $email, $course, $id);

        if ($stmt->execute()) {
            header("Location: index.php");
            exit();
        } else {
            $message = "Update failed. Please try again.";
        }
        $stmt->close();
=======
        $sql = "UPDATE students 
                SET name='$name', email='$email', course='$course'
                WHERE id=$id";
        if (mysqli_query($conn, $sql)) {
            header("Location: student_records.php");
            exit;
        }
>>>>>>> ea37ff5cf8619eb3b321777cd28589af5f7a24d5
    }
}
?>

<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Edit Student</title>
<<<<<<< HEAD
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
=======
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
>>>>>>> ea37ff5cf8619eb3b321777cd28589af5f7a24d5

    <button type="submit" name="update">Update</button>
</form>

<br>
<<<<<<< HEAD
<a href="index.php">Back</a>

</body>
</html>
<?php $conn->close(); ?>
=======
<a href="student_records.php">Back</a>

</body>
</html>
>>>>>>> ea37ff5cf8619eb3b321777cd28589af5f7a24d5
