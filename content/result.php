<?php
require '../dbconnect.php';
session_start();
$select_sql = 'select DISTINCT task_id,user_id,answer_count from answer 
where task_id = ? and user_id = ?';
$stmt = $pdo->prepare($select_sql);

$stmt->execute(array($_POST['task_id'],$_SESSION['id']));
$result = $stmt->fetch(PDO::FETCH_ASSOC);

$flag = 'insert';
 if(!empty($result['user_id'])){
    $flag = 'update';
 }

 $answer_count = $result['answer_count'];

$select_sql = 'select * from question WHERE TaskId = ?';
$stmt = $pdo->prepare($select_sql);
$stmt->execute(array($_POST['task_id']));

$insert_sql = 'insert into answer(task_id,number,user_anwser,user_id,answer_count) VALUES';
$insert_args = [];

$update_sql = 'update `answer` SET `user_anwser` = case `number`';
$update_args = [];

$question_num = 1;
while($result = $stmt->fetch(PDO::FETCH_ASSOC)){
  $number = $result['number'];
  $description = $result['sentence'];
  echo $question_num.".";
  if($flag == "insert"){
    $args = [$_POST['task_id'],$number,$_POST['question'.$number],$_SESSION['id'],1];
    $insert_args = array_merge($insert_args,$args);
    $insert_sql .= '(?,?,?,?,?),';
  }else if($flag == "update"){
    $update_sql .= 'when ? then ? ';
    $args = [$number,$_POST['question'.$number]];
    $update_args = array_merge($update_args,$args);
  }

  if($_POST['question'.$number] == $result['answer']){
    print('〇');
  }else{
    print('✕');
  }
  print('<hr>');
  print('<br>');
  $question_num++;
}

if($flag == 'insert'){
  $insert_sql = substr($insert_sql,0,-1);
  $insert_sql .= ';';
  $stmt = $pdo->prepare($insert_sql);
  $stmt->execute($insert_args);
}else if($flag == 'update'){
  $update_sql .= 'end where task_id = ? and user_id = ?';
  $args = [$_POST['task_id'],$_SESSION['id']];
  $update_args = array_merge($update_args,$args);
  $stmt = $pdo->prepare($update_sql);
  $stmt->execute($update_args);
}
?>
<button id = "top_button">トップメニューへ戻る</button>
<script>
  document.getElementById("top_button").addEventListener('click',function(){
    location.href = "../index.php";
  },false)
</script>