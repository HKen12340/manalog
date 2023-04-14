<?php
require '../dbconnect.php';
require '../check.php';
require '../simple_header.php';

$sql = 'select * FROM question a left outer join question_image b
 on a.TaskId = b.task_id and a.number = b.number WHERE a.TaskId = :TaskId';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':TaskId',$_POST['task_id']);
$stmt->execute();

$task_id = h($_POST['task_id']);
$questoin_num = 1;
?>
<form action="result.php" method="post">
    <input type="hidden" name="task_id" value="<?php echo $task_id ?>">
<?php
  while($result = $stmt->fetch(PDO::FETCH_ASSOC)):
    echo $questoin_num.".";
    $questoin_num++;
    if(h($result['file_name']) != null):
  ?>
  <br>
  <img src="../task_Mgmt/question_add/uploads/<?php echo $result['file_name'] ?>" width="200px">
  <?php
  endif;
    if(h($result['type']) == 'select'):
      $select = explode(',',$result['choice']);
  ?>
    <p><?php echo h($result['sentence']) ?></p>  
    <?php for($i=0;$i < count($select);$i++):?>
      <label><input type="radio" name='question<?php echo $result['number'] ?>' 
              value="<?php echo ($i+1) ?>" required><?php echo $select[$i] ?></label>
    <?php endfor; ?>
  <?php elseif($result['type'] == 'writing'): ?>
    <p><?php echo $result['sentence'] ?></p>
    <input name="question<?php echo $result['number'] ?>" required>
  <?php endif; ?>
  <hr>
  <br>
<?php endwhile; ?>
<input type = "submit" value="送信">
</form>