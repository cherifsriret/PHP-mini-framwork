<?php
    $title = "Login Page";
    require('partials/header.php')
?>

<div class="login-container">
    <h2>Login Page</h2>
    <form class="login-form" action="login" method="post">
      <div class="form-group">
        <label for="email">Email:</label>
        <input type="text" id="email" name="email" required>
      </div>
      <div class="form-group">
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
      </div>
      <div class="form-group">
        <button type="submit">Login</button>
      </div>
    </form>

    <?php 
        if (isset($_SESSION['error'])) : 
    ?>
    <div id="alertMessage" class="alert alert-danger" ><?= $_SESSION['error']?></div>
    <?php 
        unset($_SESSION['error']);
        endif; 
    ?>
  </div>


<?php require('partials/footer.php') ?>
