let ajtBtn = document.querySelector('.action-article');
let modalAdd = document.querySelector('.modal-add');
let closeBtn3 = document.querySelector('.close-modal-3');

ajtBtn.addEventListener('click', () => {
    modalAdd.style.display = "flex";

    closeBtn3.addEventListener('click', () => {
        modalAdd.style.display = "none";
    })
})

let supprArtBtn = document.querySelectorAll('.suppr-btn');
let supprArtModal = document.querySelector('.modal-suppr-art');
let closeBtn4 = document.querySelector('.close-modal-4');

let annulerBtnArt = document.querySelector('.annule-btn-art')
let formDeleteArt = document.querySelector('.delete-article');

let url = "http://localhost/blog/articles/delete/";

supprArtBtn.forEach(del => {
    del.addEventListener("click", () => {
        supprArtModal.style.display = "flex";
        formDeleteArt.setAttribute('action', url + del.id);

        closeBtn4.addEventListener('click', () => {
            supprArtModal.style.display = "none";
        })

        annulerBtnArt.addEventListener('click', () => {
            supprArtModal.style.display = "none";
        })
    })
});