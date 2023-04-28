<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<?php
error_reporting(0);
require '../dbconnect.php';
 require "../simple_header.php";
require '../check.php';
session_start();

//SQl関連
$task_sql = 'select task_name from task WHERE id = :task_id';
$stmt1 = $pdo->prepare($task_sql);
$stmt1->bindValue(':task_id',$_GET['task_id']);
$stmt1->execute();
$result1 = $stmt1->fetch(PDO::FETCH_ASSOC);

$user_sql = 'select DISTINCT a.user_id,a.answer_count,b.answer_limit from answer a
RIGHT OUTER JOIN task b  ON a.task_id = b.id 
WHERE b.id = :task_id and a.user_id = :id';
$stmt2 = $pdo->prepare($user_sql);
$stmt2->bindValue(':task_id',$_GET['task_id']);
$stmt2->bindValue(':id',$_SESSION['id']);
$stmt2->execute();
$result2 = $stmt2->fetch(PDO::FETCH_ASSOC);

?>
<body>
  <div style="text-align:center;margin-top:10%">
  <form action="quiz.php" method = "post">
    <input type="hidden" name="task_id" value="<?php echo $_GET['task_id'] ?>">
    <!-- 解答制限回数を超えているか -->
    <?php if($result2['answer_limit'] != 0 && $result2['answer_count'] >= $result2['answer_limit']): ?>
      解答回数制限を超えました
    <?php else: ?>
      <p style="font-size:4em"><?php echo $result1['task_name'] ?></p>
    <input type="submit" class="btn btn-primary mt-3 py-3 px-5" value="開始"/>
    <?php endif; ?>
  </form>
  </div>
</body>
</html>