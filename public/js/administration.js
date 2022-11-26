let supprBtnModal = document.querySelectorAll('.modal-btn-suppr');
let closeBtn2 = document.querySelector('.close-modal-2');
let annulerBtn = document.querySelector('.annule-btn');

let modalDelete = document.querySelector('.modal');

let formDelete = document.querySelector('.delete-user');
let url = "http://localhost/blog/deleteUser/";

supprBtnModal.forEach(suppr => {
    suppr.addEventListener('click', () => {
        
        modalDelete.style.display = "flex";
        formDelete.setAttribute('action', url + suppr.id);

        closeBtn2.addEventListener('click', () => {
            modalDelete.style.display = "none";
        })

        annulerBtn.addEventListener('click', () => {
            modalDelete.style.display = "none";
        })
    })
});