<head>
  <link rel="stylesheet" href="../../css/style.css">
</head>
<?php

error_reporting(0);
require '../../dbconnect.php';
require '../../check.php';
require '../../simple_header.php';
session_start();
$ans_select = 'select * from ((answer a RIGHT OUTER join question q ON 
a.task_id = q.TaskId  and a.number = q.number) RIGHT OUTER JOIN task t ON t.id = q.TaskId)
WHERE user_id = :user_id and time_stamp IN(SELECT MAX(time_stamp) FROM `answer` WHERE user_id = :ans_user_id GROUP BY task_id)  
AND task_id = :task_id';

$ans_stmt = $pdo->prepare($ans_select);
$ans_stmt->bindValue(':user_id',$_SESSION['id']);
$ans_stmt->bindValue(':task_id',$_POST['task_id']);
$ans_stmt->bindValue(':ans_user_id',$_SESSION['id']);
$ans_stmt->execute();

$question_num = 1;
$max_point = 0;
$total_point = 0;

while($result = $ans_stmt->fetch(PDO::FETCH_ASSOC)){
  echo "<div class='content_list'>";
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

  //正解と自分の解答を表示
  if($result['type'] == 'select'){
    $a = explode(',',$result['choice']);
    echo $a[$result['answer'] - 1];
    echo $a[$result['user_anwser'] - 1];
  }else if($result['type'] == 'writing'){
    echo $result['answer'];
    echo $result['user_anwser'];
  }

  echo "</div>";
  print('<hr>');
  print('<br>');

    $question_num++;
}
echo "<div class='content_list'>";
echo $max_point."/".$total_point."点";
echo "</div>";

?>
</script>