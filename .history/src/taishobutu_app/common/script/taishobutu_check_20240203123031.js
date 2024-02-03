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


