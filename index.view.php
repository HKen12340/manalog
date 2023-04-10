<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/bootstrap4/css/bootstrap.min.css">
  <title>Document</title>
</head>
<?php require 'check.php' ?>
<?php date_default_timezone_set('Asia/Tokyo');  ?>
<body>
  <script src="css/bootstrap4/js/bootstrap.min.js"></script>
  
  <nav class="navbar navbar-expand-sm navbar-dark bg-dark mt-0 mb-3">
    <p class="navbar-brand">Manalog</p>
    <div class="collapse navbar-collapse">
      <ul class="navbar-nav">
        <li class="nav-item">
          <p class="nav-link">User:<?php print $_SESSION['name']; ?></p>
        </li>
        <?php if(h($_SESSION['authority']) == 'T'):  ?>
          <li class="nav-item active">
            <a class="nav-link" href="task_Mgmt/task_list.php">課題管理</a>
          </li>
          <li class="nav-item">
              <a class="nav-link" href="user_Mgmt/user_list.php">ユーザ管理</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="content/test_history/student_history.php">生徒成績</a>
          </li>
        <?php endif; ?> 
        <li class="nav-item">
          <a class="nav-link" href="content/test_history/history.php">成績</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="logout.php">ログアウト</a>
        </li>
       </ul>
      </div>
  </nav>   
  
    <table class="test_table">
      <tr>
        <?php for($i=0;$i<7;$i++): ?>
          <th><?php echo date("m-d",strtotime('+'.$i.' day')); ?></th>
        <?php endfor; ?>
      </tr>
      <?php while($result = $stmt->fetch(PDO::FETCH_ASSOC)): ?>
      <tr>
        <?php 
          $flag = 0;
          for($i=0;$i<7;$i++): 
            if(date("Y-m-d") >= $result['startDay'] &&
            date("Y-m-d",strtotime('+'.$i.' day')) <= $result['endDay']):
              if($flag == 0): 
                $flag = 1;
                $date1 = new DateTime(date("Y-m-d"));
                $date2 = new DateTime($result['endDay']);

                $date3 = $date1->diff($date2);
                $daydiff =  $date3->format('%a');
        ?>
        <td colspan="<?php echo $daydiff + 1; ?>" 
        style="background-color:<?php echo  h($result['back_color'])?>;text-align:center">
          <a href='content/kakunin.php?task_id=<?php echo h($result['id']) ?>'>
            <?php echo $result['task_name']?>
          </a>
        </td> 
          <?php endif; ?>
        <?php else: ?>
          <td>　</td>
        <?php endif ?>
      <?php endfor; ?>
    </tr>
    <?php endwhile; ?>
  </table>
</body>
</html>