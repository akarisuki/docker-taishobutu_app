


function showConfirmModal(callback) {
    const confirmModal = new bootstrap.Modal(document.getElementById('confirmModal'));
    const confirmButton = document.getElementById('confirmButton');
    const cancelButton = document.querySelector('#confirmModal .btn-secondary');

    confirmButton.addEventListener('click', function () {
      confirmModal.hide();
      callback(true);
      resetModal();
    });
    function resetModal() {
      confirmButton.removeEventListener('click', callback);
      cancelButton.removeEventListener('click', resetModal);
    }

      confirmModal.show();
}


function handleDelete() {
  showConfirmModal(function (confirmed) {
    if (confirmed) {
      console.log('削除が確認されました');
      // 削除処理をここで実行します
    } else {
      console.log('削除がキャンセルされました');
    }
  });
}

function showAlert(message) {
  alert(message);
}


//モーダル表示
$(".modal-open").modaal({
start_open:flag, // ページロード時に表示するか
overlay_close:true,//モーダル背景クリック時に閉じるか
before_open:function(){// モーダルが開く前に行う動作
$('html').css('overflow-y','hidden');/*縦スクロールバーを出さない*/
},
after_close:function(){// モーダルが閉じた後に行う動作
$('html').css('overflow-y','scroll');/*縦スクロールバーを出す*/
}
});
//エラーメッセージ
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
      
        e.preventDefault();
  
        const url =  editMode ? "inspection_status_update.php" : "inspection_status_add.php";
        const formData = $(this).serialize();
  
        $.post(url, formData, function (data) {
          location.reload();
        });
    });
  });
  
  