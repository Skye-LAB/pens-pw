<?php
session_start();
require 'functions.php';

$assignment_id = $_GET['assignment_id'];
$class_id = $_GET['class_id'];

$assignment = query("SELECT * FROM assignments WHERE id = $assignment_id AND class_id = $class_id")[0];

$completed_assignments = query("CALL show_completed_assignments($assignment_id)");
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

  <ul class="list-group mb-3">
    <li class="list-group-item d-flex justify-content-between lh-sm">
      <div>
        <h3 class="mb-3 mt-2"><?= $assignment["title"] ?></h3>
        <p class="text-muted"><?= $assignment["description"] ?></p>
      </div>
    </li>
    <li class="list-group-item d-flex justify-content-between lh-sm">
      <table class="table table-striped table-hover">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Student Name</th>
            <th scope="col">Student Note</th>
          </tr>
        </thead>
        <tbody>
          <?php $no = 1 ?>
          <?php foreach ($completed_assignments as $row) : ?>
            <tr>
              <td><?= $no ?></td>
              <td><?= $row["student_name"] ?></td>
              <td><?= $row["note"] ?></td>
            </tr>
            <?php $no++ ?>
          <?php endforeach ?>
        </tbody>
      </table>
    </li>
  </ul>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>
