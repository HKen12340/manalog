<?php
if(session_status() == PHP_SESSION_NONE){ //セッションを開始いるか確認
  session_start();
}

if(empty($_SESSION['name']) || empty($_SESSION['id']) || empty($_SESSION['email'])){
  header('location:/manalog/login.view.php');
}