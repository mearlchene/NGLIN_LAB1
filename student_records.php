<?php
include "db.php";
$result = $conn->query("SELECT * FROM students ORDER BY created_at DESC");
?>

<!DOCTYPE html>
<html>
<head>
<title>Student Records</title>
</head>
<body>

<h1>Student Records</h1>

<a href="index.php" class="add-btn">Add Student +</a>

<?php
if($result->num_rows > 0){
    while($row = $result->fetch_assoc()){
?>

<div class="card">
    <h3><?php echo $row['name']; ?></h3>
    <p><?php echo $row['email']; ?></p>
    <p><?php echo $row['id']; ?></p>
    <p><?php echo $row['course']; ?></p>

    <div class="dropdown">
        <button class="menu-btn" onclick="toggleMenu('menu<?php echo $row['id']; ?>')">⋯</button>
        <div id="menu<?php echo $row['id']; ?>" class="dropdown-content">
            <a href="edit.php?id=<?php echo $row['id']; ?>">Edit</a>
            <a href="#" onclick="confirmDelete(<?php echo $row['id']; ?>)">Delete</a>
        </div>
    </div>
</div>

<?php
    }
}else{
    echo "<p>No records found.</p>";
}
?>

</body>
</html>

<?php $conn->close(); ?>