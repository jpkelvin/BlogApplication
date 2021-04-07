<?php include("path.php")?>
<?php include(ROOT_PATH ."/app/controllers/users.php" );
//guestsOnly();?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <!-- Font Awesome -->

  <!-- Custom CSS -->
  <link rel="stylesheet" href="assets/css/style.css">
  <title>Login</title>
</head>
<body style="background-image: url(assets/images/blog.jpg);background-repeat: no-repeat;background-size:100% 100%;">
  <!-- header -->
<?php include(ROOT_PATH ."/app/includes/header.php");?>
  <!-- // header -->

  <div class="auth-content login">
    <form action="login.php" method="post">
      <h3 class="form-title" style="margin-bottom:1rem;">Login</h3>
      <!-- <div class="msg error">
        <li>Username required</li>
      </div> -->
      <?php include(ROOT_PATH ."/app/helpers/formErrors.php");?>
      <div class="label">
        <label>Username</label>
        <input type="text" name="username"value="<?php echo $username; ?>" class="text-input">
      </div>
      <div class="label">
        <label>Password</label>
        <input type="password" name="password"value="<?php echo $password; ?>"  class="text-input">
      </div>
      <div>
        <button type="submit"name="login-btn" class="btn"><strong>Login</strong></button>
      </div>
      <p class="auth-nav">New User? <a href="<?php echo BASE_URL . '/register.php'?>">Sign Up</a></p>
    </form>
  </div>

  <?php include(ROOT_PATH ."/app/includes/footer.php");?>

  <!-- JQuery -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="assets/js/script.js"></script>
</body>
</html>
