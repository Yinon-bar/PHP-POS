<?php include "db_connect.php"; ?>
<?php session_start(); ?>
<?php if ($_SESSION['user_email'] == "" || $_SESSION['user_role'] == 'user') {
  header('location:index.php');
} ?>
<?php include_once "header.php"; ?>
<!-- Insert new user -->
<?php
if (isset($_POST['submit'])) {
  $errors = [];
  $user_name = $_POST['txtName'];
  $user_email = $_POST['txtEmail'];
  $user_password = $_POST['txtPassword'];
  $user_role = $_POST['txtRole'];
  // Check if there isn't an email already exist
  $query = $pdo->prepare("SELECT * FROM tbl_user WHERE user_email = '$user_email'");
  $query->execute();
  if ($query->rowCount() > 0) {
    $errors[] = "The email you entered is already taken";
  } else {
    $query = $pdo->prepare("INSERT INTO tbl_user (user_name, user_email, password, role) VALUES(:name, :email, :pass, :role)");
    $query->bindParam(':name', $user_name);
    $query->bindParam(':email', $user_email);
    $query->bindParam(':pass', $user_password);
    $query->bindParam(':role', $user_role);
    if ($query->execute()) {
      $errors[] = "User inserted";
    } else {
      echo "Error";
    }
  }
}
// Delete function
if (isset($_GET['id'])) {
  $id = $_GET['id'];
  $query = $pdo->prepare("DELETE FROM tbl_user WHERE id = '$id'");
  $query->execute();
  if ($query->rowCount() > 0) {
    $errors[] = "Deleted successfully";
  }
}
?>
<div class="content-wrapper">
  <section class="content-header">
    <h1>
      Registration
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
        <h3 class="box-title">Registration Form</h3>
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
              <label for="name">Name</label>
              <input type="text" class="form-control" name="txtName" id="name" placeholder="Enter name">
            </div>
            <div class="form-group">
              <label for="email">Email address</label>
              <input type="email" class="form-control" name="txtEmail" id="email" placeholder="Enter email">
            </div>
            <div class="form-group">
              <label for="password">Password</label>
              <input type="password" class="form-control" name="txtPassword" id="password" placeholder="Password">
            </div>
            <div class="form-group">
              <label>Role</label>
              <select class="form-control" name="txtRole">
                <option value="0" disabled selected>Select role</option>
                <option value="1">User</option>
                <option value="2">Admin</option>
              </select>
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
                  <th>Name</th>
                  <th>Email</th>
                  <th>Password</th>
                  <th>Role</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $query = $pdo->prepare("SELECT * FROM tbl_user");
                $query->execute();
                $users = $query->fetchAll(PDO::FETCH_ASSOC);
                foreach ($users as $user) { ?>
                  <tr>
                    <td><?= $user['id'] ?></td>
                    <td><?= $user['user_name'] ?></td>
                    <td><?= $user['user_email'] ?></td>
                    <td><?= $user['password'] ?></td>
                    <td><?= $user['role'] ?></td>
                    <td><a class="btn btn-danger" href="registration.php?id=<?= $user['id']; ?>">X</a></td>
                  </tr>
                <?php }
                ?>
              </tbody>
            </table>
          </div>
        </div>
      </form>
    </div>

  </section>
  <!-- /.content -->
  <?php include_once "footer.php"; ?>