$(document).ready(function () {
  let editMode = false;
  let editId = null;

  $(".edit-btn").on("click", function () {
    const id = $(this).data("id");
    editId = id;
    editMode = true;

    const row = $(this).closest("tr");
    const director = row.find("td:eq(1) .display-value").text();
    const name = row.find("td:eq(2) .display-value").text();
    const appointmentDate = row.find("td:eq(3) .display-value").text();
    const firePlanDate = row.find("td:eq(4) .display-value").text();

    $("input[name='fire_safety_manager_director']").val(director);
    $("input[name='fire_safety_manager_name']").val(name);
    $("input[name='appointment_date']").val(appointmentDate);
    $("input[name='fire_plan_date']").val(firePlanDate);

    $("input[name='fire_safety_manager_code']").val(id);
    $("input[type='submit']").val("更新");
  });

  $(".delete-btn").on("click", function () {
    const id = $(this).data("id");

    if (confirm("本当に削除しますか？")) {
      $.post("fire_safety_manager_delete.php", { fire_safety_manager_code: id }, function (data) {
        location.reload();
      });
    }
  });

  $(".existingDataForm").on("submit", function (e) {
    e.preventDefault();

    const url = editMode ? "fire_safety_manager_update.php" : "fire_safety_manager_add.php";
    const formData = $(this).serialize();

    $.post(url, formData, function (data) {
      location.reload();
    });
  });
});

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
//カラムスクロール表示
$(function(){
  $('#toggle-table-view').on('click', function(){
    $('.table-container').toggleClass('scrollable');
  });
});