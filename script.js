document.addEventListener('DOMContentLoaded', function () {
    console.log("Script loaded successfully!");

    
    const headerPlaceholder = document.getElementById('header-placeholder');
    if (headerPlaceholder) {
        const currentPath = window.location.pathname;
        const headerPath = currentPath.includes('/nav-bar/') ? '../helpers/header.html' : 'helpers/header.html';

        fetch(headerPath)
            .then(response => {
                if (!response.ok) {
                    throw new Error(`HTTP error! Status: ${response.status}`);
                }
                return response.text();
            })
            .then(data => {
                headerPlaceholder.innerHTML = data;
                initializeMenuToggle();
                highlightActiveLink();
            })
            .catch(err => console.error('Error loading header:', err));
    } else {
        console.error('Header placeholder not found!');
    }
    const footerPlaceholder = document.getElementById('footer-placeholder');
    if (footerPlaceholder) {
        const currentPath = window.location.pathname;
        const footerPath = currentPath.includes('/nav-bar/') ? '../helpers/footer.html' : 'helpers/footer.html';

        fetch(footerPath)
            .then(response => {
                if (!response.ok) {
                    throw new Error(`HTTP error! Status: ${response.status}`);
                }
                return response.text();
            })
            .then(data => {
                footerPlaceholder.innerHTML = data;
            })
            .catch(err => console.error('Error loading footer:', err));
    } else {
        console.error('Footer placeholder not found!');
    }
    
    const loginForm = document.getElementById('login-form');
    if (loginForm) {
        loginForm.addEventListener('submit', function (e) {
            const username = document.querySelector('#login-form #username').value.trim();
            const password = document.querySelector('#login-form #password').value.trim();

            if (!username) {
                alert('Username or Email is required!');
                e.preventDefault();
                return;
            }

            if (!password) {
                alert('Password is required!');
                e.preventDefault();
                return;
            }

            console.log('Login validation passed');
        });
    }

    
    const registerForm = document.getElementById('register-form');
    if (registerForm) {
        registerForm.addEventListener('submit', function (e) {
            const firstName = document.querySelector('#register-form #first-name').value.trim();
            const lastName = document.querySelector('#register-form #last-name').value.trim();
            const username = document.querySelector('#register-form #username').value.trim();
            const email = document.querySelector('#register-form #email').value.trim();
            const password = document.querySelector('#register-form #password').value.trim();

            if (!firstName) {
                alert('First Name is required!');
                e.preventDefault();
                return;
            }

            if (!lastName) {
                alert('Last Name is required!');
                e.preventDefault();
                return;
            }

            if (!username) {
                alert('Username is required!');
                e.preventDefault();
                return;
            }

            if (!email || !/\S+@\S+\.\S+/.test(email)) {
                alert('A valid Email is required!');
                e.preventDefault();
                return;
            }

            if (!password || password.length < 8) {
                alert('Password must be at least 8 characters long!');
                e.preventDefault();
                return;
            }

            console.log('Register validation passed');
        });
    }

    
    function initializeMenuToggle() {
        const toggleButton = document.querySelector('.menu-toggle');
        const navLinks = document.querySelector('.nav-links');

        if (toggleButton && navLinks) {
            toggleButton.addEventListener('click', function () {
                const isActive = navLinks.classList.toggle('active');
                toggleButton.classList.toggle('hidden', isActive);
            });

            const navItems = navLinks.querySelectorAll('a');
            navItems.forEach(item => {
                item.addEventListener('click', function () {
                    navLinks.classList.remove('active');
                    toggleButton.classList.remove('hidden');
                });
            });

            console.log("Menu toggle initialized!");
        } else {
            console.warn("Menu toggle or nav links not found!");
        }
    }

   
    function highlightActiveLink() {
        const navLinkItems = document.querySelectorAll('.nav-links a');

        if (navLinkItems.length > 0) {
            navLinkItems.forEach(link => {
                if (link.href === window.location.href) {
                    link.classList.add('active');
                }
            });

            console.log("Active link highlighting initialized!");
        } else {
            console.warn("No navigation links found!");
        }
    }

    
    function initializeCarousel() {
        const sections = document.querySelectorAll('.table-wrapper');
        const prevButton = document.getElementById('prev');
        const nextButton = document.getElementById('next');
        let currentIndex = 0;

        if (!sections.length || !prevButton || !nextButton) {
            console.warn("Carousel elements not found!");
            return;
        }

        function updateSections() {
            sections.forEach((section, index) => {
                section.classList.toggle('active', index === currentIndex);
            });

            prevButton.disabled = currentIndex === 0;
            nextButton.disabled = currentIndex === sections.length - 1;
        }

        prevButton.addEventListener('click', () => {
            if (currentIndex > 0) {
                currentIndex--;
                updateSections();
            }
        });

        nextButton.addEventListener('click', () => {
            if (currentIndex < sections.length - 1) {
                currentIndex++;
                updateSections();
            }
        });

        updateSections();
    }

    initializeCarousel();
});
