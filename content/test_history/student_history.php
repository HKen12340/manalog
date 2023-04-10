<?php
require '../../dbconnect.php';
require '../../check.php';

$sql = 'select * from user_info';
$stmt = $pdo->prepare($sql);
$stmt->execute();
?>
<table>
<?php
while($result = $stmt->fetch(PDO::FETCH_ASSOC)):
  if($result['authority'] == 'S'):
?>
<tr>
  <td><?php echo $result['name'] ?></td>
  <td>
    <form action="score_history.php" method="post">
      <input type="hidden" name="id" value=<?php echo $result['id'] ?>>
      <input type="submit" value="詳細">
    </form>
  </td>
</tr>
<?php 
  endif;
endwhile; 
?>
</table>