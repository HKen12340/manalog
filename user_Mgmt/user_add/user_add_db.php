<?php
require '../../dbconnect.php';
require '../../check.php';
CheckAuthority();

$user_name = h($_POST['name']);
$user_class = h($_POST['class']);
$user_number = h($_POST['number']);
$user_email = h($_POST['email']);
$user_password = h($_POST['password']);
$authority = h($_POST['authority']);

if($pdo == null){
  print("接続に失敗しました");
}else{
    isUniqueValue($pdo, $user_email, $user_number, $user_class);

    $sql = 'insert into user_info (name,class,number,email,password,authority)
    VALUES(:name,:class,:number,:email,:password,:authority)';
    $stmt = $pdo->prepare($sql);

    $stmt->bindValue(':name',$user_name);
    $stmt->bindValue(':class',$user_class);
    $stmt->bindValue(':number',$user_number);
    $stmt->bindValue(':email',$user_email);
    $stmt->bindValue(':password',password_hash($user_password, PASSWORD_DEFAULT));
    $stmt->bindValue(':authority',$authority);

    $stmt->execute();
    header('location:../user_list.php');
}
