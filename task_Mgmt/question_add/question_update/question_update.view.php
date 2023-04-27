<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../../../css/style.css">
  <title>Document</title>
</head>
<body>
  <?php 
    require '../../../check.php';
    require '../../../header.php';
  ?>
<a href="../question_add.php?task_id=<?php echo $_POST['task_id'] ?>">問題一覧へ戻る</a>
<div class="input_form">
  <div class="form-group">
    <form action="question_updata_db.php" method = "post">
      <input type='hidden' name='task_id' value=<?php echo $_POST['task_id'] ?>>
      <input type='hidden' name='number' value=<?php echo $result['number'] ?>> 
      <input type='hidden' name='type' value=<?php echo $result['type'] ?>> 
      <?php if($result['type'] == 'writing'): ?>
        <h1>記述問題の編集</h1>
        <label>問題文</label>
        <textarea name = "sentence" class="form-control"><?php echo $result['sentence'] ?></textarea>
        <label>解答</label>
        <input type="text" name = "answer" class="form-control" value="<?php echo $result['answer'] ?>">
        <?php elseif($result['type'] == 'select'): ?>
          <h1>選択問題の編集</h1>
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
      <label>配点</label><input type="number" name="point" class="form-control" value="<?php echo $result['point'] ?>">
      <input type="submit" class="btn btn-primary mt-3 py-2 px-4" value = "送信">
    </form>
  </div>
</div>
</body>
</html>