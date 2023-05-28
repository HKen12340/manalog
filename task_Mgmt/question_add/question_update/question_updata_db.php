<?php
require '../../../dbconnect.php';
require '../../../check.php';
CheckAuthority();

$sentence = h($_POST['sentence']);
$answer = h($_POST['answer']);
$point = h($_POST['point']);
$TaskId = h($_POST['task_id']);
$number = h($_POST['number']);

$sql = 'update question set sentence = :sentence,choice=:choice,answer = :answer,point = :point
 WHERE TaskId = :TaskId and number = :number';
$stmt = $pdo->prepare($sql);

if(h($_POST['type'])=='select'){
  $select_csv = implode(',',$_POST['select']);
  $stmt->bindValue(':choice',$select_csv);
}else{
  $stmt->bindValue(':choice',null);
}

$stmt->bindValue(':sentence',$sentence);
$stmt->bindValue(':answer',$answer);
$stmt->bindValue(':point',$point);
$stmt->bindValue(':answer',$answer);
$stmt->bindValue(':TaskId',$TaskId);
$stmt->bindValue(':number',$number);
$stmt->execute();

header('location: ../question_add.php?task_id='.$TaskId);
