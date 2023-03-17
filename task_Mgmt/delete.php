<?php
require '../dbconnect.php';

$task_id = $_GET['task_id'];
$question_delete = 'delete from question where TaskId = ?';
$task_delete = 'delete from task where id = ?';

$stmt = $pdo->prepare($question_delete);
$stmt->execute(array($_GET['task_id']));

$stmt = $pdo->prepare($task_delete);
$stmt->execute(array($task_id));

header("location:task_list.php");