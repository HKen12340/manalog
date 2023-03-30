<?php
require '../../../dbconnect.php';

$sql = 'select * from question WHERE TaskId = ? and number = ?';
$stmt = $pdo->prepare($sql);
$stmt->execute(array($_POST['task_id'],$_POST['number']));
$result = $stmt->fetch(PDO::FETCH_ASSOC);

require 'question_update.view.php';
?>