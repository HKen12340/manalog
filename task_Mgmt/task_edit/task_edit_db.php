<?php
require '../../dbconnect.php';
require '../../check.php';
CheckAuthority();

$test_name = h($_POST['name']);
$class = h($_POST['class']);
$startDay = h($_POST['startDay']);
$endDay = h($_POST['endDay']);
$answer_limit = h($_POST['answer_limit']);
$back_color = h($_POST['back_color']);

if($pdo == null){
  print("接続に失敗しました");
}else{
  $sql = 'insert into task (task_name,quantity,class,task_release,startDay,endDay,answer_limit,back_color)
  VALUES(:testname,:quantity,:class,false,:startDay,:endDay,:answer_limit,:back_color)';
  $stmt = $pdo->prepare($sql);
  
  $stmt->bindValue(':testname',$test_name);
  $stmt->bindValue(':quantity',0,PDO::PARAM_INT);
  $stmt->bindValue(':class',$class);
  $stmt->bindValue(':startDay',$startDay);
  $stmt->bindValue(':endDay',$endDay);
  $stmt->bindValue(':answer_limit',$answer_limit);
  $stmt->bindValue(':back_color',$back_color);

  $flag = $stmt->execute();
  header('location: ../task_list.php');
}
