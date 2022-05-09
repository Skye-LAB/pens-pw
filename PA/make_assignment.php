<?php
session_start();
require 'functions.php';

if (isset($_POST["make_assignment"])) {
  if (make_assignment($_GET["class_id"], $_POST) > 0) {
    echo "<script>
              alert('Assignment was made');
              document.location.href = 'my_classes.php'
            </script>";
  } else {
    echo "<script>
              alert('Assignment was not made successfully');
              document.location.href = 'my_classes.php'
            </script>";
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap icons -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.6.0/font/bootstrap-icons.css">
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

  <!-- My CSS -->
  <link rel="stylesheet" href="assets/css/mine.css">

  <title>Home | Class Corner</title>
</head>

<body class="container py-4">
  <!-- nav -->
  <?php include "./partials/header.php" ?>

  <div class="d-flex justify-content-center py-2">
    <h4>Create Assignment</h4>
  </div>

  <main>
    <form action="" method="post">
      <div class="mb-3">
        <label for="title" class="form-label">Title: </label>
        <input class="form-control" type="text" id="title" name="title"/>
      </div>

      <span>Description: </span>
      <div class="input-group">
        <textarea class="form-control" rows="6" name="description"></textarea>
      </div>

      <div class="d-flex align-items-center justify-content-end my-4">
        <button type="submit" name="make_assignment" class="btn btn-primary ms-4">Post</button>
      </div>
    </form>
  </main>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>
