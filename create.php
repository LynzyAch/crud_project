<?php
require_once "db.php";

$firstname = $lastname = $email = "";
$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $firstname = trim($_POST["firstname"]);
    $lastname = trim($_POST["lastname"]);
    $email = trim($_POST["email"]);

    
    if (empty($firstname) || empty($lastname) || empty($email)) {
        $error = "All fields are required.";
    } else {

        $firstname = mysqli_real_escape_string($conn, $firstname);
        $lastname = mysqli_real_escape_string($conn, $lastname);
        $email = mysqli_real_escape_string($conn, $email);


        $checkQuery = "SELECT * FROM clients_db WHERE email = '$email' LIMIT 1";
        $checkResult = $conn->query($checkQuery);

        if ($checkResult->num_rows > 0) {
            $error = "Email already exists. Please use a different email.";
        } else {
            
            $query = "INSERT INTO clients_db (firstname, lastname, email, time) 
                      VALUES ('$firstname', '$lastname', '$email', NOW())";

            if ($conn->query($query) === TRUE) {
                
                header("Location: index.php");
                exit();
            } else {
                $error = "Something went wrong. Please try again.";
            }
        }
    }
}

$conn->close();
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Add Student</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<?php include 'nav.php'; ?>

<div class="container" style="margin-top: 120px; max-width: 600px;">
    <div class="card shadow">
        <div class="fw-bold card-header bg-dark text-white text-center">
            Add Student
        </div>
        <div class="card-body">
            <!-- Alert Message -->
            <?php if (!empty($error)) : ?>
                <div class="alert alert-danger text-center" role="alert">
                    <?php echo $error; ?>
                </div>
            <?php endif; ?>

            <!-- Form -->
            <form method="POST" action="">
                <div class="mb-3">
                    <label class="form-label">First Name</label>
                    <input type="text" name="firstname" class="form-control" value="<?php echo htmlspecialchars($firstname); ?>" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Last Name</label>
                    <input type="text" name="lastname" class="form-control" value="<?php echo htmlspecialchars($lastname); ?>" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" value="<?php echo htmlspecialchars($email); ?>" required>
                </div>
                <div class="d-flex justify-content-between">
                    <a href="index.php" class="btn btn-secondary">Back</a>
                    <button type="submit" class="btn btn-success">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php include 'footer.html'; ?>
</body>
</html>