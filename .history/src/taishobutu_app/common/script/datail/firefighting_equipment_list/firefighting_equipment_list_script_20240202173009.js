document.addEventListener("DOMContentLoaded", function() {
  setTimeout(function() {
      var flashMessage = document.getElementById('flashMessage');
      if(flashMessage) {
          flashMessage.style.opacity = '0';
          setTimeout(function() {
              flashMessage.style.display = 'none';
          }, 1000); // 1秒後に非表示
      }
  }, 5000); // 5秒後に透明度を0に
});

// document.getElementById("yourFormId").addEventListener("submit", function(e) {
//   const inputFields = document.querySelectorAll("input[type='text']"); // 入力フィールドのタイプに合わせて調整してください
  
//   for (const field of inputFields) {
//       if (field.value.trim() === "") {
//           alert("全てのフィールドを入力してください。");
//           e.preventDefault(); // フォームの送信を防ぐ
//           return;
//       }
//   }
// });

function toggleValue(checkboxElem) {
  const hiddenInput = document.getElementById(checkboxElem.id + 'Hidden');
  const displayLabel = document.getElementById(checkboxElem.id + 'Label');
  if (checkboxElem.checked) {
      hiddenInput.value = '◯';
      displayLabel.innerText = '◯';
  } else {
      hiddenInput.value = '×';
      displayLabel.innerText = '×';
  }
}

function submitForm(formId) {
  document.getElementById(formId).submit();
}

$(function(){
  // ハンバーガーメニューのチェックボックスの状態を監視
  $('#switch').on('change', function(){
    if($(this).is(':checked')) {
      // メニューが開いているときはボタンを非表示にする
      $('#equipment_edit_button, #equipment_add_done_button').css('display', 'none');
    } else {
      // メニューが閉じているときはボタンを表示する
      $('#equipment_edit_button, #equipment_add_done_button').css('display', 'inline-block');
    }
  });
});