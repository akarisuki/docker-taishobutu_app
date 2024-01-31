document.getElementById('modalView').addEventListener('click', () => {
  const modalbtn = document.getElementById('firstTimeModal');
       modalbtn.classList.add('is-show');
  });
  
  document.getElementById('js-black-bg').addEventListener('click', () => {
  const modalClose = document.getElementById('firstTimeModal');
       modalClose.classList.remove('is-show');
  });
  document.getElementById('modalCloseCloss').addEventListener('click', () => {
  const modalClose = document.getElementById('firstTimeModal');
       modalClose.classList.remove('is-show');
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




$('#toggle-table-view').on('click', function(event){
  event.preventDefault(); // デフォルトのイベントをキャンセル
  $('.table-container').toggleClass('scrollable');
  $('.hide-on-mobile').toggleClass('show-on-mobile');
});
