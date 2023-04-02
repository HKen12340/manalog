<?php
require('../../dbconnect.php');
$user_id = $_POST['id'];

$sql = 'select * from user_info where id = ?';
$stmt = $pdo->prepare($sql);
$stmt->execute(array($user_id));

$result = $stmt->fetch(PDO::FETCH_ASSOC);
?>
<form action="user_update_db.php" method="post">
  <input type="hidden" name = "id" value="<?php echo $user_id ?>">
  <table>
    <tr>
      <td>
        <label>名前<input type="text" name="name" value="<?php echo $result['name'] ?>" required></label>
      </td>
    </tr>
    <tr>
      <td>
        <label>クラス<input type="text" name="class" value="<?php echo $result['class'] ?>"></label>
      </td>
    </tr>
    <tr>
      <td>
        <label>番号<input type="number" name="number" value="<?php echo $result['number'] ?>" required></label>
      </td>
    </tr>
    <tr>
      <td>
        <label>email<input type="email" name="email" value="<?php echo $result['email'] ?>" required></label>
      </td>
    </tr>
    <tr>
      <td>
        <label>パスワード<input type="password" name="password" value="<?php echo $result['password'] ?>" required></label>
      </td>
    </tr>
    <tr>
      <td><input type="submit" value="送信"></td>
    </tr>
  </table>
</form>