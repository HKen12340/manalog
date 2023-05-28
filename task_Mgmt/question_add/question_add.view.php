<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../../css/style.css">
  <title>Document</title>
</head>
<body>
  <?php 
  require_once '../../check.php';
  CheckAuthority();
  ?>
  <?php require_once '../../header.php' ?>
  <?php require_once '../../dbconnect.php'; ?>
<?php error_reporting(0); ?>

<div class="question_area">

<form action='question_item_add.php' method='post'>
  <input type='hidden' name = "task_id" value="<?php echo $task_id ?>">
  <select name='question_type'>
    <option value='select'>選択</option>
    <option value='writing'>記述</option>
  </select>
  <input type='submit' value='作成'>
</form>
</div>


  <?php  while($result2 = $stmt2->fetch(PDO::FETCH_ASSOC)): ?>
    <div class="question_form">
    <form action='question_update/question_update.php' method='post'>
      <input type='hidden' name='task_id' value= <?php echo $_GET['task_id'] ?>>
      <input type='hidden' name='number' value=<?php echo $result2['number'] ?>>
      <p><?php echo $question_num .'. '. $result2['sentence']; ?></p>
      <p>配点<?php echo $result2["point"] ?>点</p>
      <?php if($result2['file_name'] != null):?>
        <img src = "uploads/<?php echo $result2['file_name']?>" width="300px">
        <br>
      <?php endif; ?>  
      <?php if($result2['type'] == 'select'): ?>
        
        <?php 
          $select = explode(',',$result2['choice']);
          for($i=0;$i < count($select);$i++):
        ?>
          <label><input type="radio" name="<?php echo $question_num;?>"><?php echo $select[$i]; ?></label>
        <?php endfor; ?>
        <p>解答:<?php echo $select[$result2['answer'] - 1]; ?></p>
      <?php elseif($result2['type'] == 'writing'): ?>
        <p>解答：<?php echo $result2['answer']; ?></p>
      <?php endif; ?>
      <input type='submit' class="btn btn-primary py-2 px-4" value='編集'/><br>
    </form>
    
    <form action='question_item_delete.php' method='post'>
      <input type='hidden' name='task_id' value= <?php echo $_GET['task_id'] ?>>
      <input type='hidden' name='number' value=<?php echo $result2['number'] ?>>
      <input type="submit" class="btn btn-Danger mt-2 py-2 px-4" value="削除"> 
    </form>    
  </div>
    <hr>
  <?php
  $question_num++;
  endwhile;
 ?>
 <div style="text-align:center;height:100px">
  <a href="../task_list.php" >課題一覧へ戻る</a>
 </div>
</body>
</html>