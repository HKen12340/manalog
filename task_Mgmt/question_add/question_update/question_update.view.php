<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  
<a href="../question_add.php?task_id=<?php echo $_POST['task_id'] ?>">問題一覧へ戻る</a>

<form action="question_updata_db.php" method = "post">
  <input type='hidden' name='task_id' value=<?php echo $_POST['task_id'] ?>>
  <input type='hidden' name='number' value=<?php echo $result['number'] ?>> 
  <input type='hidden' name='type' value=<?php echo $result['type'] ?>> 
<?php if($result['type'] == 'writing'): ?>
  <p>問題文</p>
  <textarea name = "sentence"><?php echo $result['sentence'] ?></textarea>
  <p>解答</p>
  <textarea name = "answer"><?php echo $result['answer'] ?></textarea>
  <?php elseif($result['type'] == 'select'): ?>
    <p>問題文</p>
    <textarea name = "sentence"><?php echo $result['sentence'] ?></textarea>
    <br>
        <?php $select = explode(',',$result['choice']);
        for($i=0;$i < count($select);$i++): ?>
          選択肢<?php echo ($i+1);?><input type="text" name="select[]" value= <?php echo $select[$i] ?>>
          解答：<input type="radio" name="answer" value = "<?php echo $i + 1 ?>" 
                <?php if($result['answer'] == ($i + 1)){ echo "checked"; }?>><br>
        <?php endfor ?>
<?php endif ?>
<br><label>配点:<input type="number" name="point" value="<?php echo $result['point'] ?>"></label>
<input type="submit">
</form>

</body>
</html>