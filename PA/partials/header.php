<?php
# login
if (isset($_POST["login"])) {
  login($_POST);
}

# register
if (isset($_POST["register"])) {
  if (register($_POST) > 0) {
    echo "<script>
      alert('User was created successfully!');
      document.location.href = 'index.php'
    </script>";
  } else {
    echo "<script>
      alert('User was not created successfully!');
      document.location.href = 'index.php'
    </script>";
  }
}

?>

<header>
  <nav class="pb-2 mb-4 border-bottom navbar navbar-expand-lg navbar-light">
    <a href="/" class="d-flex align-items-center text-dark text-decoration-none">
      <span class="fs-4">Class Corner</span>
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
      <ul class="navbar-nav mb-2 mx-auto mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" href="/">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="./classes.php">Classes</a>
        </li>
      </ul>
      <?php if (!$_SESSION["login"]) : ?>
        <ul class="navbar-nav mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link" href="#loginModal" data-bs-toggle="modal">Log In</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#registerModal" data-bs-toggle="modal">Sign Up</a>
          </li>
        </ul>
      <?php else : ?>
        <ul class="navbar-nav mb-2 mb-lg-0">
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              <img src="https://dummyimage.com/200x200/9c939c/fff" width="30" class="rounded-circle" />
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
              <li><a class="dropdown-item" href="#">Profile</a></li>
              <li><a class="dropdown-item" href="my_classes.php">My Classes</a></li>
              <?php if ($_SESSION['role'] == 1) : ?>
                <li><a class="dropdown-item" href="make_class.php">Create a Class</a></li>
              <?php else : ?>
                <li>
                  <a class="dropdown-item" href="#joinModal" data-bs-toggle="modal">Join a Class</a>
                </li>
              <?php endif ?>
              <li>
                <hr class="dropdown-divider" />
              </li>
              <li>
                <a class="dropdown-item text-danger" href="logout.php">Logout</a>
              </li>
            </ul>
          </li>
        </ul>
      <?php endif ?>
    </div>
  </nav>
</header>

<!-- modal -->
<!-- login -->
<?php include "./partials/login_modal.php" ?>

<!-- register -->
<?php include "./partials/register_modal.php" ?>

<!-- join -->
<?php include "./partials/join_modal.php" ?>
