<?php
include(ROOT_PATH . "/app/database/db.php");
include(ROOT_PATH . "/app/helpers/validatePosts.php");
include(ROOT_PATH . "/app/helpers/middleware.php");



$table = 'posts';

$errors = array();
$id= '';
$title = '';
$topic_id = '';
$body = '';
$published = '';
$comment = '';
$topics = selectAll('topics');
$posts = selectAll($table);


if(isset($_GET['id'])){
  $post =selectOne($table,['id'=>$_GET['id']]);
  $id = $post['id'];
  $title = $post['title'];
  $topic_id = $post['topic_id'];
  $body = $post['body'];
  $published = $post['published'];
}


if(isset($_GET['delete_id'])){
  adminOnly();
  $count = delete($table, $_GET['delete_id']);
  $_SESSION['message']= "Post Deleted Successfully";
  $_SESSION['type'] = "success";
  header('location: ' . BASE_URL . '/admin/posts/index.php');
  exit();
}

if(isset($_GET['published']) && isset($_GET['p_id'])){
  adminOnly();
$published = $_GET['published'];
$p_id = $_GET['p_id'];
$count = update($table,$p_id, ['published'=>$published]);
$_SESSION['message']= "Post Published State Changed";
$_SESSION['type'] = "success";
header('location: ' . BASE_URL . '/admin/posts/index.php');
exit();
}


if(isset($_POST['add-post'])){
adminOnly();
    $errors = validatePost($_POST);

    if (!empty($_FILES['image']['name'])) {
        $image_name = time() . '_' . $_FILES['image']['name'];
        $destination = ROOT_PATH . "/assets/images/" .$image_name;

        $result = move_uploaded_file($_FILES['image']['tmp_name'],$destination);

        if ($result) {
          $_POST['image'] = $image_name;
        } else {
          array_push($errors,"Failed To Upload Image");
        }

    } else {
      array_push($errors,"Post Image Required");
    }

    if(count($errors) === 0){

      unset($_POST['add-post']);
      $_POST['user_id'] = $_SESSION['id'];
      $_POST['published'] = isset($_POST['published']) ? 1 : 0 ;

      $_POST['body'] = htmlentities($_POST['body']);
      $post_id = create($table, $_POST);
      $_SESSION['message']= "Post Created Successfully";
      $_SESSION['type'] = "success";
      header('location: ' . BASE_URL . '/admin/posts/index.php');
      exit();
    }
    else{
      $title = $_POST['title'];
      $body = $_POST['body'];
      $topic_id = $_POST['topic_id'];
      $published = isset($_POST['published']) ? 1 : 0 ;

    }
}

if (isset($_POST['update-post'])){
  adminOnly();
  $errors = validatePost($_POST);

  if (!empty($_FILES['image']['name'])) {
      $image_name = time() . '_' . $_FILES['image']['name'];
      $destination = ROOT_PATH . "/assets/images/" .$image_name;

      $result = move_uploaded_file($_FILES['image']['tmp_name'],$destination);

      if ($result) {
        $_POST['image'] = $image_name;
      } else {
        array_push($errors,"Failed To Upload Image");
      }

  } else {
    array_push($errors,"Post Image Required");
  }

  if(count($errors) === 0){
    $id = $_POST['id'];
    unset($_POST['update-post'],$_POST['id']);
    $_POST['user_id'] = $_SESSION['id'];
    $_POST['published'] = isset($_POST['published']) ? 1 : 0 ;

    $_POST['body'] = htmlentities($_POST['body']);
    $post_id = update($table, $id,$_POST);
    $_SESSION['message']= "Post Updated Successfully";
    $_SESSION['type'] = "success";
    header('location: ' . BASE_URL . '/admin/posts/index.php');
    exit();
  }
  else{
    $title = $_POST['title'];
    $body = $_POST['body'];
    $topic_id = $_POST['topic_id'];
    $published = isset($_POST['published']) ? 1 : 0 ;

  }
}

