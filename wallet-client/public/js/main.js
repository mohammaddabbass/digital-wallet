// navbar scroll effect

let lastScrollY = window.scrollY;
const header = document.getElementById("header");

window.addEventListener("scroll", () => {
    if (window.scrollY > lastScrollY) {
        header.classList.add("hidden");
    } else {
        header.classList.remove("hidden");
    }
    lastScrollY = window.scrollY;
});


// sidebar responsiveness 
const sidebarBurgerMenu = document.querySelector('.sidebar-burger-menu');
const sidebar = document.querySelector('.sidebar');

sidebarBurgerMenu.addEventListener('click', () => {
    sidebar.classList.toggle('active-s');
    sidebarBurgerMenu.classList.toggle('active-s');
});

document.addEventListener('click', (e) => {
    if (!sidebar.contains(e.target) && !sidebarBurgerMenu.contains(e.target)) {
        sidebar.classList.remove('active-s');
        sidebarBurgerMenu.classList.remove('active-s');
    }
});

window.addEventListener('resize', () => {
    if (window.innerWidth > 768) {
        sidebar.classList.remove('active-s');
        sidebarBurgerMenu.classList.remove('active-s');
    }
});




// mobile menu 

const burgerMenu = document.querySelector('.burger-menu');
const navbar = document.querySelector('.navbar');
const navLinks = document.querySelectorAll('.nav-ul li a');


burgerMenu.addEventListener('click', () => {
    navbar.classList.toggle('active');
});

document.addEventListener('click', (e) => {
    if (!navbar.contains(e.target) && !burgerMenu.contains(e.target)) {
        navbar.classList.remove('active');
    }
});

navLinks.forEach(link => {
    link.addEventListener('click', () => {
        navbar.classList.remove('active');
    });
});



function switchForm(mode) {
    const loginForm = document.getElementById('loginForm');
    const registerForm = document.getElementById('registerForm');
    const loginPage = document.querySelector('.login-page');

    if (mode === 'register') {
        loginPage.classList.add('register-active');
    } else {// Reset to login mode
    }
}
// function switchForm(formType) {
//     const loginForm = document.getElementById('loginForm');
//     const registerForm = document.getElementById('registerForm');

//     if (formType === 'register') {
//         loginForm.classList.add('slide-out-right');
//         registerForm.classList.add('slide-in-left');
//     } else {
//         loginForm.classList.remove('slide-out-right');
//         registerForm.classList.remove('slide-in-left');
//     }
// }

