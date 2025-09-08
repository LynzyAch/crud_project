<?php
require_once "db.php";

// Check if there's a search term
if (isset($_GET['search']) && !empty($_GET['search'])) {
    $search = mysqli_real_escape_string($conn, $_GET['search']);
    $query  = "SELECT * FROM clients_db 
               WHERE firstname LIKE '%$search%' 
               OR lastname LIKE '%$search%' 
               OR email LIKE '%$search%'";
} else {
    // Default: fetch all students
    $query  = "SELECT * FROM clients_db";
}

$result = $conn->query($query);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td class='text-center'>" . htmlspecialchars($row['id']) . "</td>";
        echo "<td class='text-center'>" . htmlspecialchars($row['firstname']) . "</td>";
        echo "<td class='text-center'>" . htmlspecialchars($row['lastname']) . "</td>";
        echo "<td class='text-center'>" . htmlspecialchars($row['email']) . "</td>";
        echo "<td class='text-center'>" . htmlspecialchars($row['time']) . "</td>";
        echo "<td class='text-center'>
                <a href='edit.php?id=" . $row['id'] . "' class='btn btn-warning btn-sm me-1'>Edit</a>
                <a href='delate.php?id=" . $row['id'] . "' class='btn btn-danger btn-sm ms-1' onclick=\"return confirm('Are you sure you want to delete this student?');\">Delete</a>
              </td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='6' class='text-center text-danger fw-bold'>No records found</td></tr>";
}

$conn->close();
?>