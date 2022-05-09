<div class="modal fade" id="registerModal" tabindex="-1" aria-labelledby="registerModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="registerModalLabel">Sign Up</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="" method="post">
        <div class="modal-body">
          <div class="container">
            <div class="input-group mb-3">
              <span class="input-group-text">
                <i class="bi bi-file-person-fill"></i>
              </span>
              <input type="text" id="name" name="name" class="form-control" placeholder="Name" />
            </div>
            <div class="input-group mb-3">
              <span class="input-group-text">
                <i class="bi bi-envelope-fill"></i>
              </span>
              <input type="email" id="email" name="email" class="form-control" placeholder="Email" />
            </div>
            <div class="input-group mb-3">
              <span class="input-group-text"><i class="bi bi-lock-fill"></i></span>
              <input type="password" id="password" name="password" class="form-control" placeholder="Password" />
              <span class="input-group-text"><i class="bi bi-eye-fill"></i></span>
            </div>
            <span>Sign Up as a: </span>
            <select class="form-select" name="role">
              <option value="1">Teacher</option>
              <option value="2">Student</option>
            </select>
            <div class="mt-4">
              <span>
                Already have an account?
                <a href="#loginModal" data-bs-toggle="modal">Sign In</a>
              </span>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <a href="#" class="text-decoration-none text-secondary" data-bs-dismiss="modal">Close</a>
          <button type="submit" name="register" class="btn btn-outline-primary">Sign Up</button>
        </div>
      </form>
    </div>
  </div>
</div>
