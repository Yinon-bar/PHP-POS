<?php session_start() ?>
<?php
include_once "db_connect.php";
if ($_SESSION['user_email'] == "" || $_SESSION['user_role'] == 'user') {
  header('location:index.php');
} ?>
<?php include_once "header-user.php"; ?>
<?php
if (isset($_POST['add_product'])) {
  $product_name = $_POST['txtName'];
  $product_category = $_POST['txtCategory'];
  $product_purchase = $_POST['txtPurchasePrice'];
  $product_sell = $_POST['txtPrice'];
  $product_stock = $_POST['txtStock'];
  $product_description = $_POST['txtDesc'];
  // $product_img = $_POST['txtImage'];
  $f_name = $_FILES['txtImage']['name'];
  $f_temp = $_FILES['txtImage']['tmp_name'];
  // $f_size = $_FILES['txtImage']['size'];
  move_uploaded_file($f_temp, "upload/" . $f_name);
}
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      <a href="product_list.php" class="btn btn-primary">Back to product list</a>
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
        <h3 class="box-title">Product</h3>
      </div>
      <form role="form" method="post" enctype="multipart/form-data">
        <div class="box-body">
          <div class="col-md-6">
            <div class="bg-danger text-danger padding-3">
              <?php
              if (isset($errors)) {
                foreach ($errors as $error) {
                  echo $error;
                }
              } ?>
            </div>
            <div class="form-group">
              <label for="txtName">Product Name</label>
              <input type="text" class="form-control" name="txtName" id="txtName" placeholder="Enter category name">
            </div>
            <div class="form-group">
              <label>Category</label>
              <select class="form-control" name="txtCategory">
                <option value="0" disabled selected>Select Category</option>
                <?php
                $query = $pdo->prepare("SELECT * FROM tbl_category");
                $query->execute();
                $categories = $query->fetchAll(PDO::FETCH_ASSOC);
                if (!$query) {
                  echo "Error";
                }
                foreach ($categories as $category) { ?>
                  <option value="<?= $category['cat_id'] ?>"><?= $category['cat_name'] ?></option>
                <?php }
                ?>
              </select>
            </div>
            <div class="form-group">
              <label for="txtPurchasePrice">Purchase price</label>
              <input type="number" class="form-control" name="txtPurchasePrice" id="txtPurchasePrice" placeholder="Enter category price">
            </div>
            <div class="form-group">
              <label for="txtPrice">Sell price</label>
              <input type="number" class="form-control" name="txtPrice" id="txtPrice" placeholder="Enter category price">
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label for="txtStock">Stock</label>
              <input type="text" class="form-control" name="txtStock" id="txtStock" placeholder="Enter stock Qty">
            </div>
            <div class="form-group">
              <label for="txtDesc">Description</label>
              <textarea class="form-control" name="txtDesc" id="txtDesc" placeholder="Description" rows="4"></textarea>
            </div>
            <div class="form-group">
              <label for="txtImage">Product image</label>
              <input class="form-control" type="file" name="txtImage" id="txtImage">
            </div>
          </div>
        </div>
        <div class="box-footer">
          <button type="submit" name="add_product" class="btn btn-info">Add product</button>
        </div>
      </form>
    </div>
  </section>
  <!-- /.content -->
  <?php include_once "footer.php"; ?>