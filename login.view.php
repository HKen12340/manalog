<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  <header>
    <?php require "simple_header.php" ?>
  </header>
  <h1>ログイン</h1>
  <form action="login.php" method = "post">
    <table>
    <tr>
      <th>メールアドレス</th><td><input type="email" name= "email" 
      required value=<?php if(!empty($_COOKIE['email'])){ echo $_COOKIE['email'];} ?>></td>
    </tr>
    <tr>
      <th>パスワード</th><td><input type="password" name = "password" required 
      value=<?php if(!empty($_COOKIE['password'])){ echo $_COOKIE['password'];} ?>></td>
    </tr>
    <tr>
      <td>ログイン情報を保存<input type="checkbox" name="check" value="1" 
      <?php if(!empty($_COOKIE['login_keep'])){  echo 'checked';}?>></td>
    </tr>
    </table>
    <input type="submit" value = "送信">
  </form>
</body>
</html>