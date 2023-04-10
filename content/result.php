<?php
error_reporting(0);
require '../dbconnect.php';
require '../check.php';

session_start();
$ans_select = 'select DISTINCT task_id,user_id,answer_count from answer 
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
while($result = $stmt->fetch(PDO::FETCH_ASSOC)){
  $point = 0;
  $number = $result['number'];
  $description = $result['sentence'];
  $max_point += $result['point'];

  echo $q_num.".";

  if($_POST['question'.$number] == $result['answer']){
    print('〇');
    $point = $result['point'];
    $total_point += $point;
  }else{
    print('✕');
  }
  print('<hr>');
  print('<br>');

    $args[] = ['task_id' => $_POST['task_id'],'number' => $number,
    'question'=>$_POST['question'.$number],'id' => $_SESSION['id'],
    'answer_count' => 1,'point' => $point];
    
    $insert_sql .= '(:task_id'.$q_num.',:number'.$q_num.',
    :question'.$q_num.',:id'.$q_num.',1,:point'.$q_num.'),';
    $q_num++;
    $question_counter = $q_num;
}

  $insert_sql = substr($insert_sql,0,-1);
  $insert_sql .= ';';
  $stmt = $pdo->prepare($insert_sql);
  
   for($i=1;$i<$question_counter;$i++){
     $stmt->bindValue(':task_id'.$i,$args[$i-1]['task_id']);
     $stmt->bindValue(':number'.$i,$args[$i-1]['number']);
     $stmt->bindValue(':question'.$i,$args[$i-1]['question']);
    $stmt->bindValue(':id'.$i,$args[$i-1]['id']);
    $stmt->bindValue(':point'.$i,$args[$i-1]['point']);
  }
  $stmt->execute();

 echo $max_point."/".$total_point."点";
?>
<button id = "top_button">トップメニューへ戻る</button>
<script>
  document.getElementById("top_button").addEventListener('click',function(){
    location.href = "../index.php";
  },false)
</script>