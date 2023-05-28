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

function isUniqueValue($pdo,$email,$number,$class){
  try{
    $select_sql = 'select email,number from user_info where email = :email or
    (class = :class and number = :number)';
    $stmt = $pdo->prepare($select_sql);
    $stmt->bindValue(':email',$email);
    $stmt->bindValue(':number',$number);
    $stmt->bindValue(':class',$class);
    
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
  }catch(PDOException $e){
    echo 'エラーが発生しました。管理者にお問合せ下さい。';
  }
  if(!empty($result['email']) || !empty($result['number'])){
    echo "値が重複しています";
    exit();
  }
}

?>
