<head>
  <link rel="stylesheet" href="../../css/style.css">
</head>
<?php
require '../../check.php';
CheckAuthority();
require '../../simple_header.php';

$task_id =  $_POST['task_id'];
$type = $_POST['question_type'];
?>
<div class="input_form">
<!-- 選択問題ここから -->
<?php if($type == 'select'): ?>
  <h1>選択問題作成</h1>
<form action='question_item_add_db.php' method='post' enctype="multipart/form-data">
<div class="form-group">
  <input type='hidden' name='task_id'  value=<?php echo $task_id ?>>  
  <input type='hidden' name='question_type'  value=<?php echo $type ?>>

  <label>問題文</label>
  <textarea name='description' class="form-control" required></textarea>
  </br>
  <input type='button' id='Addbutton' value='選択肢追加'>
    <div id='select_question'>
      <div>
        <label>選択肢1<input type="text" name="name[]" required></label>
        <label>　正解の選択肢<input type="radio" name="radio_select" value="1" required></label>
      </div>
    </div>
    
    <lebel>配点</lebel><input type="number" name="point" class="form-control" min = "1" required>
    <lebel>画像</lebel><input type="file" name="file" class="form-control-file" accept="image/*">
    <input type = 'submit' class="btn btn-primary mt-3 py-2 px-4" value = '登録'/>
  </form>
  <script>
    //あらかじめ選択肢を1つ出しておくためselect_numberは2から始める
    let select_number = 2;
    let add_select = document.getElementById('Addbutton');

    add_select.addEventListener('click',function(){
     if(select_number <= 10){
      let select_element = document.getElementById('select_question');
      let new_div = document.createElement('div');
      
      let input_label = document.createElement('label');
      input_label.textContent = '選択肢' + select_number;
      let new_element = document.createElement('input');
      new_element.type = 'text';
      new_element.name = 'name[]';
      new_element.required = true;
      input_label.appendChild(new_element);

      let radio_label = document.createElement('label');
      radio_label.textContent = '　正解の選択肢';
      let new_radio = document.createElement('input');
      new_radio.type = 'radio';
      new_radio.name = 'radio_select';
      new_radio.value = select_number;
      new_radio.required = true;
      new_radio.class = "radio_check_input";
     select_number++;

      radio_label.appendChild(new_radio);

      new_div.appendChild(input_label);
      new_div.appendChild(radio_label);
      
      select_element.appendChild(new_div);
     }
    },false);  
  </script>
  <!-- 選択問題ここまで -->

  <!-- 記述問題ここから -->
<?php elseif($type == 'writing'): ?>
  <h1>記述問題作成</h1>
  <form action='question_item_add_db.php' method='post' enctype="multipart/form-data">
  <input type='hidden' name='task_id'  value=<?php echo $task_id ?>>
  <input type='hidden' name='question_type'  value=<?php echo $type ?>>
  <label>問題文</label>
  <textarea name='description' class="form-control" required></textarea>
  </br>
   <label>解答</label>
   <input type="text" name='answer' class="form-control" required>
   <lebel>配点</lebel><input type="number" name="point" class="form-control" min="1" required>
  <lebel>画像</lebel><input type="file" name="file" class="form-control-file" accept="image/*">
    <input type='submit' class="btn btn-primary mt-3 py-2 px-4" value='登録'/>
   </div>
   </form>
  </div>
   <?php endif;?>
   <!-- 記述問題ここまで -->