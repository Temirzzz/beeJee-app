let chiepsField = document.querySelector('.chieps-field');
let name = document.querySelector('.name');
let password = document.querySelector('.password');
document.querySelector('.form-submit-btn').onclick = checkInputs;

function checkInputs(e) {
    if (name.value == '' || password.value == '') {
        chipsCreate();
        return false;
    }
}

function chipsCreate() {
    let chips = document.createElement('div');
    chips.classList.add('chips');
    let message = document.createTextNode("Заполните поля!");
    chips.appendChild(message);
    chiepsField.appendChild(chips);

    setTimeout(() => {
        chipsRemove(chips);
    }, 3000)
}

function chipsRemove(chips) {
    chips.remove();
}