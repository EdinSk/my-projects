<?php require_once "./php/partials/nav-bar.php"  ?>

<!-- login -->
<div class="div col-6 mx-auto my-5">
  <form action="./php/login.php" method="post">
    <div class="mb-3">
      <label for="Email" class="form-label">Email address:</label>
      <input
        type="email"
        class="form-control"
        id="Email"
        name="inputEmail"
        aria-describedby="emailHelp"
      />
      <div id="emailHelp" class="form-text">
        We'll never share your email with anyone else.
      </div>
    </div>
    <div class="mb-3">
      <label for="Password" class="form-label">Password:</label>
      <input
        type="password"
        class="form-control"
        id="Password"
        name="inputPassword"
      />
    </div>
    <button type="submit" class="btn btn-primary">Login</button>
  </form>
</div>
<!-- login -->
 
<?php require_once "./php/partials/footer.php"  ?>
