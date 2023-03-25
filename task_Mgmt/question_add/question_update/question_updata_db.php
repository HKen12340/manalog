<?php
require '../../../dbconnect.php';

$sql = 'update question set sentence = ?,answer = ?,point = ?
 WHERE TaskId = ? and number = ?';
$stmt = $pdo->prepare($sql);
$stmt->execute(array($_POST['sentence'],$_POST['answer'],$_POST['point'],
$_POST['task_id'],$_POST['number']));
header('location: ../../task_list.php?task_id='.$_POST['task_id']);
