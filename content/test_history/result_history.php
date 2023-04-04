<?php

/*
select * from ((answer a RIGHT OUTER join question q ON 
a.task_id = q.TaskId  and a.number = q.number) RIGHT OUTER JOIN task t ON t.id = q.TaskId)
WHERE user_id = 4 and time_stamp IN(SELECT MAX(time_stamp) FROM `answer` GROUP BY task_id)  AND task_id = 23
*/


//error_reporting(0);
require '../../dbconnect.php';
session_start();
$ans_select = 'select * from ((answer a RIGHT OUTER join question q ON 
a.task_id = q.TaskId  and a.number = q.number) RIGHT OUTER JOIN task t ON t.id = q.TaskId)
WHERE user_id = :user_id and time_stamp IN(SELECT MAX(time_stamp) FROM `answer` GROUP BY task_id)  
AND task_id = :task_id';


$ans_stmt = $pdo->prepare($ans_select);
$ans_stmt->bindValue(':user_id',$_POST['user_id']);
$ans_stmt->bindValue(':task_id',$_POST['task_id']);
$ans_stmt->execute();

// $select_sql = 'select * from question WHERE TaskId = ?';
// $stmt = $pdo->prepare($select_sql);
// $stmt->execute(array($_POST['task_id']));

$question_num = 1;
$max_point = 0;
$total_point = 0;
while($result = $ans_stmt->fetch(PDO::FETCH_ASSOC)){
  $point = 0;
  $number = $result['number'];
  $description = $result['sentence'];
  $max_point += $result['point'];
  echo $question_num.".";

  if($result['user_anwser'] == $result['answer']){
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
