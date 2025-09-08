<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Students List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body>
    <?php include 'nav.php'; ?>

    <div class="container" style="margin-top: 120px; max-width: 900px;">
        <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap text-center text-md-start">
            <h1 class="mt-2">LIST OF STUDENTS</h1>
            <a href="create.php" class="btn btn-dark mt-2">
                <i class="bi bi-plus-circle"></i> Create / Add
            </a>
        </div>

        <div class="table-responsive shadow-sm rounded">
            <table class="table table-striped table-hover text-center align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Firstname</th>
                        <th>Lastname</th>
                        <th>Email</th>
                        <th>Time</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php include 'fetch.php'; ?>
                </tbody>
            </table>
        </div>
    </div>

    <?php include 'footer.html'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>