<?php
require '../../dbconnect.php';

$test_name = $_POST['name'];
$class = $_POST['class'];
$startDay = $_POST['startDay'];
$endDay = $_POST['endDay'];
$answer_limit = $_POST['answer_limit'];
$back_color = $_POST['back_color'];

if($pdo == null){
  print("接続に失敗しました");
}else{
  $sql = 'insert into task (task_name,quantity,class,task_release,startDay,endDay,answer_limit,back_color)
  VALUES(?,?,?,false,?,?,?,?)';
  $stmt = $pdo->prepare($sql);
  $flag = $stmt->execute(array($test_name,0,$class,$startDay,$endDay,$answer_limit,$back_color));
  header('location: ../task_list.php');
}
