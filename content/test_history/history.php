<?php 
require '../../dbconnect.php';

$sql = 'select task_name,id task from task';

 $stmt = $pdo->prepare($sql);
 $stmt->execute();
?>
<table>
 <?php while($result = $stmt->fetch(PDO::FETCH_ASSOC)): ?>
  <tr>
    <td><?php echo $result['task_name'] ?></td>
  </tr>
 <?php endwhile ?>
</table>
