<?php
require '../../dbconnect.php';

$user_name = $_POST['name'];
$user_class = $_POST['class'];
$user_number = $_POST['number'];
$user_email = $_POST['email'];
$user_password = $_POST['password'];
$authority = $_POST['authority'];

if($pdo == null){
  print("接続に失敗しました");
}else{  
  $sql = 'insert into user_info (name,class,number,email,password,authority)
  VALUES(?,?,?,?,?,?)';
  $stmt = $pdo->prepare($sql);
  $flag = $stmt->execute(array($user_name,$user_class,
  $user_number,$user_email,$user_password,$authority));
  header('location:../user_list.php');
}
