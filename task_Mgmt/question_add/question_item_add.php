<?php
$task_id =  $_POST['task_id'];
$type = $_POST['question_type'];

 if($type == 'select'): ?>
<form action='question_item_add_db.php' method='post' enctype="multipart/form-data">

  <input type='hidden' name='task_id'  value=<?php echo $task_id ?>>  
  <input type='hidden' name='question_type'  value=<?php echo $type ?>>

  <p>問題文</p>
  <textarea cols='30' rows='5' name='description'></textarea>
  </br>
  <input type='button' id='Addbutton' value='選択肢追加'>
    <div id='select_question'>
      
    </div>
    画像：<input type="file" name="file" accept="image/*">
    <input type = 'submit' value = '登録'/>
  </form>
  <script>
    let select_number = 1;
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
      input_label.appendChild(new_element);

      let radio_label = document.createElement('label');
      radio_label.textContent = '正解の選択肢';
      let new_radio = document.createElement('input');
      new_radio.type = 'radio';
      new_radio.name = 'radio_select';
      new_radio.value = select_number;
      
     select_number++;

      radio_label.appendChild(new_radio);

      new_div.appendChild(input_label);
      new_div.appendChild(radio_label);
      
      select_element.appendChild(new_div);
     }
    },false);  
  </script>
<?php elseif($type == 'writing'): ?>
  <form action='question_item_add_db.php' method='post' enctype="multipart/form-data">
  <input type='hidden' name='task_id'  value=<?php echo $task_id ?>>
  <input type='hidden' name='question_type'  value=<?php echo $type ?>>
  <p>問題文</p>
  <textarea cols='30' rows='5' name='description'></textarea>
  </br>
   <p>解答</p>
   <textarea cols='30' rows='5' name='answer'></textarea>
   画像：<input type="file" name="file" accept="image/*">
   <input type='submit' value='登録'/>
   </form>
   <?php endif;?>