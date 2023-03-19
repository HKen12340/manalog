<?php
require '../dbconnect.php';

$uesr_id = $_POST['id'];
$answer_delete = 'delete from answer where user_id = ?';
$user_delete = 'delete from user_info where id = ?';

$stmt = $pdo->prepare($answer_delete);
$stmt->execute(array($uesr_id));

$stmt = $pdo->prepare($user_delete);
$stmt->execute(array($uesr_id));

header("location:user_list.php");