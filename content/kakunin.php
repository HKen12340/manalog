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
$select_sql = 'select DISTINCT a.user_id,a.task_id,
              a.answer_count,b.answer_limit,b.task_name from answer a
              INNER JOIN task b  ON a.task_id = b.id and
              a.task_id = :task_id and a.user_id = :id';
$stmt = $pdo->prepare($select_sql);

$stmt->bindValue(':task_id',$_GET['task_id']);
$stmt->bindValue(':id',$_SESSION['id']);
$stmt->execute();
$result = $stmt->fetch(PDO::FETCH_ASSOC);
?>
<body>
  <div style="text-align:center;margin-top:10%">
  <form action="quiz.php" method = "post">
    <input type="hidden" name="task_id" value="<?php echo $_GET['task_id'] ?>">
    <!-- 解答制限回数を超えているか -->
    <?php if($result['answer_limit'] != 0 && $result['answer_count'] >= $result['answer_limit']): ?>
      解答回数制限を超えました
    <?php else: ?>
      <p style="font-size:4em"><?php echo $result['task_name'] ?></p>
    <input type="submit" value="開始"/>
    <?php endif; ?>
  </form>
  </div>
</body>
</html>