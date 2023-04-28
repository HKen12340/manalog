<?php
try{
$dsn = 'mysql:host=localhost;dbname=manalog';
$user = 'root';
$pdo = new PDO($dsn,$user,'');
$pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
$pdo->query('SET NAMES utf8');
}catch(PDOException $e){
  echo "データベースに接続できません";
}

function h($n){
  return htmlspecialchars($n);
}
?>
