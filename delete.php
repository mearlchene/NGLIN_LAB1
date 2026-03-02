<?php
include "db.php";

if(isset($_GET['id']) && is_numeric($_GET['id'])){

    $id = $_GET['id'];

    $del = $conn->prepare("DELETE FROM students WHERE id = ?");
    $del->bind_param("i", $id);

    if($del->execute()){
        header("Location: student_records.php");
        exit();
    } else {
        echo "Error deleting record.";
    }

    $del->close();
} else {
    echo "Invalid ID.";
}

$conn->close();
?>