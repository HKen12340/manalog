<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  <h1>ログイン</h1>
  <form action="login.php" method = "post">
    <table>
    <tr>
      <th>メールアドレス</th><td><input type="email" name= "email"></td>
    </tr>
    <tr>
      <th>パスワード</th><td><input type="password" name = "password"></td>
    </tr>
    </table>
    <input type="submit" value = "送信">
  </form>
</body>
</html>