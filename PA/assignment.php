<?php
session_start();
require 'functions.php';

$assignment_id = $_GET['assignment_id'];
$class_id = $_GET['class_id'];

$assignment = query("SELECT * FROM assignments WHERE id = $assignment_id AND class_id = $class_id")[0];

$user = $_SESSION["user"]["id"];
$note = query("SELECT note FROM student_assignments WHERE assignment_id = $assignment_id AND student_id = $user")[0];

if (isset($_POST["send_assignment"])) {
  $data["user"] =  $user;
  $data["assignment"] = $assignment_id;
  $data["assignment_note"] = $_POST["note"];

  if (!$note) {
    if (send_assignment($data) > 0) {
      echo "<script>
              alert('Assignment was sended');
              document.location.href = 'my_classes.php'
            </script>";
    } else {
      echo "<script>
              alert('Assignment was not sended successfully');
              document.location.href = 'my_classes.php'
            </script>";
    }
  } else {
    if (update_assignment($data) > 0) {
      echo "<script>
              alert('Assignment note was updated');
              document.location.href = 'my_classes.php'
            </script>";
    } else {
      echo "<script>
            alert('Assignment note was not updated successfully');
            document.location.href = 'my_classes.php'
          </script>";
    }
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

  <div class="row g-5 p-4">
    <div class="col-md-5 col-lg-4 order-md-last">
      <ul class="list-group mb-3">
        <form action="" method="post">
          <li class="list-group-item d-flex justify-content-between lh-sm">
            <div>
              <h4 class="mb-3 mt-2">Your Assignment</h4>
              <div class="input-group">
                <span class="input-group-text">Note</span>
                <textarea class="form-control" name="note"><?= $note["note"] ?></textarea>
              </div>
            </div>
          </li>
          <li class="list-group-item d-flex justify-content-end lh-sm">
            <div class="d-grid gap-2">
              <button class="btn btn-primary" type="submit" name="send_assignment">Send</button>
            </div>
          </li>
        </form>
      </ul>
    </div>
    <div class="col-md-7 col-lg-8">
      <ul class="list-group mb-3">
        <li class="list-group-item d-flex justify-content-between lh-sm">
          <div>
            <h3 class="mb-3 mt-2"><?= $assignment['title'] ?></h3>
            <p class="text-muted"><?= $assignment['description'] ?></p>
          </div>
        </li>
      </ul>
    </div>
  </div>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>
