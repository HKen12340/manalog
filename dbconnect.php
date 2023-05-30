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

    if(!empty($result['email']) || !empty($result['number'])){
      echo "パスワードかメールアドレスが重複しています";
      exit();
    }
  }catch(PDOException $e){
    echo 'パスワードかメールアドレスが重複しています';
  }
}

function isUnique_update_Value($pdo,$id,$email,$number,$class){
  try{
    $select_sql = 'select email,number from user_info where 
    (email = :email and id != :id1) or (class = :class and number = :number and id != :id2)';
    $stmt = $pdo->prepare($select_sql);
    $stmt->bindValue(':email',$email);
    $stmt->bindValue(':id1',$id);
    $stmt->bindValue(':number',$number);
    $stmt->bindValue(':class',$class);
    $stmt->bindValue(':id2',$id);
    
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if(!empty($result['email'])){
      echo "入力されたメールアドレスもしくは出席番号は既に使用されています";
      exit();
    }

    if((!empty($result['class']) && !empty($result['number']))){
      echo "入力されたメールアドレスもしくは出席番号は既に使用されています";
      exit();
    }
  }catch(PDOException $e){
    echo 'エラーが発生しました。管理者にお問合せ下さい。';
  }

}


?>
