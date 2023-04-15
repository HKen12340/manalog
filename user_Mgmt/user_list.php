<?php
require('../dbconnect.php');
require '../check.php';

$sql = 'select * from user_info';
$stmt = $pdo->prepare($sql);
$stmt->execute();
?>
   
<?php require '../header.php' ?>
<h1>ユーザ一覧</h1>
<a href="user_add/user_add.php">新規作成</a>
<table class = "table">
  <tr>
    <th>ID</th>
    <th>氏名</th>
    <th>クラス</th>
    <th>番号</th>
    <th>メールアドレス</th>
    <th>パスワード</th>
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
        <?php echo $result['password'] ?>
      </td>
      <td>
        <?php echo $result['authority'] ?>
      </td>
      <td>
        <form action="user_update/user_update.php" method="post">
          <input type="hidden" name = "id" value="<?php echo $result['id'] ?>">
          <input type="submit" value="編集">
        </form>
      </td>
      <td>
        <form action="user_delete.php" method="post">
          <input type="hidden" name = "id" value="<?php echo $result['id'] ?>">
          <input type="submit" value="削除">
        </form>
      </td>
    </tr>
  <?php endwhile; ?>
</table>