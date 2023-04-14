<link rel="stylesheet" href="/manalog/css/bootstrap4/css/bootstrap.min.css">
<nav class="navbar navbar-expand-sm navbar-dark bg-dark mt-0 mb-3">
    <p class="navbar-brand"><a href="/manalog/index.php">Manalog</a></p>
    <div class="collapse navbar-collapse">
      <ul class="navbar-nav">
        <li class="nav-item">
          <p class="nav-link">User : <?php print $_SESSION['name']; ?></p>
        </li>
        <?php if($_SESSION['authority'] == 'T'):  ?>
          <li class="nav-item">
            <a class="nav-link" href="/manalog/task_Mgmt/task_list.php">課題管理</a>
          </li>
          <li class="nav-item">
              <a class="nav-link" href="/manalog/user_Mgmt/user_list.php">ユーザ管理</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/manalog/content/test_history/student_history.php">生徒成績</a>
          </li>
        <?php endif; ?> 
        <li class="nav-item">
          <a class="nav-link" href="/manalog/content/test_history/history.php">成績</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/manalog/logout.php">ログアウト</a>
        </li>
       </ul>
      </div>
  </nav>
  