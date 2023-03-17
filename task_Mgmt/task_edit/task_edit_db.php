<?php
require '../../dbconnect.php';

$test_name = $_POST['name'];
$class = $_POST['class'];
$startDay = $_POST['startDay'];
$endDay = $_POST['endDay'];

echo $startDay;
echo $endDay;
if($pdo == null){
  print("接続に失敗しました");
}else{
  $sql = 'insert into task (task_name,quantity,class,task_release,startDay,endDay
  )
  VALUES(?,?,?,false,?,?)';
  $stmt = $pdo->prepare($sql);
  $flag = $stmt->execute(array($test_name,0,$class,$startDay,$endDay));
  header('location: ../task_list.php');
}
