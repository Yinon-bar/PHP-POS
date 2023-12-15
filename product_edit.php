<?php session_start() ?>
<?php
include_once "db_connect.php";
if ($_SESSION['user_email'] == "" || $_SESSION['user_role'] == 'user') {
  header('location:index.php');
} ?>
<?php include_once "header-user.php"; ?>
<?php
if (isset($_GET['id'])) {
  $product_id = $_GET['id'];
  $query = $pdo->prepare("SELECT * FROM tbl_product WHERE p_id = '$product_id'");
  $query->execute();
  if ($query->rowCount() == 1) {
    $product = $query->fetch(PDO::FETCH_ASSOC);
  } else {
    $errors[] = "Error";
  }
  $product_name = $product['p_name'];
  $product_category = $product['p_category'];
  $product_purchase = $product['purchase_price'];
  $product_sell = $product['sell_price'];
  $product_stock = $product['p_stock'];
  $product_description = $product['p_desc'];
  $f_location = $product['p_image'];
}
if (isset($_POST['update_product'])) {
  $product_name = $_POST['txtName'];
  $product_category = $_POST['txtCategory'];
  $product_purchase = $_POST['txtPurchasePrice'];
  $product_sell = $_POST['txtPrice'];
  $product_stock = $_POST['txtStock'];
  $product_description = $_POST['txtDesc'];
  $f_name = $_FILES['txtImage']['name'];
  if (!empty($f_name)) {
    $f_location  = "upload/" . $f_name;
  } else {
    $f_name = $f_location;
  }
  $f_temp = $_FILES['txtImage']['tmp_name'];
  move_uploaded_file($f_temp, "upload/" . $f_name);
  $query = $pdo->prepare(
    "UPDATE tbl_product 
    SET
    p_name = :product_name, p_category = :product_category, purchase_price = :product_purchase, sell_price = :product_sell, p_stock = :product_stock, p_desc = :product_description, p_image = :f_location 
    WHERE p_id = $product_id"
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
    echo "Success";
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
      <div class="box-header with-border">
        <h3 class="box-title">Update Product</h3>
      </div>
      <form role="form" method="post" enctype="multipart/form-data">
        <div class="box-body">
          <div class="col-md-6">
            <div class="form-group">
              <label for="txtName">Product Name</label>
              <input type="text" class="form-control" value="<?= $product['p_name'] ?>" name="txtName" id="txtName" placeholder="Enter category name" required>
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
                  <option <?= $category['cat_id'] == $product_category ? 'selected' : "" ?> value="<?= $category['cat_id'] ?>"><?= $category['cat_name'] ?></option>
                <?php }
                ?>
              </select>
            </div>
            <div class="form-group">
              <label for="txtPurchasePrice">Purchase price</label>
              <input type="number" class="form-control" value="<?= $product['purchase_price'] ?>" name="txtPurchasePrice" id="txtPurchasePrice" placeholder="Enter category price" required>
            </div>
            <div class="form-group">
              <label for="txtPrice">Sell price</label>
              <input type="number" class="form-control" value="<?= $product['sell_price'] ?>" name="txtPrice" id="txtPrice" placeholder="Enter category price" required>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label for="txtStock">Stock</label>
              <input type="text" class="form-control" value="<?= $product['p_stock'] ?>" name="txtStock" id="txtStock" placeholder="Enter stock Qty" required>
            </div>
            <div class="form-group">
              <label for="txtDesc">Description</label>
              <textarea class="form-control" name="txtDesc" id="txtDesc" placeholder="Description" rows="4"><?= $product['p_desc'] ?></textarea>
            </div>
            <div class="form-group">
              <label for="txtImage">Product image</label>
              <img style="width: 100px; margin:1rem; display:block;" src="<?= $f_location ?>" class="img-rounded">
              <input class="form-control" value="<?= $f_location ?>" type="file" name="txtImage" id="txtImage">
            </div>
          </div>
        </div>
        <div class="box-footer">
          <button type="submit" name="update_product" class="btn btn-info">Update product</button>
        </div>
      </form>
    </div>

  </section>
  <!-- /.content -->
  <?php include_once "footer.php"; ?>