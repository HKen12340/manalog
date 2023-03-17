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
      <th>テスト名</th><td><input type="text" name = "name"></td>
    </tr>
    <tr>
      <th>公開クラス</th>
      <td>
        <select name="class">
          <option value="1T1">1T1</option>
          <option value="1T2">1T2</option>
          <option value="1T3">1T3</option>
        </select>
      </td>
    </tr>
    <tr>
    開始日: <input type="date" name="startDay">
<br>締切日: <input type="date" name = "endDay">
    </tr>
  </table>
  <input type="submit" value="送信">
  </form>
</body>
</html>