<?php
include_once "db_connect.php";
session_start();
if (isset($_POST['btn_login'])) {
  $userEmail = $_POST['txt_email'];
  $password = $_POST['txt_password'];
  $select = $pdo->prepare("SELECT * FROM tbl_user WHERE user_email = '$userEmail' AND password = '$password'");
  $select->execute();
  $row = $select->fetch(PDO::FETCH_ASSOC);
  if ($row['user_email'] == $userEmail && $row['password'] == $password && $row['role'] == "admin") {
    header('refresh:1;dashboard.php');
    // במידה וכל הנתונים נכונים אז ורק אז נכניס אותם לסשן
    $_SESSION['user_id'] = $row['id'];
    $_SESSION['user_name'] = $row['user_name'];
    $_SESSION['user_email'] = $row['user_email'];
    $_SESSION['user_role'] = $row['role'];
  } elseif ($row['user_email'] == $userEmail && $row['password'] == $password && $row['role'] == "user") {
    header('refresh:1;user.php');
    // במידה וכל הנתונים נכונים אז ורק אז נכניס אותם לסשן
    $_SESSION['user_id'] = $row['id'];
    $_SESSION['user_name'] = $row['user_name'];
    $_SESSION['user_email'] = $row['user_email'];
    $_SESSION['user_role'] = $row['role'];
  }
}
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 2 | Log in</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/iCheck/square/blue.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  <script src="https://common.olemiss.edu/_js/sweet-alert/sweet-alert.min.js"></script>
  <link rel="stylesheet" type="text/css" href="https://common.olemiss.edu/_js/sweet-alert/sweet-alert.css">
</head>

<body class="hold-transition login-page">
  <div class="login-box">
    <div class="login-logo">
      <a href="index.php"><b>INVENTORY</b>POS</a>
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body">
      <p class="login-box-msg">Sign in to start your session</p>

      <form method="post">
        <div class="form-group has-feedback">
          <input type="email" value="yaron@gmail.com" name="txt_email" class="form-control" placeholder="Email" required>
          <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
        </div>
        <div class="form-group has-feedback">
          <input type="password" value="123456" name="txt_password" class="form-control" placeholder="Password" required>
          <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        </div>
        <div class="row">
          <div class="col-xs-8">
            <a href="#">I forgot my password</a><br>
          </div>
          <div class="col-xs-4">
            <button type="submit" name="btn_login" class="btn btn-primary btn-block btn-flat">Login</button>
          </div>
        </div>
      </form>
    </div>
    <!-- /.login-box-body -->
  </div>
  <!-- /.login-box -->

  <!-- jQuery 3 -->
  <script src="bower_components/jquery/dist/jquery.min.js"></script>
  <!-- Bootstrap 3.3.7 -->
  <script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
  <!-- iCheck -->
  <script src="plugins/iCheck/icheck.min.js"></script>

  <script>
    $(function() {
      $('input').iCheck({
        checkboxClass: 'icheckbox_square-blue',
        radioClass: 'iradio_square-blue',
        increaseArea: '20%' /* optional */
      });
    });
  </script>
</body>

</html>