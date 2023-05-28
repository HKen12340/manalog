<?php
session_start();
require 'dbconnect.php';

$sql = 'select * from user_info where email = :email';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':email',$_POST['email']);
$stmt->execute();

$result = $stmt->fetch(PDO::FETCH_ASSOC);

if(password_verify($_POST['password'],$result['password'])){    
  
    $_SESSION['id'] = $result['id'];
    $_SESSION['name'] = $result['name'];
    $_SESSION['class'] = $result['class'];
    $_SESSION['number'] = $result['number'];
    $_SESSION['email'] = $result['email'];
    $_SESSION['authority'] = $result['authority'];
    if(!empty($_POST['check'])){
      setcookie('email',$_POST['email'],time() + (60 * 60 * 24) * 7);
      setcookie('password',$_POST['password'],time() + (60 * 60 * 24) * 7);
      setcookie('login_keep','true',time() + (60 * 60 * 24) * 7);
    }else{
      setcookie('email','',time()-30);
      setcookie('password','',time()-30);
      setcookie('login_keep','',time()-30);
    }
      header('Location:index.php');
      exit();
}else{
     header('Location:login.view.php');
}
