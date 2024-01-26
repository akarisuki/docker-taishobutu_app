
//ボタン
function submitForm(formId) {
  document.getElementById(formId).submit();
}
//メッセージ
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

$(function(){
  // ハンバーガーメニューのチェックボックスの状態を監視
  $('#switch').on('change', function(){
    if($(this).is(':checked')) {
      // メニューが開いているときはボタンを非表示にする
      $('#datail_edit_button').css('display', 'none');
    } else {
      // メニューが閉じているときはボタンを表示する
      $('#datail_edit_button').css('display', 'inline-block');
    }
  });
});

$(function(){
  // ハンバーガーメニューのチェックボックスの状態を監視
  $('#switch').on('change', function(){
    if($(this).is(':checked')) {
      // メニューが開いているときはボタンを非表示にする
      $('#datail_edit_button').css('display', 'none');
    } else {
      // メニューが閉じているときはボタンを表示する
      $('#datail_edit_button').css('display', 'inline-block');
    }
  });
});