<head>
  <link rel="stylesheet" href="../../css/style.css">
</head>

<?php
require '../../dbconnect.php';
session_start();
require '../../check.php';
require '../../simple_header.php';

$ans_select = 'select * from ((answer a RIGHT OUTER join question q ON 
a.task_id = q.TaskId  and a.number = q.number) RIGHT OUTER JOIN task t ON t.id = q.TaskId)
WHERE user_id = :user_id and time_stamp IN(SELECT MAX(time_stamp) FROM `answer` WHERE 
user_id = :ans_user_id GROUP BY task_id)  
AND task_id = :task_id';

$ans_stmt = $pdo->prepare($ans_select);
$ans_stmt->bindValue(':user_id',$_POST['user_id']);
$ans_stmt->bindValue(':task_id',$_POST['task_id']);
$ans_stmt->bindValue(':ans_user_id',$_POST['user_id']);
$ans_stmt->execute();

$question_num = 1;
$max_point = 0;
$total_point = 0;
?>

<div class="score_table">
<table >
  <tr>
      <th>番号</th>
      <th>問題文</th>
      <th>正否</th>
      <th>正解</th>
      <th>解答</th>
  </tr>
<?php
while($result = $ans_stmt->fetch(PDO::FETCH_ASSOC)):
  ?>
  <tr>
<?php
  $point = 0;
  $number = $result['number'];
  $max_point += $result['point'];
?>
<td>
<?php echo $question_num; ?>
</td>
<td>
  <?php echo $result['sentence']; ?>
</td>
<td>

  <?php 
    if($result['user_anwser'] == $result['answer']):
      print('〇');
      $point = $result['point'];
      $total_point += $point;
    else:
      print('✕');
    endif;
  ?>
</td>

  <?php
  //正解と自分の解答を表示
  if($result['type'] == 'select'):
    $a = explode(',',$result['choice']);
    echo "<td>".$a[$result['answer'] - 1]."</td>";
    echo "<td>".$a[$result['user_anwser'] - 1]."</td>";
  elseif($result['type'] == 'writing'):
    echo "<td>".$result['answer']."</td>";
    echo "<td>".$result['user_anwser']."</td>";
  endif;
  ?>  
  </tr>
  <?php
   $question_num++;
   endwhile;

   echo "<p style = 'text-align:center'>".$max_point."/".$total_point."点</p>";
  ?>
</table>
<a href="score_history.php">戻る</a>
</div>