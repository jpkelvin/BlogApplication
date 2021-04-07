<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

<nav >
      <div class="logo">
        <a href="<?php echo BASE_URL . '/index.php'?>">
          <h1 class="logo-text"  style="height: 80px;width: 240px;margin-top: 1rem;color:white;"><span><strong>Blogger</span>Kelvin</strong></h1>
        </a>
      </div>
      <label for="btn" class="icon">
        <span class="fa fa-bars"></span>
      </label>
      <input type="checkbox" id="btn">
      <ul>
        <form id="form" role="search" action="index.php" method="post">
            <input type="search" id="query" name="search-term"
             placeholder="Search..."
             aria-label="Search through site content1" style="width: 60%;">
            <button id="search"><strong>Search</strong></button>
          </form>
          <br>
          <br><br>

          <li><a href="<?php echo BASE_URL . '/index.php'?>"><strong>Home</strong></a></li>
          <li><a href="#"><strong>Blogs</strong></a></li>
          <li><a href="http://localhost:8000/blog/index.php?t_id=15&name=Covid-19" ><strong>CoronaVirus</strong></a></li>
          <li><a href="#"><strong>Inspiration</strong></a></li>

          <?php if (isset($_SESSION['id'])): ?>
          <li>
          <label for="btn-4" class="show "><strong><i class="fa fa-user" aria-hidden="true" style="margin-right:5px;"></i><?php echo $_SESSION['username']; ?><i class="fa fa-chevron-down"></i></strong></label>
          <a href="#"><i class="fa fa-user" aria-hidden="true" style="margin-right:5px;"></i><strong ><?php echo $_SESSION['username']; ?><i class="fa fa-chevron-down"style="margin-left:5px;"></i></strong></a>
          <input type="checkbox" id="btn-4">
          <ul>
            <?php  if($_SESSION['admin']): ?>
              <li><a href="<?php echo BASE_URL . '/admin/dashboard.php '?>"><strong>Dashboard<strong></a></li>
              <?php endif; ?>
              <li><a href="<?php echo BASE_URL . '/logout.php '?>" class="logout"><strong>Logout<strong></a></li>
          </ul>
            <?php else: ?>
                  <li><a href="<?php echo BASE_URL . '/register.php'?>"><strong>Sign up<strong></a></li>
                  <li><a href="<?php echo BASE_URL . '/login.php'?>"><strong><i  style="margin-right: 0.5em;" class="fa fa-sign-in" ></i>Login<strong></a></li>
            <?php endif; ?>
          </li>
        <br>
      </ul>
    </nav>
  <!--NAVBAR  END-->
