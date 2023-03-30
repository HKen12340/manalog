<?php 
require '../../dbconnect.php';

$sql = 'select task_id,t.task_name,SUM(q.point) as "max_point",SUM(a.point) as "my_point",
quantity,time_stamp from ((answer a RIGHT OUTER join question q ON 
a.task_id = q.TaskId  and a.number = q.number) RIGHT OUTER JOIN task t ON t.id = q.TaskId)
WHERE user_id = 4 and time_stamp IN(SELECT MAX(time_stamp) FROM `answer` GROUP BY task_id) GROUP BY task_id';

 $stmt = $pdo->prepare($sql);
 $stmt->execute();
?>
<table>
  <tr>
    <td>課題名</td><td>点数</td><td>問題数</td><td>解答時刻</td>
  </tr>
 <?php while($result = $stmt->fetch(PDO::FETCH_ASSOC)): ?>
  <tr>
    <td><?php echo $result['task_name'] ?></td>
    <td><?php echo $result['max_point']."点中/". $result['my_point']."点" ?></td>
    <td><?php echo $result['quantity'] ."問" ?></td>
    <td><?php echo $result['time_stamp'] ?></td>
  </tr>
 <?php endwhile ?>
</table>

<?php /*
  select  from ((task a left outer join question b on a.id = b.TaskId)
 left outer join answer c on b.number = c.number)where c.user_id = 4 and
 time_stamp=(select max(time_stamp) from answer) order by a.id ASC 
 */