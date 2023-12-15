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

          </div>
          <div class="col-md-6">

          </div>
        </div>
        <div class="box-body"></div>
        <div class="box-body"></div>
      </form>
    </div>

  </section>

  <?php include_once "footer.php"; ?>