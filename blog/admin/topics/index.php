<?php include('../../path.php');?>
<?php include(ROOT_PATH ."/app/controllers/topics.php");
adminOnly();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />

  <!-- Custom Styles -->
  <link rel="stylesheet" href="../../assets/css/style.css">

  <!-- Admin Styling -->
  <link rel="stylesheet" href="../../assets/css/admin.css">
  <title>Admin - Manage Topics</title>
</head>

<body>

  <!-- header -->
<?php include(ROOT_PATH . "/app/includes/adminHeader.php");?>
  <!-- // header -->

  <div class="admin-wrapper clearfix">
    <!-- Left Sidebar -->
  <?php include(ROOT_PATH . "/app/includes/adminSidebar.php");?>
    <!-- // Left Sidebar -->

    <!-- Admin Content -->
    <div class="admin-content clearfix">
      <div class="button-group">
        <a href="create.php" class="btn btn-sm">Add Topic</a>
      </div>
      <div class="">
        <h2 style="text-align: center;">Manage Topic</h2>
<?php include(ROOT_PATH . "/app/includes/message.php");?>
        <table>
          <thead>
            <th>SN</th>
            <th>Name</th>
            <th colspan="2">Action</th>
          </thead>
          <tbody>

            <?php foreach ($topics as $key => $topic):?>

              <tr class="rec">
                <td><?php echo $key +1; ?> </td>
                <td><a href="#"><?php echo $topic['name']; ?></a></td>
                <td><a href="edit.php?id=<?php echo $topic["id"]; ?>" class="edit">Edit</a></td>
                <td><a href="index.php?del_id=<?php echo $topic['id']; ?>" class="delete">Delete</a></td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>

      </div>
    </div>
    <!-- // Admin Content -->

  </div>


  <!-- JQuery -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

  <script src="../../assets/js/script.js"></script>

</body>

</html>
