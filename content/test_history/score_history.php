<?php 
require '../../dbconnect.php';

$student_id = $_POST['id'];

$sql = 'select task_id,t.task_name,SUM(q.point) as "max_point",SUM(a.point) as "my_point",
quantity,time_stamp,startDay,endDay,user_id from ((answer a RIGHT OUTER join question q ON 
a.task_id = q.TaskId  and a.number = q.number) RIGHT OUTER JOIN task t ON t.id = q.TaskId)
WHERE user_id = :user_id and time_stamp IN(SELECT MAX(time_stamp) FROM `answer` GROUP BY task_id) GROUP BY task_id';

 $stmt = $pdo->prepare($sql);
 $stmt->bindValue(':user_id',$student_id);
 $stmt->execute();
?>
<table>
  <tr>
    <td>課題名</td><td>点数</td><td>問題数</td><td>解答時刻</td><td>公開日</td><td>締め切り日</td>
  </tr>
 <?php while($result = $stmt->fetch(PDO::FETCH_ASSOC)): ?>
  <tr>
    <td><?php echo $result['task_name'] ?></td>
    <td><?php echo $result['max_point']."点中/". $result['my_point']."点" ?></td>
    <td><?php echo $result['quantity'] ."問" ?></td>
    <td><?php echo $result['time_stamp'] ?></td>
    <td><?php echo $result['startDay'] ?></td>
    <td><?php echo $result['endDay'] ?></td>
    <td>
      <form action="result_history.php" method="post">
        <input type="hidden" name="task_id" value="<?php echo $result['task_id']?>">
        <input type="hidden" name="user_id" value="<?php echo $result['user_id']?>">
        <input type="submit" value="詳細">
      </form>
    </td>
  </tr>
 <?php endwhile ?>
</table>
