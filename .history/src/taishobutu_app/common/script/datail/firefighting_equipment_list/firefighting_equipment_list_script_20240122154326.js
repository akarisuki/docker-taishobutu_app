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