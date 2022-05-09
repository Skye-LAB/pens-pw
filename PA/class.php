<?php
session_start();
require 'functions.php';

if (!isset($_SESSION["login"])) {
  header("Location: index.php");
  exit;
}

# get class name
$id = $_GET['id'];
$class_info = query("SELECT * FROM class WHERE id = $id")[0];

# get assignments
$assignments = query("CALL show_all_assignments($id)");
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

  <div class="p-5 mb-2 bg-light rounded-3 jumbotron" style="background-size: cover;">
    <div class="container-fluid py-5">
      <h1 class="display-5 fw-bold"><?= $class_info['name'] ?></h1>
    </div>
  </div>
  <?php if ($_SESSION["role"] == 1) : ?>
    <div class="d-grid gap-2 pb-2">
      <a class="btn btn-primary" href="make_assignment.php?class_id=<?= $id ?>">Create Assignment</a>
    </div>
  <?php endif ?>
  <?php foreach ($assignments as $assignment) : ?>
    <div class="card text-dark bg-light mb-3">
      <div class="card-header d-flex justify-content-between">
        <div>
          Assignment
        </div>
        <div>
          <?php if ($_SESSION["role"] == 1) : ?>
            <a href="assignments.php?class_id=<?= $assignment['class_id'] ?>&assignment_id=<?= $assignment['assignment_id'] ?>">Learn more</a>
          <?php else :  ?>
            <a href="assignment.php?class_id=<?= $assignment['class_id'] ?>&assignment_id=<?= $assignment['assignment_id'] ?>">Learn more</a>
          <?php endif ?>
        </div>
      </div>
      <div class="card-body">
        <h5 class="card-title"><?= $assignment["assignment_title"] ?></h5>
        <p class="card-text"><?= $assignment["assignment_description"] ?></p>
      </div>
    </div>
  <?php endforeach ?>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>
