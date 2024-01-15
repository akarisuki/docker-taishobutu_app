$(document).ready(function() {				
  const $body = $('body');				
  const $modal = $('#modal');				
  const $modalOpenButton = $('.js-modal-open');				
  const $modalCloseButton = $('.js-modal-close');				
          
  const openModal = () => {				
  $modal.fadeIn();				
  $body.css('overflow', 'hidden');				
  };				
          
  const closeModal = () => {				
  $modal.fadeOut();				
  $body.css('overflow', 'auto');				
  };				
          
  const onClickOutside = (event) => {				
  if ($modal.is(event.target)) closeModal();				
  }				
          
  $modalOpenButton.on('click', openModal);				
  $modalCloseButton.on('click', closeModal);				
  $modal.on('click', onClickOutside);				
  });		

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

function clearForm() {
  document.querySelector('input[name="search_taishobutu_name"]').value = '';
  document.querySelector('input[name="search_taishobutu_address"]').value = '';
  document.querySelector('input[name="search_total_area"]').value = '';
  document.querySelector('select[name="search_appendix"]').value = 0;
  document.querySelector('.search_submit').click();
}

function confirmDelete() {
  return confirm("選択されたレコードを削除してもよろしいですか？");
}

function confirmDeleteAll() {
  return confirm("全部のレコードを削除してもよろしいですか？");
}

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

async function handleDeleteAll() {
  const response = confirm('本当に全て削除してよろしいですか？');

  if (response) {
    const form = document.createElement('form');
    form.method = 'POST';
    form.action = 'taishobutu_delete_all.php';

    document.body.appendChild(form);
    form.submit();
  }
}

function submitForm(formId) {
  document.getElementById(formId).submit();
}

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




$(function(){
$('#switch').on('change', function(){
var st = $(window).scrollTop();
if($(this).prop("checked") == true) {
  $('html').addClass('scroll-prevent');
  $('html').css('top', -(st) + 'px');
  $('#switch').on('change', function(){
    if($(this).prop("checked") !== true) {
      $('html').removeClass('scroll-prevent');
      $(window).scrollTop(st);
    }
  });
}
});
$('.header_menu a[href]').on('click', function(event) {
$('#switch').prop('checked', false);
});
$('.header_menu a').on('click', function(){
var st = $(window).scrollTop();
  $('html').removeClass('scroll-prevent');
  $('html').css('top', -(st) + 'px');
  $('.header_menu a').on('change', function(){
  });

});
});

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
