<?php
require '../dbconnect.php';
require '../check.php';
require '../header.php' ;
$sql = 'select * from task order by id desc';

$stmt = $pdo->prepare($sql);
$stmt->execute();

?>
<div style="margin:auto;width:70%">
<h1>課題一覧</h1>
<a href="task_edit/task_edit.php">課題作成</a>
<table class="table border">
  <tr>
    <th>課題名</th>
    <th>問題数</th>
    <th>公開クラス</th>
    <th>公開日</th>
    <th>締め切り日</th>
    <th>状態</th>
    <th></th>
    <th></th>
  </tr>
<?php 
while($result = $stmt->fetch(PDO::FETCH_ASSOC)):
  ?>
  <tr>
    <td>
      <a href='question_add/question_add.php?task_id=<?php echo $result['id']?>'>
      <?php echo $result['task_name'] ?></a>
    </td>
    <td>
      <?php echo $result['quantity']; ?>
    </td>
    <td>
      <?php echo $result['class']; ?>
    </td>
    <td>
      <?php echo $result['startDay']; ?>
    </td>
    <td>
      <?php echo $result['endDay']; ?>
    </td>
    <td>
      <?php if($result['task_release'] == 1):?>
        公開
      <?php else: ?>
        非公開
      <?php endif; ?>
    </td>

  <td>
    <form action="release.php" method = "post">
      <input type="hidden" name = "task_id" value="<?php echo $result['id']; ?>">
      <input type="hidden" name = "task_release" value="<?php echo $result['task_release']?>">
    <?php if($result['task_release'] == 0 && $result['quantity'] > 0):?>
      <input type="submit" value="公開する">
    <?php elseif($result['task_release'] == 1 && $result['quantity'] > 0): ?>
      <input type="submit" value="非公開にする">
    <?php else: ?>
        <p>問題を作成してください</p>
    <?php endif; ?>
  </form>
</td>
<td>
  <a href='delete.php?task_id=<?php echo $result['id'] ?>'>削除</a>
</td>
  </tr>
<?php endwhile; ?>
</table>
    </div>