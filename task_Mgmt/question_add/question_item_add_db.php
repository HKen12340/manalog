<?php 
require '../../dbconnect.php';

$task_id =  $_POST['task_id'];
$description =$_POST['description'];
$question_type = $_POST['question_type'];
$question_point = $_POST['point'];

$sql = 'select quantity from task WHERE id = ?';
$stmt = $pdo->prepare($sql);
$stmt->execute(array($task_id));
$result = $stmt->fetch(PDO::FETCH_ASSOC);
$number = $result["quantity"] + 1;
$fileName = '';

if($_FILES["file"]["tmp_name"] != null){ //ファイルがアップされているか?
  $targetDir = "uploads/";
  $allowTypes = array('jpg','png','jpeg','gif','pdf');

  $targetFilePath= $targetDir . $task_id."_".$number.".".substr($_FILES['file']['type'],6);
  $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);

  if(in_array($fileType,$allowTypes)){//拡張子チェック
    $fileName = $task_id."_".$number.".".substr($_FILES['file']['type'],6);//拡張子取得
    move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath);//ファイルアップロード
  }else{
    //保留
  }
}
$sql = 'update task set quantity = :number WHERE id = :task_id';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':number',$number);
$stmt->bindValue('task_id',$task_id);
$stmt->execute();

if($question_type == 'select'){ //選択問題DB登録
  $radio_select = $_POST['radio_select'];
  $select_csv = implode(',',$_POST['name']);
  $sql = 'insert into question (number,TaskId,type,sentence,choice,answer,point) 
          VALUES(:number,:TaskId,:type,:sentence,:choice,:answer,:point);
  insert into question_image (task_id,number,file_Name) VALUES(:task_id,:number2,:file_Name);';

  $stmt = $pdo->prepare($sql);

  $stmt->bindValue(':number',$number);
  $stmt->bindValue(':TaskId',$task_id);
  $stmt->bindValue(':type',$question_type);
  $stmt->bindValue(':sentence',$description);
  $stmt->bindValue(':choice',$select_csv);
  $stmt->bindValue(':answer',$radio_select);
  $stmt->bindValue(':point',$question_point);

  $stmt->bindValue(':task_id',$task_id);
  $stmt->bindValue(':number2',$number);
  $stmt->bindValue(':file_Name',$fileName);
  $stmt->execute();
  
}else if($question_type == 'writing'){ //記述問題DB登録
  $answer = $_POST['answer'];

  $sql = 'insert into question (number,TaskId,type,sentence,answer,point)
  VALUES(:number,:TaskId,:type,:sentence,:answer,:point);
  insert into question_image (task_id,number,file_name) VALUES(:task_id,:number2,:file_name);';
  $stmt = $pdo->prepare($sql);

  $stmt->bindValue(':number',$number);
  $stmt->bindValue(':TaskId',$task_id);
  $stmt->bindValue(':type',$question_type);
  $stmt->bindValue(':sentence',$description);
  $stmt->bindValue(':answer',$answer);
  $stmt->bindValue(':point',$question_point);

  $stmt->bindValue(':task_id',$task_id);
  $stmt->bindValue(':number2',$number);
  $stmt->bindValue(':file_name',$fileName);
  
  $stmt->execute();
}

header('location: question_add.php?task_id='.$task_id);