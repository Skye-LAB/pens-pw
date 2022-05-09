<?php
# join class
if (isset($_POST["join"])) {
  if (join_class($_POST) > 0) {
    echo "<script>
      alert('Class was joined successfully');
      document.location.href = 'index.php'
    </script>";
  } else {
    echo "<script>
      alert('Class was not joined successfully');
      document.location.href = 'index.php'
    </script>";
  }
}
?>

<div class="modal fade" id="joinModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Join Class</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="" method="post">
        <div class="modal-body">
          <label for="class_id" class="form-label">Class ID</label>
          <div class="input-group mb-3">
            <input type="text" class="form-control" name="class_id" id="class_id">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" name="join" class="btn btn-primary">Submit</button>
        </div>
      </form>
    </div>
  </div>
</div>
