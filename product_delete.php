<?php include "db_connect.php"; ?>
<?php
$id = $_POST['idToDelete'];
$query = $pdo->prepare("DELETE FROM tbl_product WHERE p_id = '$id'");
if ($query->execute()) {
} else {
  exit("Error");
}
?>
<?php include_once "footer.php"; ?>