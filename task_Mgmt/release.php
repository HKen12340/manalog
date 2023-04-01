<?php
require '../dbconnect.php';

$task_release = 0;
if($_POST['task_release'] == 0){
  $task_release = 1;
}

$sql = 'update task set task_release = :task_release  WHERE id = :id';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':task_release',$task_release);
$stmt->bindValue(':id',$_POST['task_id']);
$stmt->execute();

header('location: task_list.php');