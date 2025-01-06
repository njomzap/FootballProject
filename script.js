document.addEventListener('DOMContentLoaded', function () {
    console.log("Script loaded successfully!");

    initializeMenuToggle();
    initializePagination();

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
                navLinks.classList.toggle('active');
            });

            const navItems = navLinks.querySelectorAll('a');
            navItems.forEach(item => {
                item.addEventListener('click', function () {
                    navLinks.classList.remove('active');
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

    function initializePagination() {
        const prevButton = document.getElementById('prev');
        const nextButton = document.getElementById('next');
        const tables = document.querySelectorAll('.table-wrapper');
        let currentPage = 0;

        function showTable(pageIndex) {
            tables.forEach((table, index) => {
                if (index === pageIndex) {
                    table.classList.add('active');
                } else {
                    table.classList.remove('active');
                }
            });
        }

        if (prevButton && nextButton) {
            prevButton.addEventListener('click', function () {
                if (currentPage > 0) {
                    currentPage--;
                    showTable(currentPage);
                }
            });

            nextButton.addEventListener('click', function () {
                if (currentPage < tables.length - 1) {
                    currentPage++;
                    showTable(currentPage);
                }
            });

            showTable(currentPage); 
            console.log("Pagination initialized!");
        } else {
            console.warn("Pagination buttons not found!");
        }
    }

    const addTeamForm = document.getElementById('addTeamForm');
    if (addTeamForm) {
        addTeamForm.addEventListener('submit', function (e) {
            const name = document.querySelector('#addTeamForm #name').value.trim();
            const stadium = document.querySelector('#addTeamForm #stadium').value.trim();
            const city = document.querySelector('#addTeamForm #city').value.trim();
            const founded = document.querySelector('#addTeamForm #founded').value.trim();
            const manager = document.querySelector('#addTeamForm #manager').value.trim();
            const country = document.querySelector('#addTeamForm #country').value.trim();

            if (!name) {
                alert('Team Name is required!');
                e.preventDefault();
                return;
            }

            if (!stadium) {
                alert('Stadium is required!');
                e.preventDefault();
                return;
            }

            if (!city) {
                alert('City is required!');
                e.preventDefault();
                return;
            }

            if (!founded || isNaN(founded)) {
                alert('Founded year is required and must be a number!');
                e.preventDefault();
                return;
            }

            if (!manager) {
                alert('Manager is required!');
                e.preventDefault();
                return;
            }

            if (!country) {
                alert('Country is required!');
                e.preventDefault();
                return;
            }

            console.log('Add team form validation passed');
        });
    }

    highlightActiveLink();
});




