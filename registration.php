<?php include "db_connect.php"; ?>
<?php session_start(); ?>
<?php include_once "header.php"; ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
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

    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title">Registration Form</h3>
      </div>
      <form role="form" method="post">
        <div class="box-body">
          <div class="col-md-4">
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
              <select class="form-control">
                <option>Admin</option>
                <option>User</option>
              </select>
            </div>
            <div class="box-footer">
              <button type="submit" name="submit" class="btn btn-primary">Submit</button>
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