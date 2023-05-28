<head>
  <link rel="stylesheet" href="../css/style.css">
</head>
<?php
error_reporting(0);
require '../dbconnect.php';
require '../check.php';
require '../simple_header.php';

session_start();

//SQL関連
$ans_select = 'select DISTINCT task_id,user_id,answer_count,answer,choice,type,sentence
from answer a LEFT OUTER JOIN question b on a.task_id = b.TaskId
where task_id = :task_id and user_id = :user_id';
$ans_stmt = $pdo->prepare($ans_select);
$ans_stmt->bindValue(':task_id',$_POST['task_id']);
$ans_stmt->bindValue(':user_id',$_SESSION['id']);

$ans_stmt->execute();
$flag_result = $ans_stmt->fetch(PDO::FETCH_ASSOC);

 $answer_count = $flag_result['answer_count'];

$select_sql = 'select * from question WHERE TaskId = :TaskId';
$stmt = $pdo->prepare($select_sql);
$stmt->bindValue(':TaskId',$_POST['task_id']);
$stmt->execute();

$insert_sql = 'insert into answer(task_id,number,user_anwser,
user_id,answer_count,point) VALUES';

$q_num = 1;

$max_point = 0;
$total_point = 0;

$question_counter = 0;
?>
<div class="score_table">
<table>
  <tr>
    <th>番号</th>
    <th>問題文</th>
    <th>判定</th>
    <th>正解</th>
    <th>解答</th>
  </tr>
<?php
while($result = $stmt->fetch(PDO::FETCH_ASSOC)){
  echo "<tr>";
  $point = 0;
  $number = $result['number'];
  $description = $result['sentence'];
  $max_point += $result['point'];

  echo "<td>".$q_num."</td>";
  echo "<td>".$result['sentence']."</td>";
  //正否判別
  if($_POST['question'.$number] == $result['answer']){
    print('<td>〇</td>');
    $point = $result['point'];
    $total_point += $point;
  }else{
    print('<td>✕</td>');
  }

  //正解と自分の解答を表示
  if($result['type'] == 'select'){
    $a = explode(',',$result['choice']);
    echo "<td>".$a[$result['answer'] - 1]."</td>";
    echo "<td>".$a[$_POST['question'.$number] -1]."</td>";
  }else if($result['type'] == 'writing'){
    echo "<td>".$result['answer']."</td>";
    echo "<td>".$_POST['question'.$number]."</td>";
  }
  echo "</div>";
  print('<br>');

    //解答記録SQL作成
    $args[] = ['task_id' => $_POST['task_id'],'number' => $number,
    'question'=>$_POST['question'.$number],'id' => $_SESSION['id'],
    'answer_count' => 1,'point' => $point];
    
    $insert_sql .= '(:task_id'.$q_num.',:number'.$q_num.',
    :question'.$q_num.',:id'.$q_num.',1,:point'.$q_num.'),';
    $q_num++;
    $question_counter = $q_num;
    echo "</tr>";
}

try{
  $insert_sql = substr($insert_sql,0,-1);
  $insert_sql .= ';';
  $stmt = $pdo->prepare($insert_sql);
   for($i=1;$i<$question_counter;$i++){
     $stmt->bindValue(':task_id'.$i, $args[$i-1]['task_id']);
     $stmt->bindValue(':number'.$i, $args[$i-1]['number']);
     $stmt->bindValue(':question'.$i, $args[$i-1]['question']);
     $stmt->bindValue(':id'.$i, $args[$i-1]['id']);
     $stmt->bindValue(':point'.$i, $args[$i-1]['point']);
   }

   $stmt->execute();
  }catch(PDOException $e){
    echo $e->getMessage()."-".$e->getLine().PHP_EOL;
    echo "エラーが発生しました。管理者にお問い合わせください";
  }

   echo "<p style='text-align:center'>".$max_point."/".$total_point."点</p>";
   ?>
</table>
<a href="../index.php">トップメニューへ戻る</a>
</div>