let authNav = document.querySelectorAll('.auth-modal');
let modalAuth = document.querySelector('.modal-auth');
let closeBtn = document.querySelector('.close-modal');

authNav.forEach(auth => {
    auth.addEventListener("click", () => {
        modalAuth.style.display = "flex";
        
        closeBtn.addEventListener("click", () => {
            modalAuth.style.display = "none";
        })
    })
});


let inscriptionBtn = document.querySelector('.inscription');
let formInscription = document.querySelector('.form-inscription');
let contentInscription = document.querySelector('.content-inscription');

let connexionBtn = document.querySelector('.connexion');
let formConnexion = document.querySelector('.form-connexion');
let contentConnexion = document.querySelector('.content-connexion');

inscriptionBtn.addEventListener('click', () => {
    formConnexion.style.display = "none";
    contentInscription.style.display = "none";
    formInscription.style.display = "flex";
    contentConnexion.style.display = "block";
});

connexionBtn.addEventListener('click', () => {
    formConnexion.style.display = "flex";
    contentInscription.style.display = "block";
    formInscription.style.display = "none";
    contentConnexion.style.display = "none";
})

/**
 * API ASSOCIE CODE POSTAL A LA/LES COMMUNE(S)
 * API ASSOCIE CODE POSTAL A LA/LES COMMUNE(S)
 * API ASSOCIE CODE POSTAL A LA/LES COMMUNE(S)
 */
let urlApi = "https://geo.api.gouv.fr/communes?codePostal=";
let format = "&format=json";

let zipcodeInput = document.querySelector('.zipcode');
let villeList = document.querySelector('select.city');

let array = [];
let optionArray = [];
let option;

function createOption() {
    option = document.createElement('option');
}
function fillOption(a) {
    option.textContent = a;
    option.value = a;
}
function appendOption() {
    villeList.append(option);
    optionArray.push(option);
}

// push data to array
function pushData(apiData) {
    array = [];
    removeAllOptions()

    apiData.forEach(data => {
        array.push(data.nom);
    });
}

function createOptionFromArray() {
    array.forEach(cityName => {
        createOption();
        fillOption(cityName);
        appendOption();
    })
}

function removeAllOptions() {
    optionArray.forEach(opt => {
        opt.remove();
    })
}

zipcodeInput.addEventListener('blur', () => {
    let nom = zipcodeInput.value;
    let url = urlApi + nom + format;

    fetch(url, {
        method: 'get'
    }).then(response => response.json().then(results => {
        pushData(results);
        createOptionFromArray();
    }))
})
 /**
* API ASSOCIE CODE POSTAL A LA/LES COMMUNE(S)
* API ASSOCIE CODE POSTAL A LA/LES COMMUNE(S)
* API ASSOCIE CODE POSTAL A LA/LES COMMUNE(S)
*/


let closeAlert = document.querySelector('.close-alert');
let alertBug = document.querySelector('.alert');

closeAlert.addEventListener('click', () => {
    alertBug.style.display = "none";
})