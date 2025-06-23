// Seleciona o container e os botões de alternância
const container = document.getElementById('container');
const registerBtn = document.getElementById('register');
const loginBtn = document.getElementById('login');

// Alterna para o modo de cadastro
registerBtn.addEventListener('click', () => {
    container.classList.add("active");
});

// Alterna para o modo de login
loginBtn.addEventListener('click', () => {
    container.classList.remove("active");
});