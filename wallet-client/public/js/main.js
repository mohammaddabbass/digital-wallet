// Navbar scroll effect
let lastScrollY = window.scrollY;
const header = document.getElementById("header");

if (header) {
    window.addEventListener("scroll", () => {
        if (window.scrollY > lastScrollY) {
            header.classList.add("hidden");
        } else {
            header.classList.remove("hidden");
        }
        lastScrollY = window.scrollY;
    });
}

// Sidebar responsiveness 
const sidebarBurgerMenu = document.querySelector('.sidebar-burger-menu');
const sidebar = document.querySelector('.sidebar');

if (sidebarBurgerMenu && sidebar) {
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
}

// Mobile menu (Navbar burger menu)
const burgerMenu = document.querySelector('.burger-menu');
const navbar = document.querySelector('.navbar');
const navLinks = document.querySelectorAll('.nav-ul li a');

if (burgerMenu && navbar) {
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
}

// Form switching
function switchForm(formType) {
    const loginForm = document.getElementById("loginForm");
    const registerForm = document.getElementById("registerForm");
    const formTitle = document.getElementById("formTitle");
    const loginSvg = document.querySelector(".login-svg");
    const registerSvg = document.querySelector(".register-svg");

    if (!loginForm || !registerForm || !formTitle || !loginSvg || !registerSvg) return; // Prevent errors if elements are missing

    if (formType === "register") {
        loginForm.classList.add("fade-out");
        
        setTimeout(() => {
            loginForm.style.display = "none"; 
            registerForm.style.display = "flex"; 
            
            registerForm.classList.remove("fade-out");
            registerForm.classList.add("fade-in");

            formTitle.innerText = "Create an Account";
            loginSvg.style.display = "none";
            registerSvg.style.display = "flex";
        }, 500); 

    } else if (formType === "login") {
        registerForm.classList.add("fade-out");
        
        setTimeout(() => {
            registerForm.style.display = "none";
            loginForm.style.display = "flex"; 

            loginForm.classList.remove("fade-out");
            loginForm.classList.add("fade-in");

            formTitle.innerText = "Welcome!";
            registerSvg.style.display = "none";
            loginSvg.style.display = "flex";
        }, 500);
    }
}
