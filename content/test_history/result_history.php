<?php

/*
select * from ((answer a RIGHT OUTER join question q ON 
a.task_id = q.TaskId  and a.number = q.number) RIGHT OUTER JOIN task t ON t.id = q.TaskId)
WHERE user_id = 4 and time_stamp IN(SELECT MAX(time_stamp) FROM `answer` GROUP BY task_id)  AND task_id = 23
*/


error_reporting(0);
require '../dbconnect.php';
session_start();
$ans_select = 'select DISTINCT task_id,user_id,answer_count from answer 
where task_id = :task_id and user_id = :user_id';
$ans_stmt = $pdo->prepare($ans_select);
$ans_stmt->bindValue(':task_id',$_POST['task_id']);
$ans_stmt->bindValue(':user_id',$_SESSION['id']);
$ans_stmt->execute(array($_POST['task_id'],$_SESSION['id']));
$flag_result = $ans_stmt->fetch(PDO::FETCH_ASSOC);

$select_sql = 'select * from question WHERE TaskId = ?';
$stmt = $pdo->prepare($select_sql);
$stmt->execute(array($_POST['task_id']));

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

    $question_num++;
}


echo $max_point."/".$total_point."点";
?>
<button id = "top_button">トップメニューへ戻る</button>
<script>
  document.getElementById("top_button").addEventListener('click',function(){
    location.href = "../index.php";
  },false)
</script>