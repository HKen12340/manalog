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
  <?php  require '../../check.php';?>
  <?php require '../../simple_header.php'; ?>

  <div class="input_form">
    <div class="form-group">
  <h1>テスト追加</h1>
  <form action="task_edit_db.php" method = "post">
   <label>テスト名</label>
      <input type="text" name = "name" class="form-control" required>
  <label>公開クラス</label>
        <select name="class" class="form-control">
          <option value="1T1">1T1</option>
          <option value="1T2">1T2</option>
          <option value="1T3">1T3</option>
        </select>
  <label>公開日</label>
  <input type="date" name="startDay" class="form-control" required>
    <label>締切日</label>
    <input type="date" name = "endDay" class="form-control" required>
      <label>解答回数制限</label>
        <select name="answer_limit" class="form-control">
          <option value="0">制限なし</option>
          <option value="1">1回まで</option>
        </select>
    <label>背景色</label>
        <select name="back_color" class="form-control">
          <option value="yellow">黄</option>
          <option value="red">赤</option>
          <option value="#000099">青</option>
          <option value="green">緑</option>
        </select>
  <input type="submit" class="btn btn-primary mt-4 mb-5 py-2 px-4" value="送信">
  </form>
  </div>
  </div>
</body>
</html>