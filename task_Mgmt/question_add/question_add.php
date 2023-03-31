<?php
require '../../dbconnect.php';

$task_id = h($_GET['task_id']);
if(isset($task_id)&& !preg_match('/[^0-9]/',$task_id)){

$sql = 'select * from task WHERE id = :task_id';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':task_id',$task_id);
$stmt->execute();

$result = $stmt->fetch(PDO::FETCH_ASSOC);

$sql2 = 'select * FROM question a left outer join question_image b
on a.TaskId = b.task_id and a.number = b.number WHERE a.TaskId = :TaskId';
  $stmt2 = $pdo->prepare($sql2);
  $stmt2->bindValue(':TaskId',$task_id);
  $stmt2->execute();

  $question_num = 1;
  require 'question_add.view.php';  
}else{
  echo "不正な値が入力されました";
}
?>
