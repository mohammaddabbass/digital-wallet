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
