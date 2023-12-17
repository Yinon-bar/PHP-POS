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
                  <th>Price</th>
                  <th>Enter Quantity</th>
                  <th>Total</th>
                  <th><button class="btn btn-success btn-add" name="add">+</button></th>
                </tr>
              </thead>
              <tbody>

              </tbody>
            </table>
          </div>
        </div>
        <div class="box-body">
          <div class="col-md-6">
            <div class="form-group">
              <label for="txtSubtotal">Subtotal</label>
              <input type="text" class="form-control" name="txtSubtotal" id="txtSubtotal" required>
            </div>
            <div class="form-group">
              <label for="txtTax">Tax (17%)</label>
              <input type="text" class="form-control" name="txtTax" id="txtTax" required>
            </div>
            <div class="form-group">
              <label for="txtDiscount">Discount</label>
              <input type="text" class="form-control" name="txtDiscount" id="txtDiscount" required>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label for="txtTotal">Total</label>
              <input type="text" class="form-control" name="txtTotal" id="txtTotal" placeholder="Enter category name" required>
            </div>
            <div class="form-group">
              <label for="txtPaid">Paid</label>
              <input type="text" class="form-control" name="txtPaid" id="txtPaid" placeholder="Enter category name" required>
            </div>
            <div class="form-group">
              <label for="txtDue">Due</label>
              <input type="text" class="form-control" name="txtDue" id="txtDue" placeholder="Enter category name" required>
            </div>
          </div>
        </div>
      </form>
    </div>
  </section>
  <?php include_once "footer.php"; ?>

  <script>
    $('#datepicker').datepicker({
      autoclose: true
    })
  </script>