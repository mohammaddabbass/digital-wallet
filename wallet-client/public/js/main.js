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


// alert("hello from the js file")

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
// login animation


function switchForm(formType) {
    const loginForm = document.getElementById("loginForm");
    const registerForm = document.getElementById("registerForm");

    if (formType === 'register') {
        loginForm.classList.add();
        registerForm.classList.add();
    } else {
        loginForm.classList.remove();
        registerForm.classList.remove();
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
