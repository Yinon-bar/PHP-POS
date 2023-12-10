<?php session_start(); ?>
<?php include "db_connect.php"; ?>
<?php
if (empty($_SESSION) || $_SESSION['user_email'] == "" || $_SESSION['user_role'] == 'user') {
  header('location:index.php');
}
include_once "header-user.php";
if (isset($_POST['submit'])) {
  $cat_name = $_POST['txtCategory'];
  $query = $pdo->prepare("SELECT * FROM tbl_category WHERE cat_name = '$cat_name'");
  $query->execute();
  if ($query->rowCount() > 0) {
    $errors[] = "The Category already exist";
  } else {
    $query = $pdo->prepare("INSERT INTO tbl_category (cat_name) VALUES(:cat_name)");
    $query->bindParam(':cat_name', $_POST['txtCategory']);
    if ($query->execute()) {
      $errors[] = "Category inserted";
    } else {
      echo "Error";
    }
  }
}
if (isset($_POST['update-submit'])) {
  $cat_name = $_POST['txtCategory'];
  $cat_id = $_GET['edit_id'];
  $query = $pdo->prepare("UPDATE tbl_category SET cat_name = '$cat_name' WHERE cat_id = '$cat_id'");
  if ($query->execute()) {
    $errors[] = "Category Updated!";
  } else {
    echo "Error";
  }
}
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Category
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
      <li class="active">Here</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content container-fluid">
    <div class="box box-info">
      <div class="box-header with-border">
        <h3 class="box-title">Category</h3>
      </div>
      <form role="form" method="post">
        <div class="box-body">
          <div class="col-md-4">
            <div class="bg-danger text-danger padding-3">
              <?php
              if (isset($errors)) {
                foreach ($errors as $error) {
                  echo $error;
                }
              } ?>
            </div>
            <div class="form-group">
              <label for="name">Category Name</label>
              <input type="text" class="form-control" name="txtCategory" id="name" placeholder="Enter category name">
            </div>
            <div class="box-footer">
              <button type="submit" name="submit" class="btn btn-info">Save</button>
            </div>
            <?php
            if (isset($_GET['edit_id'])) {
              $cat_id = $_GET['edit_id'];
              $query = $pdo->prepare("SELECT * FROM tbl_category WHERE cat_id = '$cat_id'");
              $query->execute();
              $category = $query->fetch(PDO::FETCH_ASSOC);
            ?>
              <form action="" method="post">
                <div class="form-group">
                  <label for="name">Edit Name</label>
                  <input type="text" class="form-control" name="txtCategory" value="<?= $category['cat_name'] ?>" id="name" placeholder="Enter category name">
                </div>
                <div class="box-footer">
                  <button type="submit" name="update-submit" class="btn btn-info">Update</button>
                </div>
              </form>
            <?php }
            ?>
          </div>
          <div class="col-md-8">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Category Name</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $query = $pdo->prepare("SELECT * FROM tbl_category");
                $query->execute();
                $categories = $query->fetchAll(PDO::FETCH_ASSOC);
                foreach ($categories as $category) { ?>
                  <tr>
                    <td><?= $category['cat_id'] ?></td>
                    <td><?= $category['cat_name'] ?></td>
                    <td style="width: 20%;">
                      <a class="btn btn-warning" href="category.php?edit_id=<?= $category['cat_id'] ?>">Edit</a>
                      <a class="btn btn-danger" href="category.php?cat_id=<?= $category['cat_id'] ?>">X</a>
                    </td>
                  </tr>
                <?php }
                ?>
              </tbody>
            </table>
          </div>
        </div>
      </form>
    </div>

  </section>
  <!-- /.content -->
  <?php include_once "footer.php"; ?>