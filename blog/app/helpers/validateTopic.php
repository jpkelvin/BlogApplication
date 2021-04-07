<?php
function validateTopic($topic)
{
    $errors = array();

    if (empty($topic['name'])){
      array_push($errors,'Name is required');
    }

    //
    // $existingTopic = selectOne('topics',['name'=>$topic['name']]);
    // if($existingTopic){
    //   array_push($errors,'Name Already Exits ');
    // }
    $existingTopic = selectOne('topics',['name'=>$topic['name']]);
    if($existingTopic){
      if(isset($topic['update-topic_id'])&& $existingTopic['id'] != $post['name']){
      array_push($errors,'Name Already Exits ');
    }
    if(isset($_POST['add-topic'])){
      array_push($errors,'Name Already Exits ');
    }
   }
    return $errors;
}

 ?>
