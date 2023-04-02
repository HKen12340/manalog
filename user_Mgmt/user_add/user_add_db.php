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
  VALUES(:name,:class,:number,:email,:password,:authority)';
  $stmt = $pdo->prepare($sql);

  $stmt->bindValue(':name',$user_name);
  $stmt->bindValue(':class',$user_class);
  $stmt->bindValue(':number',$user_number);
  $stmt->bindValue(':email',$user_email);
  $stmt->bindValue(':password',$user_password);
  $stmt->bindValue(':authority',$authority);

  $stmt->execute();
  header('location:../user_list.php');
}
