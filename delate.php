<?php
include 'db.php';

if (!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: index.php?msg=invalid");
    exit();
}

$id = $_GET['id'];

// Check if student exists
$result = mysqli_query($conn, "SELECT * FROM clients_db WHERE id = $id");
if (mysqli_num_rows($result) == 0) {
    header("Location: index.php?msg=notfound");
    exit();
}

// Delete the student
$delete = mysqli_query($conn, "DELETE FROM clients_db WHERE id = $id");

if ($delete) {
    header("Location: index.php?msg=deleted");
} else {
    header("Location: index.php?msg=error");
}
exit();
?>