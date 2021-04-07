<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

<nav>
    <div class="logo">
      <a href="<?php echo BASE_URL . '/index.php'?>">
        <h1 class="logo-text"  style="height: 80px;width: 240px;margin-top: 1rem; color:white;"><span>Blogger</span>Kelvin</h1>
      </a>
    </div>
    <label for="btn" class="icon">
      <span class="fa fa-bars"></span>
    </label>
    <input type="checkbox" id="btn">
    <ul>
      <?php if (isset($_SESSION['username'])): ?>
        <li>
        <label for="btn-4"class="show "><strong><i class="fa fa-user" aria-hidden="true" style="margin-right:5px;"></i><?php echo $_SESSION['username']; ?><i class="fa fa-chevron-down"></i></strong></label>
        <a href="#"><i class="fa fa-user" aria-hidden="true" style="margin-right:5px;"></i><strong ><?php echo $_SESSION['username']; ?><i class="fa fa-chevron-down"style="margin-left:5px;"></i></strong></a>
        <input type="checkbox" id="btn-4">
        <ul>
            <li><a href="<?php echo BASE_URL . '/logout.php '?>" class="logout"><strong>Logout<strong></a></li>
        </ul>
          <?php endif; ?>
        </li>
        <br>
    </ul>
</nav>
