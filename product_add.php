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
  $f_name = $_FILES['txtImage']['name'];
  $f_temp = $_FILES['txtImage']['tmp_name'];
  $f_location = "upload/" . $f_name;
  move_uploaded_file($f_temp, "upload/" . $f_name);
  $query = $pdo->prepare(
    "INSERT INTO 
    tbl_product (p_name, p_category, purchase_price, sell_price, p_stock, p_desc, p_image) 
    VALUES 
    (:product_name, :product_category, :product_purchase, :product_sell, :product_stock, :product_description, :f_location)"
  );
  $query->bindParam(':product_name', $product_name);
  $query->bindParam(':product_category', $product_category);
  $query->bindParam(':product_purchase', $product_purchase);
  $query->bindParam(':product_sell', $product_sell);
  $query->bindParam(':product_stock', $product_stock);
  $query->bindParam(':product_description', $product_description);
  $query->bindParam(':f_location', $f_location);
  if ($query->execute()) {
    $messages[] = "Product Added!";
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
      <?php
      if (isset($errors)) {
        foreach ($errors as $error) { ?>
          <div style="font-weight: bold; padding:1rem;" class="bg-danger text-danger">
            <?= $error; ?>
          </div>
      <?php }
      } ?>
      <?php
      if (isset($messages)) {
        foreach ($messages as $message) { ?>
          <div style="font-weight: bold; padding:1rem;" class="bg-success text-success">
            <?= $message; ?>
          </div>
      <?php }
      } ?>
      <div class="box-header with-border">
        <h3 class="box-title">Product</h3>
      </div>
      <form role="form" method="post" enctype="multipart/form-data">
        <div class="box-body">
          <div class="col-md-6">
            <div class="form-group">
              <label for="txtName">Product Name</label>
              <input type="text" class="form-control" name="txtName" id="txtName" placeholder="Enter category name" required>
            </div>
            <div class="form-group">
              <label>Category</label>
              <select class="form-control" name="txtCategory" required>
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
              <input type="number" class="form-control" name="txtPurchasePrice" id="txtPurchasePrice" placeholder="Enter category price" required>
            </div>
            <div class="form-group">
              <label for="txtPrice">Sell price</label>
              <input type="number" class="form-control" name="txtPrice" id="txtPrice" placeholder="Enter category price" required>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label for="txtStock">Stock</label>
              <input type="text" class="form-control" name="txtStock" id="txtStock" placeholder="Enter stock Qty" required>
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