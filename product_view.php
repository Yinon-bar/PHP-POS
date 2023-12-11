<?php include "db_connect.php"; ?>
<?php session_start(); ?>
<?php if ($_SESSION['user_email'] == "" || $_SESSION['user_role'] == 'user') {
  header('location:index.php');
} ?>
<?php include_once "header-user.php"; ?>
<?php
if (isset($_GET['view_id'])) {
  $p_id = $_GET['view_id'];
  $query = $pdo->prepare("SELECT * FROM tbl_product WHERE p_id = '$p_id'");
  $query->execute();
  if ($query->rowCount() == 1) {
    $product = $query->fetch(PDO::FETCH_ASSOC);
  } else {
    $errors[] = "Error";
  }
}
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      View Product
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
        <h3 class="box-title">View Product</h3>
      </div>
      <div class="box-body">
        <div class="col-md-6">
          <ul class="list-group">
            <center>
              <p class="list-group-item list-group-item-success"><b>Product Detail</b></p>
            </center>
            <li class="list-group-item">ID <span class="label label-info pull-right"><?= $product['p_id']; ?></span></li>
            <li class="list-group-item">Product name<span class="label label-info pull-right"><?= $product['p_name']; ?></span></li>
          </ul>
        </div>
        <div class="col-md-6">
          <ul class="list-group">
            <center>
              <p class="list-group-item list-group-item-success"><b>Product Image</b></p>
            </center>
            <li class="list-group-item">new <span class="badge">5</span></li>
            <li class="list-group-item">Item<span class="badge">12</span></li>
            <li class="list-group-item">new <span class="badge">5</span></li>
          </ul>
        </div>
      </div>
    </div>
  </section>
  <!-- /.content -->
  <?php include_once "footer.php"; ?>