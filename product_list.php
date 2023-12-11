<?php include "db_connect.php"; ?>
<?php session_start(); ?>
<?php if ($_SESSION['user_email'] == "" || $_SESSION['user_role'] == 'user') {
  header('location:index.php');
} ?>
<?php include_once "header-user.php"; ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Product List
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
      <li class="active">Here</li>
    </ol>
  </section>
  <section class="content container-fluid">
    <div class="box box-info">
      <div class="box-header with-border">
        <h3 class="box-title">Product List</h3>
        <table class="table table-striped">
          <thead>
            <tr style="font-size: 1.6rem;">
              <th>#</th>
              <th>Product name</th>
              <th>Product category</th>
              <th>Purchase price</th>
              <th>Sell price</th>
              <th>In stock</th>
              <th>Description</th>
              <th>Image</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $query = $pdo->prepare("SELECT * FROM tbl_product");
            $query->execute();
            $products = $query->fetchAll(PDO::FETCH_ASSOC);
            foreach ($products as $product) { ?>
              <tr style="font-size: 1.8rem;">
                <td><?= $product['p_id'] ?></td>
                <td><?= $product['p_name'] ?></td>
                <td><?= $product['p_category'] ?></td>
                <td><?= $product['purchase_price'] ?></td>
                <td><?= $product['sell_price'] ?></td>
                <td><?= $product['p_stock'] ?></td>
                <td style="max-width: 250px;"><?= $product['p_desc'] ?></td>
                <td><img style="width: 100px;" src="<?= $product['p_image'] ?>" class="img-rounded"></td>
                <td>
                  <a class="btn btn-info" href="product_view.php?view_id=<?= $product['p_id']; ?>">View</a>
                  <a class="btn btn-warning" href="product_edit.php?id=<?= $product['p_id']; ?>">Edit</a>
                  <a class="btn btn-danger" href="product_delete.php?id=<?= $product['p_id']; ?>">X</a>
                </td>
              </tr>
            <?php }
            ?>
          </tbody>
        </table>
      </div>
    </div>

  </section>
  <!-- /.content -->
  <?php include_once "footer.php"; ?>