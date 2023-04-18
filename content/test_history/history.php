<?php 
session_start();
require '../../check.php';
require '../../dbconnect.php';
require '../../header.php' ;
$sql = 'select task_id,t.task_name,SUM(q.point) as "max_point",SUM(a.point) as "my_point",
quantity,time_stamp,startDay,endDay from ((answer a RIGHT OUTER join question q ON 
a.task_id = q.TaskId  and a.number = q.number) RIGHT OUTER JOIN task t ON t.id = q.TaskId)
WHERE user_id = ? and time_stamp IN(SELECT MAX(time_stamp) FROM `answer` GROUP BY task_id) GROUP BY task_id';

 $stmt = $pdo->prepare($sql);
 $stmt->execute(array($_SESSION['id']));
?>
<div style="margin:auto;width:60%">
<h1>成績</h1>
<table class="table border">
  <tr>
    <th>課題名</th>
    <th>点数</th>
    <th>問題数</th>
    <th>解答時刻</th>
    <th>公開日</th>
    <th>締め切り日</th>
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
      <form action="My_result_history.php" method="post">
        <input type="hidden" name="task_id" value="<?php echo $result['task_id']?>">
        <input type="submit" value="詳細">
      </form>
    </td>
  </tr>
 <?php endwhile ?>
</table>
 </div>