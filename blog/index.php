<?php include("path.php");
    include(ROOT_PATH . "/app/controllers/topics.php");

    $posts = array();
    $postsTitle = 'Recent Posts';
    $gridTitle = 'Featured Blogs';
    if(isset($_GET['t_id'])){
      $posts = getPostByTopicId($_GET['t_id']);
      $postsTitle = "You Searched for posts under '" . $_GET['name'] . "'";
      $gridTitle = "You Searched for posts under '" . $_GET['name'] . "'";

    }
    else if (isset($_POST['search-term'])) {
        $postsTitle = "You Searched for '" . $_POST['search-term'] . "'";
        $gridTitle = "You Searched for '" . $_POST['search-term'] . "'";
        $posts= search($_POST['search-term']);
    }else{

      $posts = getPublishedPosts();
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<!-- Font Awesome -->

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
<script src="https://kit.fontawesome.com/a076d05399.js"></script>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
<link href="https://fonts.googleapis.com/css2?family=Open+Sans+Condensed:wght@300&display=swap" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://kit.fontawesome.com/fb00e9b9b1.js" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
<script src="assets/js/script.js"></script>


<meta name="viewport" content="width=device-width, initial-scale=1.0">
<!-- Custom Styles -->
<link rel="stylesheet" href="assets/css/style.css">
<title>Blogger Kelvin</title>
</head>
<body>
<!-- header -->
<?php include(ROOT_PATH . "/app/includes/header.php");?>
<?php include(ROOT_PATH . "/app/includes/message.php");?>
<!-- // header -->

<!-- Page wrapper -->

<div class="page-wrapper">
  <!-- Posts Slider -->
  <div class="posts-slider">
    <h1 class="slider-title">Trending Posts</h1>
    <i class="fa fa-chevron-right next"></i>
    <i class="fa fa-chevron-left prev"></i>
    <div class="posts-wrapper">
      <?php foreach ($posts as $post): ?>
        <div class="post">
          <div class="inner-post">
            <img src="<?php echo  BASE_URL . '/assets/images/' . $post['image'];?>" alt="" style="height: 200px; width: 100%; border-top-left-radius: 5px; border-top-right-radius: 5px;">
            <div class="post-info">
              <h4><a href="single.php?id=<?php echo $post['id']; ?>"><?php echo $post['title']; ?></a></h3>
                <div>
                  <i class="fa fa-user-o"></i> <?php echo $post['username']; ?>
                  &nbsp;
                  <i class="fa fa-calendar"></i> <?php echo date('F j, Y',strtotime($post['created_at'])); ?>
                </div>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
  </div>
  <!-- // Posts Slider -->

  <!-- Blogs Grid display -->
  <div class="container-fluid px-0">
     <nav class="navbar navbar-expand-lg navbar-light bg-light navbar-fixed">
         <div class="container-fluid d-flex"> <a class="navbar-brand" href="#"><?php echo $gridTitle; ?></a>
         </div>
     </nav>
  </div>

    <div class="jumbotron justify-content-center">
        <div class="d-flex justify-content-between p-3 bg-white mb-3 align-items-center"> <span class="font-weight-bold text-uppercase">Page 1</span>
            <div> <img src="https://img.icons8.com/windows/100/000000/list.png" width="30" /> <img src="https://img.icons8.com/ios-filled/100/000000/squared-menu.png" width="25" /> </div>
        </div>
        <div class="container">
            <div class="row">
              <?php foreach ($posts as $key => $post): ?>
                  <div class="col-lg-4 col-md-6 col-sm-6 col-xs-8  ">
                    <div> <img  height="200px;"src="<?php echo  BASE_URL . '/assets/images/' . $post['image'];?>" class="card-img-top">
                      <div class="d-flex justify-content-between"> <span class="font-weight-bold" ><?php echo $post['title']; ?></span> <span class="font-weight-bold"><?php echo date('F j, Y',strtotime($post['created_at'])); ?></span> </div>
                        <div class="d-flex align-items-center flex-row">  <i class="fa fa-user-o"></i>  <span class="guarantee"><?php echo $post['username']; ?></span> </div>
                        <p><?php echo html_entity_decode(substr($post['body'],0, 150) . '...'); ?></p>
                        <hr>
                        <div class="card-body">
                          <div class="text-right buttons"> <a href="single.php?id=<?php echo $post['id'];?>"><button class="btn btn-outline-dark"style="background-color:yellow;" ><strong>Read More</strong></button></a></div>
                        </div>
                      </div>
                    </div>
                <?php endforeach; ?>
              </div>
          </div>
     </div>
  <!-- content -->
  <div class="content clearfix">
    <div class="page-content">
      <h1 class="recent-posts-title"><?php echo $postsTitle; ?></h1>
      <?php $i=0; foreach ($posts as $post):  if ($i++ == 4) break;  ?>
        <div class="post clearfix">
          <img src="<?php echo  BASE_URL . '/assets/images/' . $post['image'];?>" class="post-image" alt="">
          <div class="post-content">
            <h2 class="post-title"><a href="single.php?id=<?php echo $post['id'];?>"><?php echo $post['title']; ?></a></h2>
            <div class="post-info">
              <i class="fa fa-user-o"></i> <?php echo $post['username']; ?>
              &nbsp;
              <i class="fa fa-calendar"></i> <?php echo date('F j, Y',strtotime($post['created_at'])); ?>
            </div>
            <p class="post-body"><?php echo html_entity_decode(substr($post['body'],0, 150) . '...'); ?>
            </p>
            <a href="single.php?id=<?php echo $post['id'];?>" class="read-more">Read More</a>
          </div>
        </div>
      <?php endforeach; ?>
    </div>

    <div class="sidebar">
      <!-- Search -->
      <div class="search-div">
        <form id="form" role="search" action="index.php" method="post">
          <input id="query" type="text" name="search-term" class="text-input" placeholder="Search..." aria-label="Search through site content1" style="width: 60%;">
            <button id="search"><strong>Search</strong></button>
        </form>
      </div>
      <!-- // Search -->
      <!-- topics -->
      <div class="section topics">
        <h2>Topics</h2>
        <ul>
          <?php foreach ($topics as $key => $topic):?>
              <a href="<?php echo BASE_URL . '/index.php?t_id=' . $topic['id'] . '&name=' .$topic['name']; ?>"><li><?php echo $topic['name']; ?></li></a>
            <?php endforeach; ?>
        </ul>
      </div>
      <!-- // topics -->
    </div>
  </div>
  <!-- // content -->
</div>
<!-- // page wrapper -->
<!-- FOOTER -->
<?php include(ROOT_PATH ."/app/includes/footer.php");?>
<!-- // FOOTER -->
<!-- JQuery -->
<script>window.jQuery || document.write('<script src="/assets/js/vendor/jquery.slim.min.js"><\/script>')</script><script src="assets/dist/js/bootstrap.bundle.js"></script>


</body>
</html>
