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

document.getElementById("yourFormId").addEventListener("submit", function(e) {
  const inputFields = document.querySelectorAll("input[type='text']"); // 入力フィールドのタイプに合わせて調整してください
  
  for (const field of inputFields) {
      if (field.value.trim() === "") {
          alert("全てのフィールドを入力してください。");
          e.preventDefault(); // フォームの送信を防ぐ
          return;
      }
  }
});