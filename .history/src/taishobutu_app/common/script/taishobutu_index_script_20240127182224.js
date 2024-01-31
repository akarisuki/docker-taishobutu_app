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



function clearForm() {
  document.querySelector('input[name="search_taishobutu_name"]').value = '';
  document.querySelector('input[name="search_taishobutu_address"]').value = '';
  document.querySelector('input[name="search_total_area"]').value = '';
  document.querySelector('select[name="search_appendix"]').value = 0;
  document.querySelector('input.search_submit').click();
  document.querySelector('input.crear-modal').click();
}

function confirmDelete() {
  return confirm("選択されたレコードを削除してもよろしいですか？");
}

function confirmDeleteAll() {
  return confirm("全部のレコードを削除してもよろしいですか？");
}

// function showConfirmModal(callback) {
//     const confirmModal = new bootstrap.Modal(document.getElementById('confirmModal'));
//     const confirmButton = document.getElementById('confirmButton');
//     const cancelButton = document.querySelector('#confirmModal .btn-secondary');

//     confirmButton.addEventListener('click', function () {
//       confirmModal.hide();
//       callback(true);
//       resetModal();
//     });
//     function resetModal() {
//       confirmButton.removeEventListener('click', callback);
//       cancelButton.removeEventListener('click', resetModal);
//     }

//       confirmModal.show();
// }

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


//モーダル表示
// $(".modal-open").modaal({
  
//   overlay_close: true, // モーダル背景クリック時に閉じるか
//   before_open: function() { // モーダルが開く前に行う動作
//     $('html').css('overflow-y', 'hidden'); // 縦スクロールバーを出さない
//   },
//   after_close: function() { // モーダルが閉じた後に行う動作
//     $('html').css('overflow-y', 'scroll'); // 縦スクロールバーを出す
//   }
// });

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

$(document).ready(function() {
  $('#toggle-table-view').on('click', function() {
    $('.hide-on-mobile').toggleClass('show-on-mobile');
  });
});
  
  
