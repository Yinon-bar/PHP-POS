<?php session_start(); ?>
<?php if ($_SESSION['user_email'] == "") {
  header('location:index.php');
} ?>
<?php include "db_connect.php" ?>
<?php include_once "header.php"; ?>

<?php if (isset($_POST['submit'])) {
  $old_password = $_POST['old_password'];
  $new_password = $_POST['new_password'];
  $confirm_password = $_POST['confirm_password'];

  $email = $_SESSION['user_email'];
  $query = $pdo->prepare("SELECT * FROM tbl_user WHERE user_email = '$email'");
  $query->execute();
  $user = $query->fetch(PDO::FETCH_ASSOC);

  if ($old_password == $user['password'] and $email == $user['user_email']) {
    if ($new_password == $confirm_password) {
      $user_id = $user['id'];
      $query = $pdo->prepare("UPDATE tbl_user SET password = '$new_password' WHERE id = '$user_id'");
      $query->execute();
      if (!$query) {
        die("Error" . $pdo->errorInfo());
      }
      $msg = "Password changed!";
    }
  } else {
    $msg = "Email or Password are incorrect!";
  }
}
?>

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Change Password
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
      <li class="active">Here</li>
    </ol>
  </section>
  <!-- Main content -->
  <section class="content container-fluid">
    <!-- general form elements -->
    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title">Change Password</h3>
        <br />
        <h4 style="margin-top: 1rem;" class="box-title text-danger text-bold"><?= $msg ?></h4>
      </div>
      <form role="form" method="post">
        <div class="box-body">
          <div class="form-group">
            <label for="old_password">Old Password</label>
            <input type="text" class="form-control" id="old_password" name="old_password" placeholder="Password" required>
          </div>
          <div class="form-group">
            <label for="new_password">New Password</label>
            <input type="password" class="form-control" id="new_password" name="new_password" placeholder="Password" required>
          </div>
          <div class="form-group">
            <label for="confirm_password">Confirm Password</label>
            <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Password" required>
          </div>
        </div>
        <div class="box-footer">
          <button type="submit" name="submit" class="btn btn-primary">Update</button>
        </div>
      </form>
    </div>

  </section>
  <!-- /.content -->
  <?php include_once "footer.php"; ?>