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

<h2>Student Records</h2>

<a href="index.php">Add Student</a>
<br><br>

<table border="1" cellpadding="10">
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Email</th>
        <th>Course</th>
        <th>Action</th>
    </tr>

<?php
if($result->num_rows > 0){
    while($row = $result->fetch_assoc()){
?>
    <tr>
        <td><?php echo $row['id']; ?></td>
        <td><?php echo $row['name']; ?></td>
        <td><?php echo $row['email']; ?></td>
        <td><?php echo $row['course']; ?></td>
        <td>
            <a href="edit.php?id=<?php echo $row['id']; ?>">Edit</a> |
            <a href="delete.php?id=<?php echo $row['id']; ?>" 
               onclick="return confirm('Are you sure you want to delete?');">
               Delete
            </a>
        </td>
    </tr>
<?php
    }
}else{
    echo "<tr><td colspan='5'>No records found</td></tr>";
}
?>

</table>

</body>
</html>

<?php $conn->close(); ?>