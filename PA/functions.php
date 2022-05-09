<?php

$conn = mysqli_connect("localhost", "skye", "nevergone", "class-corner");

function query($query)
{
  global $conn;
  $result = mysqli_query($conn, $query);

  $rows = [];
  while ($row = mysqli_fetch_assoc($result)) {
    $rows[] = $row;
  }

  return $rows;
}

function login($data)
{
  global $conn;
  $email = $data["email"];
  $password = $data["password"];
  $role = $data["role"];

  if ($role == "1") {
    $cek_email = mysqli_query($conn, "SELECT * FROM teachers WHERE email = '$email'");
    $_SESSION["role"] = 1;
  } else {
    $cek_email = mysqli_query($conn, "SELECT * FROM students WHERE email = '$email'");
    $_SESSION["role"] = 2;
  }

  if (mysqli_num_rows($cek_email) == 1) {
    $user = mysqli_fetch_assoc($cek_email);
    if (password_verify($password, $user['password'])) {
      $_SESSION["login"] = true;
      $_SESSION["user"] = $user;

      header("Location: index.php");
      exit;
    }
  }

  $error = true;

  if ($error) {
    echo "<script>
            alert('Invalid email or password, or maybe role')
          </script>";
  }
}

function register($data)
{
  global $conn;

  # get data
  $name = strtolower(stripslashes($data["name"]));
  $email = $data["email"];
  $password = mysqli_real_escape_string($conn, $data["password"]);
  $role = $data["role"];

  if ($role == "1") {
    $get_email = mysqli_query($conn, "SELECT email from teachers where email = '$email'");
  } else {
    $get_email = mysqli_query($conn, "SELECT email from students where email = '$email'");
  }

  if (mysqli_fetch_assoc($get_email) > 0) {
    echo "<script>
            alert('email already exists')
          </script>";
    return false;
  }

  # hash the password
  $password = password_hash($password, PASSWORD_DEFAULT);

  # insert to database
  if ($role == "1") {
    mysqli_query($conn, "INSERT INTO teachers (name, email, password) VALUES ('$name', '$email', '$password')");
  } else {
    mysqli_query($conn, "INSERT INTO students (name, email, password) VALUES ('$name', '$email', '$password')");
  }

  return mysqli_affected_rows($conn);
}

function search($keyword)
{
  $query = "SELECT * FROM show_all_classes WHERE
            class_name LIKE '%$keyword%' OR
            class_description LIKE '%$keyword%' OR
            teacher_name LIKE '%$keyword%'
            ";

  return query($query);
}

function join_class($data)
{
  global $conn;

  $user = $_SESSION["user"]["id"];
  $class = $data["class_id"];

  $cek_class = mysqli_query($conn, "SELECT * FROM student_classes 
                                    WHERE student_id = $user AND class_id = $class");

  if (mysqli_num_rows($cek_class) == 1) {
    echo "<script>
      alert('Class already joined');
    </script>";

    return false;
  }

  mysqli_query($conn, "INSERT INTO student_classes (student_id, class_id) 
                      VALUES ($user, $class)");

  return mysqli_affected_rows($conn);
}

function send_assignment($data)
{
  global $conn;

  $user = $data["user"];
  $assignment = $data["assignment"];
  $note = $data['assignment_note'];

  mysqli_query($conn, "INSERT INTO student_assignments (student_id, assignment_id, note)
                      VALUES ($user, $assignment, '$note')");

  return mysqli_affected_rows($conn);
}

function update_assignment($data)
{
  global $conn;

  $user = $data["user"];
  $assignment = $data["assignment"];
  $note = $data['assignment_note'];

  mysqli_query($conn, "UPDATE student_assignments
                      SET note = '$note'
                      WHERE student_id = $user AND assignment_id = $assignment");

  return mysqli_affected_rows($conn);
}

function make_class($id, $data)
{
  global $conn;

  $user = $id;
  $title = $data["title"];
  $description = $data['description'];
  $date = date("Y-m-d H:i:s");

  mysqli_query($conn, "INSERT INTO class (name, decription, teacher_id, created_at)
                      VALUES ('$title', '$description', $user, '$date')");

  return mysqli_affected_rows($conn);
}

function make_assignment($id, $data)
{
  global $conn;

  $class_id = $id;
  $title = $data["title"];
  $description = $data['description'];

  mysqli_query($conn, "INSERT INTO assignments (title, description, class_id)
                      VALUES ('$title', '$description', $class_id)");

  return mysqli_affected_rows($conn);
}
