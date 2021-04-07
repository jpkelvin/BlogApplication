<?php
include(ROOT_PATH . "/app/database/db.php");
include(ROOT_PATH . "/app/helpers/middleware.php");



$table = 'comments';




if(isset($_GET['delete_id'])){
  adminOnly();
  $count = delete($table, $_GET['delete_id']);
  $_SESSION['message']= "Comment Deleted Successfully";
  $_SESSION['type'] = "success";
  header('location: ' . BASE_URL . '/admin/posts/index.php');
  exit();
}
?>
