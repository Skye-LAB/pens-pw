<?php
session_start();
require "functions.php";

# get classes
$classes = query("SELECT * FROM show_all_classes ORDER BY created_at DESC limit 3");

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

  <div class="p-5 mb-4 bg-light rounded-3 jumbotron" style="background-size: cover;">
    <div class="container-fluid py-5">
      <h1 class="display-5 fw-bold">Class Corner</h1>
      <p class="col-md-8 fs-4">Lorem ipsum dolor sit amet, qui minim labore adipisicing minim sint cillum sint
        consectetur cupidatat.</p>
      <button class="btn btn-primary btn-lg" type="button">Sign Up</button>
    </div>
  </div>

  <div class="d-flex justify-content-center py-2">
    <h4>Latest Class</h4>
  </div>

  <main class="row gx-4 gx-lg-5 px-4 justify-content-start">
    <?php foreach ($classes as $class) : ?>
      <div class="col-12 col-sm-12 col-md-6 col-lg-4 mb-5">
        <div class="card text-center">
          <div class="card-header">
            Class#<?= $class["class_id"] ?>
          </div>
          <div class="card-body">
            <h5 class="card-title"><?= $class['class_name'] ?></h5>
            <p class="card-text"><?= $class['class_description'] ?></p>
            <p>Teacher: <?= $class['teacher_name'] ?></p>
          </div>
        </div>
      </div>
    <?php endforeach ?>
  </main>

  <!-- footer -->
  <?php include "./partials/footer.php" ?>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>
