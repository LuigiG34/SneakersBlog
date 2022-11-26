let date = document.querySelector('.date').innerHTML;
let result = date.replace(/-/gi, "/");
document.querySelector('.date').innerHTML = result;

let date2 = document.querySelector('.date-2').innerHTML;
let result2 = date2.replace(/-/gi, "/");
document.querySelector('.date-2').innerHTML = result2;

let modifyTrigger = document.querySelector('.modify-trigger');
let modalUpdate = document.querySelector('.modal-update');

let closeBtn5 = document.querySelector('.close-modal-5');

modifyTrigger.addEventListener('click', () => {
    modalUpdate.style.display = "flex";

    closeBtn5.addEventListener('click', () => {
        modalUpdate.style.display = "none";
    })
})
