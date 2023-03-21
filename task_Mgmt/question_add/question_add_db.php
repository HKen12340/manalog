<?php 
require '../../dbconnect.php';

$task_id =  $_POST['task_id'];
$description =$_POST['description'];
$question_type = $_POST['question_type'];


$targetDir = "uploads/";

$fileName = basename($_FILES["file"]["name"]);
$targetFilePath= $targetDir . $fileName;
$fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);

$sql = 'select quantity from task WHERE id = ?';
$stmt = $pdo->prepare($sql);
$stmt->execute(array($task_id));
$result = $stmt->fetch(PDO::FETCH_ASSOC);
$number = $result["quantity"] + 1;

$sql = 'update task set quantity = ? WHERE id = ?';
$stmt = $pdo->prepare($sql);
$stmt->execute(array($number,$task_id));

if($question_type == 'select'){
  $radio_select = $_POST['radio_select'];
  $select_csv = implode(',',$_POST['name']);
  $sql = 'insert into question (number,TaskId,type,sentence,choice,answer) VALUES(?,?,?,?,?,?);
  insert into question_image (task_id,number,file_name) VALUES(?,?,?);
  ';

  $stmt = $pdo->prepare($sql);
  $stmt->execute(array($number,$task_id,$question_type,$description,$select_csv,$radio_select,
  $task_id,$number,$fileName));
  
  move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath);
}else if($question_type == 'writing'){
  $answer = $_POST['answer'];
  $sql = 'insert into question (number,TaskId,type,sentence,answer)
  VALUES(?,?,?,?,?)';

  $stmt = $pdo->prepare($sql);
  $stmt->execute(array($number,$task_id,$question_type,$description,$answer));
}

header('location: question_add.php?task_id='.$task_id);