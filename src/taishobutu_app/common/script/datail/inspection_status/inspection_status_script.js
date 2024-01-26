
  $(document).ready(function () {
    let editMode = false;
    let editId = null;
  
    $(".edit-btn").on("click", function () {
      const id = $(this).data("id");
      editId = id;
      editMode = true;
  
      const row = $(this).closest("tr");
      const inspection_date = row.find("td:eq(1) .display-value").text();
      const inspection_name = row.find("td:eq(2) .display-value").text();
      const instructions = row.find("td:eq(3) .display-value").text();
      const remarks = row.find("td:eq(4) .display-value").text();
  
      $("input[name='inspection_date']").val(inspection_date);
      $("input[name='inspection_name']").val(inspection_name);
      $("input[name='instructions']").val(instructions);
      $("input[name='remarks']").val(remarks);
  
      $("input[name='inspection_status_code']").val(id);
      $("input[type='submit']").val("更新");
    });
  
    $(".delete-btn").on("click", function () {
      const id = $(this).data("id");
  
      if (confirm("本当に削除しますか？")) {
        $.post("inspection_status_delete.php", 
        { inspection_status_code: id }, 
          function (data) {
          location.reload();
        });
      }
    });
  
    $(".existingDataForm").on("submit", function (e) {
      if(editMode) {
        e.preventDefault();
  
        const url =   "inspection_status_update.php" ;
        const formData = $(this).serialize();
  
        $.post(url, formData, function (data) {
          location.reload();
        });
      }
    });
  });
  
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
//カラムスクロール表示
$(function(){
  $('#toggle-table-view').on('click', function(){
    $('.table-container').toggleClass('scrollable');
  });
});

new ScrollHint('.js-scrollable');
