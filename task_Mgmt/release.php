<?php
require '../dbconnect.php';

$task_release = 0;
if($_POST['task_release'] == 0){
  $task_release = 1;
}

$sql = 'update task set task_release = ? 
 WHERE id = ?';
$stmt = $pdo->prepare($sql);
$stmt->execute(array($task_release,$_POST['task_id']));
header('location: task_list.php');