<?php

function validatePost($post)
{
    $errors = array();

    if (empty($post['title'])){
      array_push($errors,'Title is required');
    }
    if (empty($post['body'])){
      array_push($errors,'Body is required');
    }
    if (empty($post['topic_id'])){
      array_push($errors,'Please Select A Topic');
    }

    $existingPost = selectOne('posts',['title'=>$post['title']]);
    if($existingPost){
      if(isset($post['update-post'])&& $existingPost['id'] != $post['id']){
      array_push($errors,'Post With That Title Already Exits ');
    }
    if(isset($_POST['add-post'])){
      array_push($errors,'Post With That Title Already Exits ');
    }
   }

    return $errors;
}
function validateComment($comment)
{
    $errors = array();

    if (empty($comment['comment'])){
      array_push($errors,'Comment is required');
    }
    return $errors;
}


 ?>
