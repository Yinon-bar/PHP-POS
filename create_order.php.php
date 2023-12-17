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
      Create Order
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
      <li class="active">Here</li>
    </ol>
  </section>
  <!-- Main content -->
  <section class="content container-fluid">
    <div class="box box-info">
      <form action="" method="post">
        <div class="box-header with-border">
          <h3 class="box-title">New Order</h3>
        </div>
        <div class="box-body">
          <div class="col-md-6">
            <div class="form-group">
              <label for="txtName">Customer Name</label>
              <input type="text" class="form-control" name="txtCustomer" id="txtName" placeholder="Enter Customer name" required>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label>Date:</label>
              <div class="input-group date">
                <div class="input-group-addon">
                  <i class="fa fa-calendar"></i>
                </div>
                <input type="text" class="form-control pull-right" id="datepicker">
              </div>
              <!-- /.input group -->
            </div>
          </div>
        </div>
        <div class="box-body">
          <div class="col-md-12">
            <table class="table table-striped">
              <thead>
                <tr style="font-size: 1.6rem;">
                  <th>#</th>
                  <th>Search Product</th>
                  <th>In stock</th>
                  <th>Description</th>
                  <th>Image</th>
                  <th>Action</th>
                  <th><button class="btn btn-success btn-delete" name="add">+</button></th>
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
                      <button id="<?= $product['p_id']; ?>" class="btn btn-danger btn-delete">X</button>
                    </td>
                  </tr>
                <?php }
                ?>
              </tbody>
            </table>
          </div>
        </div>
        <div class="box-body"></div>
      </form>
    </div>

  </section>

  <?php include_once "footer.php"; ?>

  <script>
    $('#datepicker').datepicker({
      autoclose: true
    })
  </script>