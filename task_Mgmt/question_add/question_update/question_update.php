<?php
require '../../../dbconnect.php';

$task_id = h($_POST['task_id']);
$number = h($_POST['number']);

$sql = 'select * from question WHERE TaskId = :TaskId and number = :number';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':TaskId',$task_id);
$stmt->bindValue(':number',$number);
$stmt->execute();
$result = $stmt->fetch(PDO::FETCH_ASSOC);

require 'question_update.view.php';
?>