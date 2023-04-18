<?php
require '../../dbconnect.php';
require '../../check.php';
require '../../header.php' ;

$sql = 'select * from user_info';
$stmt = $pdo->prepare($sql);
$stmt->execute();
?>
<div style="margin:auto;width:50%">
<h1>生徒解答履歴</h1>
<table class="table border">
  <tr>
    <th>氏名</th>
    <th>番号</th>
    <th>クラス</th>
    <th></th>
  </tr>
<?php
while($result = $stmt->fetch(PDO::FETCH_ASSOC)):
  if($result['authority'] == 'S'):
?>
<tr>
  <td><?php echo $result['name'] ?></td>
  <td><?php echo $result['number'] ?></td>
  <td><?php echo $result['class'] ?></td>
  <td>
    <form action="score_history.php" method="post">
      <input type="hidden" name="id" value=<?php echo $result['id'] ?>>
      <input type="hidden" name="name" value=<?php echo $result['name'] ?>>
      <input type="submit" value="詳細">
    </form>
  </td>
</tr>
<?php 
  endif;
endwhile; 
?>
</table>
</div>