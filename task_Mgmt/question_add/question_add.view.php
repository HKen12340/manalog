<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
開始日: <input type="date">
<br>締切日: <input type="date">
<a href="../task_list.php">課題一覧へ戻る</a>
<form action='question_item_add.php' method='post'>
<input type='hidden' name = "task_id" value="<?php echo $task_id ?>">

<select name='question_type'>
  <option value='select'>選択</option>
  <option value='writing'>記述</option>
</select>
<input type='submit' value='作成'>
</form>
  <?php  while($result2 = $stmt2->fetch(PDO::FETCH_ASSOC)): ?>
    
    <form action='question_update/question_update.php' method='post'>
      <input type='hidden' name='task_id' value= <?php echo $_GET['task_id'] ?>>
      <input type='hidden' name='number' value=<?php echo $result2['number'] ?>>
      
      <p><?php echo $question_num .'. '. $result2['sentence']; ?></p>
      <?php if($result2['file_name'] != null):?>
        <img src = "uploads/<?php echo $result2['file_name']?>" width="100px">
      <?php endif; ?>  
      <?php if($result2['type'] == 'select'): ?>
        
        <?php 
          $select = explode(',',$result2['choice']);
          for($i=0;$i < count($select);$i++):
        ?>
          <label><input type="radio"><?php echo $select[$i]; ?></label>
        <?php endfor; ?>
        <p>解答:<?php echo $select[$result2['answer'] - 1]; ?></p>
      <?php elseif($result2['type'] == 'writing'): ?>
        <p>解答：<?php echo $result2['answer']; ?></p>
      <?php endif; ?>
      <input type='submit' value='編集'/><br>
    </form>
    
    <form action='question_update/question_item_delete.php' method='post'>
    <input type='hidden' name='task_id' value= <?php echo $_GET['task_id'] ?>>
      <input type='hidden' name='number' value=<?php echo $result2['number'] ?>>
      <input type="submit" value="削除"> 
    </form>
    <hr>
  <?php
  $question_num++;
  endwhile;
 ?>
</body>
</html>