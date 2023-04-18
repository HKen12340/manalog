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
  <?php require '../../check.php'; ?>
  <?php require '../../simple_header.php'; ?>
  
  <div class="input_form">
  <h1>ユーザ登録</h1>
  <form action="user_add_db.php" method="post">
  <div class="form-group">
      <lebel>氏名</label>
      <input type="text" name="name" required = "required" class="form-control">
      <label>クラス</label>
        <select name="class" class="form-control">
          <option value="1T1">1T1</option>
          <option value="1T2">1T2</option>
          <option value="1T3">1T3</option>
        </select>
      <label>権限</label>
          <select name="authority" class="form-control">
            <option value="S">生徒</option>
            <option value="T">教員</option>
          </select>
      <label>出席番号</label>
      <input type="text" name="number" class="form-control" required = "required">
      <label>メールアドレス</label>
      <input type="text" name = "email" class="form-control" required = "required">
      <label>パスワード</label>
      <input type="password" name="password"  class="form-control" required = "required">
  </div>
  <input type="submit" value = "登録">
  </form>
  </div>
</body>
</html>