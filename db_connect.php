<?php

try {
  $pdo = new PDO("mysql:host=localhost;dbname=pos_db", "root", "");
} catch (PDOException $error) {
  echo $error->getMessage();
}
