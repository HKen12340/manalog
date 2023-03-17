<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  <h1>ユーザ登録画面</h1>
  <form action="user_add_db.php" method="post">
  <table>
    <tr>
      <th>氏名</th><td><input type="text" name="name" required = "required"></td>
    </tr>
    <tr>
      <th>クラス</th>
      <td>
        <select name="class">
          <option value="1T1">1T1</option>
          <option value="1T2">1T2</option>
          <option value="1T3">1T3</option>
        </select>
      </td>
    </tr>
    <tr>
      <tr>
        <th>権限</th>
        <td>
          <select name="authority">
            <option value="S">生徒</option>
            <option value="T">教員</option>
          </select>
        </td>
      </tr>
      <th>出席番号</th><td><input type="text" name="number" required = "required"></td>
    </tr>
    <tr>
      <th>メールアドレス</th><td><input type="text" name = "email" required = "required"></td>
    </tr>
    <tr>
      <th>パスワード</th><td><input type="password" name="password" required = "required"></td>
    </tr>
  </table>
  <input type="submit" value = "登録">
  </form>

</body>
</html>