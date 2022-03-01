<!DOCTYPE html>
<html>
<body>

<?php
class Car {
  public function __construct() {
    $this->model = "VW";
  }
}

$herbie = new Car();

echo $herbie->model;

?>

</body>
</html>
