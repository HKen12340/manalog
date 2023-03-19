<?php
  require('../../dbconnect.php');
  $user_id = $_POST['id'];
  $user_name = $_POST['name'];
  $user_class = $_POST['class'];
  $user_number = $_POST['number'];
  $user_email = $_POST['email'];
  $user_password = $_POST['password'];
  $sql = 'update user_info set name = ?,class = ?,number = ?,email = ?,password = ? where id = ?';
  $stmt = $pdo->prepare($sql);

  $stmt->execute(array($user_name,$user_class,$user_number,
  $user_email,$user_password,$user_id));
  
  $result = $stmt->fetch(PDO::FETCH_ASSOC);
  header('location:../user_list.php');
?>