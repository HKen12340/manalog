<?php

if(session_status() == PHP_SESSION_NONE){ //セッションを開始いるか確認
  session_start();
}

if(empty($_SESSION['name']) || empty($_SESSION['id']) || empty($_SESSION['email'])){
  header('location:/manalog/login.view.php');
}

if (!function_exists('CheckAuthority')) { // 関数`f`が定義されているかどうか
  if(session_status() == PHP_SESSION_NONE){ //セッションを開始いるか確認
    session_start();
  }
  function CheckAuthority()
  {
    if($_SESSION['authority'] != 'T'){
      header('location:http://localhost/manalog/index.php');
      exit();
    }
  }
}
?>