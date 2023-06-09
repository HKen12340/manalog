<?php
  require('../../dbconnect.php');
  require '../../check.php';
  CheckAuthority();
  $user_name = h($_POST['name']);
  $user_class = h($_POST['class']);
  $user_number = h($_POST['number']);
  $user_email = h($_POST['email']);
  $user_password = h($_POST['password']);
  $user_id = h($_POST['id']);

  isUnique_update_Value($pdo,$user_id,$user_email, $user_number, $user_class);
  
  $sql = 'update user_info set name = :name,class = :class,number = :number,
  email = :email,password = :password where id = :id';
  $stmt = $pdo->prepare($sql);

  $stmt->bindValue(':name',$user_name);
  $stmt->bindValue(':class',$user_class);
  $stmt->bindValue(':number',$user_number);
  $stmt->bindValue(':email',$user_email);
  $stmt->bindValue(':password',password_hash($user_password,PASSWORD_DEFAULT));
  $stmt->bindValue(':id',$user_id);

  $stmt->execute();
  
  $result = $stmt->fetch(PDO::FETCH_ASSOC);
  header('location:../user_list.php');
?>