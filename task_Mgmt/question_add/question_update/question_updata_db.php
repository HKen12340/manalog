<?php
require '../../../dbconnect.php';

$sql = 'update question set sentence = ?,choice=?,answer = ?,point = ?
 WHERE TaskId = ? and number = ?';
$stmt = $pdo->prepare($sql);

$select_csv = implode(',',$_POST['select']);
$stmt->execute(array($_POST['sentence'],$select_csv,$_POST['answer'],$_POST['point'],
$_POST['task_id'],$_POST['number']));

header('location: ../../task_list.php?task_id='.$_POST['task_id']);
