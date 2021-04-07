<?php include("path.php");
include(ROOT_PATH . '/app/controllers/posts.php');
if (isset($_GET['id'])) {
  $post = selectOne('posts',['id'=>$_GET['id']]);
  $user = selectOne('users',['id'=>$post['user_id']]);
}
$posts = selectAll('posts',['published'=>1]);
$topics = selectAll('topics');
$comment = getComments($_GET['id']);
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

   <!-- Custom Styles -->
  <link rel="stylesheet" href="assets/css/style.css">
  <title><?php echo $post['title']; ?> | BloggerKelvin</title>
</head>
<body id ="single">

  <!-- header -->
<?php include(ROOT_PATH ."/app/includes/header.php");?>
  <!-- // header -->
  <!--Section: Block Content-->
  <div id="SingleTitle"class="jumbotron color-grey-light card-intro-preview">
    <div class="d-flex align-items-center h-100">
      <div class="container text-center py-5">
        <h4 class="mb-0"><?php echo $post['title']; ?></h4>
      </div>
    </div>
  </div>
<div class="container mt-4">
      <!--Grid row-->
      <div class="row">
          <!--Grid column-->
            <div class="col-md-10  mb-4">
          <section>

              <!-- Featured image -->
              <img src="<?php echo  BASE_URL . '/assets/images/' . $post['image'];?>" class="img-fluid z-depth-2 mb-4 rounded"
                alt="Responsive image">

              <!-- Post data -->
              <div class="text-center d-md-flex align-items-center justify-content-between text-uppercase text-muted small">
                <p>By
                  <a href="#!" class="text-reset"><strong><?php echo $user['username']; ?> </strong></a>
                  <a href="#!" class="text-reset ml-3"><?php echo date('F j, Y',strtotime($post['created_at'])); ?></a>
                </p>
                <div class="post-info">
             <!-- if user likes post, style button differently -->
               <i id="thumb" <?php if (userLiked($post['id'])): ?> class="fa fa-thumbs-up like-btn"
                 <?php else: ?>
                   class="fa fa-thumbs-o-up like-btn"
                 <?php endif ?>
                 data-id="<?php echo $post['id'] ?>"></i>
               <span class="likes" style="font-size:1.5rem;"><?php echo getLikes($post['id']); ?></span>

               &nbsp;&nbsp;&nbsp;&nbsp;

             <!-- if user dislikes post, style button differently -->
               <i id="thumb"
                 <?php if (userDisliked($post['id'])): ?>
                   class="fa fa-thumbs-down dislike-btn"
                 <?php else: ?>
                   class="fa fa-thumbs-o-down dislike-btn"
                 <?php endif ?>
                 data-id="<?php echo $post['id'] ?>"></i>
               <span class="dislikes"style="font-size:1.5rem;"><?php echo getDislikes($post['id']); ?></span>
             </div>

              </div>

          </section>
            <!--Section: Block Content-->
            <section>
              <p><?php echo html_entity_decode($post['body']); ?></p>
            </section>

            <!--Section: Block Content-->
<section class="mb-5">

  <h5 class="text-center mb-4">Add a comment</h5>

  <div class="d-md-flex flex-md-fill">
    <div class="d-flex justify-content-center">
      <img class="card-img-100 rounded d-flex z-depth-1 mr-3 mb-4" src="assets/images/man.svg"  style="width:100px;height:100px;"alt="avatar">
    </div>
    <!-- Your review -->
    <form action="single.php" method="post">
        <?php include(ROOT_PATH ."/app/helpers/formErrors.php");?>
        <div class="md-form md-outline mt-0 w-100">
          <input id="comment" type="text" name="comment"  placeholder="comment"class="md-textarea form-control"></input>
        </div>
  </div>
      <input type="hidden" name="id" value="<?php echo $post['id']; ?>">
      <div class="text-center">
        <button type="submit" name="add-comment"  class="btn" ><strong>Submit</strong></button>
      </div>
    </form>
  <!-- Block Content -->
    <div class="jumbotron comment">

      <section class="text-center text-lg-left mb-4">
        <h5 class="text-center mb-4"><span><?php echo getCommentsCount($post['id']); ?></span> Comments</h5>
        <?php $i=0; foreach ($comment as $key => $c):  if ($i++ == 4) break;  ?>
          <div class="media d-block d-md-flex mt-3">
            <img class="card-img-64 rounded z-depth-1 d-flex mx-auto mb-3"
            src="assets/images/man.svg" alt="Generic placeholder image" style="width:70px;height:70px;">
            <div class="media-body text-center text-md-left ml-md-3 ml-0">
              <h6><a class="text-reset my-0" href="#!"><?php echo $c['username']; ?></a></h6>
              <p><?php echo html_entity_decode($c['comment']); ?></p>
            </div>
          </div>
        <?php endforeach; ?>
      </section>
      <!--Section: Block Content-->
    </div>
</section>
<!--Section: Block Content-->

      </div>

      <!--Grid column-->
        <div class=" col-md-2 mb-4 ">
          <!-- Card -->  <div class="mb-4">
          <div  class="page-wrapper">
          <div class="content clearfix">
          <div class="sidebar single">

            <!-- Popular Posts -->
            <h2 style="font-size:30px; ;"><strong>Popular Posts</strong></h2>
            <div class="section popular " style="background-color: #220D95;color: white;width:100%; height:400px;">
              <marquee width="100%" scrollamount="5" direction="up" height="100%">
              <?php $i = 1; foreach ($posts as $key => $p): if ($i++ == 4) break; ?>

                <div class="post clearfix">
                  <a href="single.php?id=<?php echo $p['id'];?>"><img src="<?php echo  BASE_URL . '/assets/images/' . $p['image'];?>"></a>
                  <a href="single.php?id=<?php echo $p['id'];?>" class="title"><?php echo $p['title']; ?></a>
                </div>
              <?php endforeach; ?>
              </marquee>
            </div>
            </div>
          </div>
          </div>
        </div>
      </div>
  </div>
</div>

  <!-- FOOTER -->
  <?php include(ROOT_PATH ."/app/includes/footer.php")?>
  <!-- // FOOTER -->


  <!-- JQuery -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <!-- Slick JS -->
  <script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
  <script src="assets/js/single.js"></script>
</body>
</html>
