<?php
include 'db.php';

if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit();
}

$id = $_GET['id'];

// Fetch the student data
$result = mysqli_query($conn, "SELECT * FROM clients_db WHERE id = $id");
$student = mysqli_fetch_assoc($result);

if (!$student) {
    header("Location: index.php");
    exit();
}

$success = "";
$error = "";

// Update data when form is submitted
if (isset($_POST['update'])) {
    $firstname = $_POST['firstname'];
    $lastname  = $_POST['lastname'];
    $email     = $_POST['email'];

    // Check empty fields
    if (empty($firstname) || empty($lastname) || empty($email)) {
        $error = "Please fill in all fields!";
    } else {
        // Check if email already exists, excluding current student
        $check = mysqli_query($conn, "SELECT * FROM clients_db WHERE email='$email' AND id!=$id");
        if (mysqli_num_rows($check) > 0) {
            $error = "Email already exists!";
        } else {
            $update = mysqli_query($conn, "UPDATE clients_db SET firstname='$firstname', lastname='$lastname', email='$email' WHERE id=$id");
            if ($update) {
                $success = "Student updated successfully!";
                // Refresh the page to show updated data
                $result = mysqli_query($conn, "SELECT * FROM clients_db WHERE id = $id");
                $student = mysqli_fetch_assoc($result);
                header("Location: index.php");
                exit();
            } else {
                $error = "Failed to update student!";
            }
        }
    }
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Student</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body>
<?php include 'nav.php'; ?>

<div class="container" style="margin-top: 120px; max-width: 600px;">
    <div class="card shadow-sm border-0">
        <div class="card-header bg-dark text-white text-center">
            <h4><i class="bi bi-pencil-square"></i> Edit Student</h4>
        </div>
        <div class="card-body">
            
            <!-- Bootstrap Alerts -->
            <?php if (!empty($error)) : ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <?php echo $error; ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>

            <?php if (!empty($success)) : ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <?php echo $success; ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>

            <!-- Edit Form -->
            <form method="POST">
                <div class="mb-3">
                    <label class="form-label">Firstname</label>
                    <input type="text" name="firstname" class="form-control" value="<?php echo htmlspecialchars($student['firstname']); ?>" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Lastname</label>
                    <input type="text" name="lastname" class="form-control" value="<?php echo htmlspecialchars($student['lastname']); ?>" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" value="<?php echo htmlspecialchars($student['email']); ?>" required>
                </div>
                <div class="d-flex justify-content-between">
                    <a href="index.php" class="btn btn-secondary">
                        <i class="bi bi-arrow-left-circle"></i> Back
                    </a>
                    <button type="submit" name="update" class="btn btn-success">
                        <i class="bi bi-save"></i> Update
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include 'footer.html'; ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>