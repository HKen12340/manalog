<?php
require '../dbconnect.php';

$uesr_id = h($_POST['id']);
$delete_sql = 'delete from answer where user_id = :user_id;
delete from user_info where id = :id';

$stmt = $pdo->prepare($delete_sql);
$stmt->bindValue(':user_id',$uesr_id);
$stmt->bindValue(':id',$uesr_id);
$stmt->execute();

header("location:user_list.php");