<?php
require '../../dbconnect.php';

$sql = 'select * from task WHERE id = ?';
$stmt = $pdo->prepare($sql);
$stmt->execute(array($_GET['task_id']));

$result = $stmt->fetch(PDO::FETCH_ASSOC);
$task_id = $_GET['task_id'];

$sql2 = 'select * FROM question a left outer join question_image b
on a.TaskId = b.task_id and a.number = b.number WHERE a.TaskId = ?';
  $stmt2 = $pdo->prepare($sql2);
  $stmt2->execute(array($_GET['task_id']));

  $question_num = 1;
  require 'question_add.view.php';  
?>
