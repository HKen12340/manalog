<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  <h1>テスト追加</h1>
  <form action="task_edit_db.php" method = "post">
  <table>
    <tr>
      <td>テスト名:<input type="text" name = "name" required></td>
    </tr>
    <tr>
      <td>
      公開クラス:
        <select name="class">
          <option value="1T1">1T1</option>
          <option value="1T2">1T2</option>
          <option value="1T3">1T3</option>
        </select>
      </td>
    </tr>
    <tr>
  <td>公開日: <input type="date" name="startDay" required></td>
    </tr>
    <tr>
    <td>締切日: <input type="date" name = "endDay" required></td>
    </tr>
    <tr>
      <td>
        解答回数制限：
        <select name="answer_limit">
          <option value="0">制限なし</option>
          <option value="1">1回まで</option>
        </select>
      </td>
    </tr>
    <tr>
      <td>
        背景色：
        <select name="back_color">
          <option value="yellow">黄</option>
          <option value="red">赤</option>
          <option value="#000099">青</option>
          <option value="green">緑</option>
        </select>
      </td>
    </tr>
  </table>
  <input type="submit" value="送信">
  </form>
</body>
</html>