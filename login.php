<?php
session_start();
require 'dbconnect.php';

$sql = 'select * from user_info';
$stmt = $pdo->prepare($sql);
$stmt->execute();

while($result = $stmt->fetch(PDO::FETCH_ASSOC)){
  if($result['email'] == h($_POST['email']) && $result['password'] == h($_POST['password'])){
    $_SESSION['id'] = $result['id'];
    $_SESSION['name'] = $result['name'];
    $_SESSION['class'] = $result['class'];
    $_SESSION['number'] = $result['number'];
    $_SESSION['email'] = $result['email'];
    $_SESSION['authority'] = $result['authority'];
    header('Location:index.php');
    exit();
  }
}
header('Location:login.view.php');