$(document).ready(function () {
  let editMode = false;
  let editId = null;

  $(".edit-btn").on("click", function () {
    const id = $(this).data("id");
    editId = id;
    editMode = true;

    const row = $(this).closest("tr");
    const report_date = row.find("td:eq(1) .display-value").text();
    const deficiency = row.find("td:eq(2) .display-value").text();
    const inspector = row.find("td:eq(3) .display-value").text();
    const remarks = row.find("td:eq(4) .display-value").text();

    $("input[name='report_date']").val(report_date);
    $("input[name='deficiency']").val(deficiency);
    $("input[name='inspector']").val(inspector);
    $("input[name='remarks']").val(remarks);

    $("input[name='fire_equipment_report_code']").val(id);
    $("input[type='submit']").val("更新");
  });

  $(".delete-btn").on("click", function () {
    const id = $(this).data("id");
    const codeValue = $("input[name='code']").val(); 

    if (confirm("本当に削除しますか？")) {
      $.post("fire_equipment_report_delete.php", 
      { fire_equipment_report_code: id,}, 
      function (data) {
        location.reload();
      });
    }
  });

  $(".existingDataForm").on("submit", function (e) {
      e.preventDefault();

      const url = editMode ? "fire_equipment_report_update.php" : "fire_equipment_report_add.php";
      const formData = $(this).serialize();

      $.post(url, formData, function (data) {
        location.reload();
      });
    
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