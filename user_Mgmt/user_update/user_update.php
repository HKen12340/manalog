<html>
  <head>
    <link rel="stylesheet" href="../../css/style.css">
  </head>
  <body>
<?php
require '../../dbconnect.php';
require '../../check.php';
CheckAuthority();

require '../../header.php';

$user_id = $_POST['id'];
$sql = 'select * from user_info where id = ?';
$stmt = $pdo->prepare($sql);
$stmt->execute(array($user_id));

$result = $stmt->fetch(PDO::FETCH_ASSOC);
?>
<div class="input_form">
<form action="user_update_db.php" method="post">
  <input type="hidden" name = "id" value="<?php echo $user_id ?>">
  
  <h1>ユーザ編集</h1>
  <div class="form-group">
        <label>名前</label>
        <input type="text" name="name" class="form-control" value="<?php echo $result['name'] ?>" required>
        <label>クラス</label>
        <select name="class" class="form-control">
          <?php
          $class = ['1T1','1T2','1T3'];
          foreach($class as $c){
            if($c == $result['class']){
              echo "<option value= ". $c ." selected>". $c ."</option>";  
            }else{
              echo "<option value= ". $c .">". $c ."</option>";
            }
          }
          ?>
        </select>
        
        <label>番号</label>
        <input type="number" name="number" class="form-control" value="<?php echo $result['number'] ?>" required>
        <label>email</label>
        <input type="email" name="email" class="form-control" value="<?php echo $result['email'] ?>" required>      
        <label>パスワード</label>
        <input type="password" name="password" class="form-control" required>
    </div>
    <input type="submit" class="btn btn-primary py-2 px-4" value="送信">
  </div>
</form>
</div>
</body>
</html>