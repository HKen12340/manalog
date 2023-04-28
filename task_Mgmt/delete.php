<?php
require '../dbconnect.php';
require '../check.php';

$task_id = h($_GET['task_id']);

$picture_select = "select * from question_image where task_id = :task_id";

$stmt = $pdo->prepare($picture_select);
$stmt->bindValue(':task_id',$task_id);
$stmt->execute();
while($result = $stmt->fetch(PDO::FETCH_ASSOC)){
  unlink("question_add/uploads/".$result['file_name']);
}

$task_delete = 'delete from question where TaskId = :task_id1;
delete from question_image where task_id = :task_id2;
delete from task where id = :task_id3';

$stmt = $pdo->prepare($task_delete);

$stmt->bindValue(':task_id1',$task_id);
$stmt->bindValue(':task_id2',$task_id);
$stmt->bindValue(':task_id3',$task_id);

$stmt->execute();

header("location:task_list.php");