if(isset($_POST["add-comment"])){
usersOnly();
$id=$_POST['id'];
    $errors = validateComment($_POST);
   if(count($errors) === 0){

       $_POST['user_id']=$_SESSION['id'];
       $_POST['post_id']=$_POST['id'];
       unset($_POST['add-comment'],$_POST['id']);

       $comment_id = create('comments',$_POST);
       $_SESSION['message'] = 'Comment Added Successfully';
       $_SESSION['type'] = 'success';
       header('location: ' . BASE_URL . '/index.php');
       exit();
   }else{

        header('location: ' . BASE_URL . '/single.php?id='.$id);
   }
  }

  // if user clicks like or dislike button
if (isset($_POST['action'])) {
  usersOnly();
  $user_id=$_SESSION['id'];
  $post_id = $_GET['id'];
  $action = $_POST['action'];
  switch ($action) {
  	case 'like':
         $sql="INSERT INTO rating (user_id, post_id, rating)
         	   VALUES ($user_id, $post_id, 1)
         	   ON DUPLICATE KEY UPDATE rating=1";
         break;
  	case 'dislike':
          $sql="INSERT INTO rating (user_id, post_id, rating)
               VALUES ($user_id, $post_id, 0)
         	   ON DUPLICATE KEY UPDATE rating=0";
         break;
  	case 'unlike':
	      $sql="DELETE FROM rating WHERE user_id=$user_id AND post_id=$post_id";
	      break;
  	case 'undislike':
      	  $sql="DELETE FROM rating WHERE user_id=$user_id AND post_id=$post_id";
      break;
  	default:
  		break;
  }
  // execute query to effect changes in the database ...
  mysqli_query($conn, $sql);
  echo getRating($post_id);
  exit(0);
}
function getLikes($id)
{
  global $conn;
  $sql = "SELECT COUNT(*) FROM rating
  		  WHERE post_id = $id AND rating=1";
  $rs = mysqli_query($conn, $sql);
  $result = mysqli_fetch_array($rs);
  return $result[0];
}

// Get total number of dislikes for a particular post
function getDislikes($id)
{
  global $conn;
  $sql = "SELECT COUNT(*) FROM rating
  		  WHERE post_id = $id AND rating=0";
  $rs = mysqli_query($conn, $sql);
  $result = mysqli_fetch_array($rs);
  return $result[0];
}

// Get total number of likes and dislikes for a particular post
function getRating($id)
{
  global $conn;
  $rating = array();
  $likes_query = "SELECT COUNT(*) FROM rating WHERE post_id = $id AND rating=1";
  $dislikes_query = "SELECT COUNT(*) FROM rating
		  			WHERE post_id = $id AND rating=0";
  $likes_rs = mysqli_query($conn, $likes_query);
  $dislikes_rs = mysqli_query($conn, $dislikes_query);
  $likes = mysqli_fetch_array($likes_rs);
  $dislikes = mysqli_fetch_array($dislikes_rs);
  $rating = [
  	'likes' => $likes[0],
  	'dislikes' => $dislikes[0]
  ];
  return json_encode($rating);
}

function getCommentsCount($id)
{
  global $conn;
  $sql = "SELECT COUNT(*) FROM comments
        WHERE post_id = $id ";
  $rs = mysqli_query($conn, $sql);
  $result = mysqli_fetch_array($rs);
  return $result[0];
}

// Check if user already likes post or not
function userLiked($post_id)
{
  usersOnly();
  global $conn;
$user_id=$_SESSION['id'];
  $sql = "SELECT * FROM rating WHERE user_id=$user_id
  		  AND post_id=$post_id AND rating=1";
  $result = mysqli_query($conn, $sql);
  if (mysqli_num_rows($result) > 0) {
  	return true;
  }else{
  	return false;
  }
}

// Check if user already dislikes post or not
function userDisliked($post_id)
{
  usersOnly();
  global $conn;
  $user_id=$_SESSION['id'];
  $sql = "SELECT * FROM rating WHERE user_id=$user_id
  		  AND post_id=$post_id AND rating=0";
  $result = mysqli_query($conn, $sql);
  if (mysqli_num_rows($result) > 0) {
  	return true;
  }else{
  	return false;
  }
}


 ?>
