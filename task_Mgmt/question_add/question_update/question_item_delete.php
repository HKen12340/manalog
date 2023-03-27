<?php
require '../../../dbconnect.php';

$task_id = $_POST['task_id'];
$number = $_POST['number'];
$task_update = 'update task set quantity = quantity - 1 where id = ?';
$QItme_delete = 'delete from question where TaskId = ? and number = ?;
delete from question_image where task_id = ? and number = ?';


$stmt = $pdo->prepare($task_update);
$stmt->execute(array($task_id));

$stmt = $pdo->prepare($QItme_delete);
$stmt->execute(array($task_id,$number,$task_id,$number));
header("location:../question_add.php?task_id=".$task_id);