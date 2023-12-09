<?php session_start(); ?>
<?php include_once "header-user.php"; ?>
<?php
if ($_SESSION['user_email'] == "" || $_SESSION['user_role'] == 'user') {
  header('location:index.php');
} ?>

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
              </tbody>
            </table>
          </div>
        </div>
      </form>
    </div>

  </section>
  <!-- /.content -->
  <?php include_once "footer.php"; ?>