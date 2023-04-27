<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/style.css">  
  <title>Document</title>
</head>
<body>
  <header>
    <?php require "simple_header.php" ?>
  </header>
  <div class="input_form">
  <h1>ログイン</h1>
  <form action="login.php" method = "post">
    
    
      <label>メールアドレス</label><input type="email" name= "email" 
      class="form-control" required value=<?php if(!empty($_COOKIE['email'])){ echo $_COOKIE['email'];} ?>></td>
    
    
      <label>パスワード</label><input type="password" name = "password" class="form-control" required 
       value=<?php if(!empty($_COOKIE['password'])){ echo $_COOKIE['password'];} ?>></td>
    
    <br>
      <label for="keep_data">ログイン情報を保存</label><input type="checkbox" id="keep_data" name="check" value="1" 
      <?php if(!empty($_COOKIE['login_keep'])){  echo 'checked';}?>></td>
      <br>
      <br>
      <input type="submit" class="btn btn-primary py-2 px-4" value = "送信">
    </div>
  </form>
  <?php setcookie('PHPSESSID','',time()-1800,'/'); ?>
</body>
</html>