<?php
require '../dbconnect.php';
require '../check.php';
require '../header.php';

$sql = 'select * from user_info';
$stmt = $pdo->prepare($sql);
$stmt->execute();
?>

<div style="margin:auto;width:70%">   
<h1>ユーザ一覧</h1>
<a href="user_add/user_add.php">新規作成</a>
<table class = "table border">
  <tr>
    <th>ID</th>
    <th>氏名</th>
    <th>クラス</th>
    <th>番号</th>
    <th>メールアドレス</th>
    <th>権限</th>
    <th></th>
    <th></th>
  </tr>
  <?php while($result = $stmt->fetch(PDO::FETCH_ASSOC)):?>
    <tr>
      <td>
        <?php echo $result['id'] ?>
      </td>
      <td>
        <?php echo $result['name'] ?>
      </td>
      <td>
        <?php echo $result['class'] ?>
      </td>
      <td>
        <?php echo $result['number'] ?>
      </td>
      <td>
        <?php echo $result['email'] ?>
      </td>
      <td>
        <?php
        if($result['authority'] == 'T'){
          echo "教員";
        }elseif($result['authority'] == 'S'){
          echo "生徒";
        }else{
          echo "権限が設定されていません";
        }
          
         ?>
      </td>
      <td>
        <form action="user_update/user_update.php" method="post">
          <input type="hidden" name = "id" value="<?php echo $result['id'] ?>">
          <input type="submit" class="btn btn-primary py-2 px-4" value="編集">
        </form>
      </td>
      <td>
        <form action="user_delete.php" method="post">
          <input type="hidden" name = "id" value="<?php echo $result['id'] ?>">
          <input type="submit" class="btn btn-Danger py-2 px-4" value="削除">
        </form>
      </td>
    </tr>
  <?php endwhile; ?>
</table>
  </div>