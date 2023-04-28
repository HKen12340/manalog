<?php
require '../../dbconnect.php';
require '../../check.php';

$task_id = h($_POST['task_id']);
$number = h($_POST['number']);
$picture_select = "select * from question_image where task_id = :task_id and number =:number";

$task_update = 'update task set quantity = quantity - 1 where id = :id';

$QItme_delete = 'delete from question where TaskId = :task_id1 and number = :number1;
delete from question_image where task_id = :task_id2 and number = :number2';

$stmt = $pdo->prepare($picture_select);
$stmt->bindValue(':task_id',$task_id);
$stmt->bindValue(':number',$number);
$stmt->execute();
$result = $stmt->fetch(PDO::FETCH_ASSOC);
unlink("uploads/".$result['file_name']);

$stmt = $pdo->prepare($task_update);
$stmt->bindValue(':id',$task_id);
$stmt->execute();

$stmt = $pdo->prepare($QItme_delete);

$stmt->bindValue(':task_id1',$task_id);
$stmt->bindValue(':number1',$number);
$stmt->bindValue(':task_id2',$task_id);
$stmt->bindValue(':number2',$number);

$stmt->execute();
header("location:question_add.php?task_id=".$task_id);