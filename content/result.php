<?php
error_reporting(0);
require '../dbconnect.php';
session_start();
$ans_select = 'select DISTINCT task_id,user_id,answer_count from answer 
where task_id = ? and user_id = ?';
$ans_stmt = $pdo->prepare($ans_select);

$ans_stmt->execute(array($_POST['task_id'],$_SESSION['id']));
$flag_result = $ans_stmt->fetch(PDO::FETCH_ASSOC);


 $answer_count = $flag_result['answer_count'];

$select_sql = 'select * from question WHERE TaskId = ?';
$stmt = $pdo->prepare($select_sql);
$stmt->execute(array($_POST['task_id']));

$insert_sql = 'insert into answer(task_id,number,user_anwser,
user_id,answer_count,point) VALUES';
$insert_args = [];


$question_num = 1;

$max_point = 0;
$total_point = 0;
while($result = $stmt->fetch(PDO::FETCH_ASSOC)){
  $point = 0;
  $number = $result['number'];
  $description = $result['sentence'];
  $max_point += $result['point'];

  echo $question_num.".";

  if($_POST['question'.$number] == $result['answer']){
    print('〇');
    $point = $result['point'];
    $total_point += $point;
  }else{
    print('✕');
  }
  print('<hr>');
  print('<br>');

    $args = [$_POST['task_id'],$number,$_POST['question'.$number],$_SESSION['id'],1,$point];
    $insert_args = array_merge($insert_args,$args);
    $insert_sql .= '(?,?,?,?,?,?),';

    $question_num++;
}

  $insert_sql = substr($insert_sql,0,-1);
  $insert_sql .= ';';
  $stmt = $pdo->prepare($insert_sql);
  $stmt->execute($insert_args);

echo $max_point."/".$total_point."点";
?>
<button id = "top_button">トップメニューへ戻る</button>
<script>
  document.getElementById("top_button").addEventListener('click',function(){
    location.href = "../index.php";
  },false)
</script>