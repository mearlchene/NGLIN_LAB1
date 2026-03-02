
<?php
include "db.php";

if(isset($_POST['add'])){

    $id     = $_POST['id'];
    $name   = $_POST['name'];
    $email  = $_POST['email'];
    $course = $_POST['course'];

    $add= $conn->prepare("INSERT INTO students (id, name, email, course) VALUES (?, ?, ?, ?)");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
      <h2>Student Record</h2>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
</head>
<body>
    <h2>Student Record</h2>

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