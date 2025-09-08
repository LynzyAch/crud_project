<?php require_once "db.php"; ?>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top shadow-sm">
  <div class="container-fluid px-3">
    <!-- Brand -->
    <a class="navbar-brand fw-bold fs-5" href="index.php">
      <i class="bi bi-mortarboard"></i> Student Info System
    </a>

    <!-- Mobile toggle -->
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent">
      <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Navbar content -->
    <div class="collapse navbar-collapse" id="navbarContent">
      <form class="d-flex ms-auto mt-2 mt-lg-0" method="get" action="index.php">
        <input 
          class="form-control me-2" 
          name="search" 
          style="max-width: 220px;" 
          type="search" 
          placeholder="Search student" 
          aria-label="Search"
          value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>"
        />
        <button class="btn btn-outline-light" type="submit">Search</button>
      </form>
    </div>
  </div>
</nav>