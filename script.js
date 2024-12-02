document.addEventListener('DOMContentLoaded', function () {
    console.log("Script loaded successfully!");
    const headerPlaceholder = document.getElementById('header-placeholder');
    if (headerPlaceholder) {
        const currentPath = window.location.pathname;
        let headerPath;

        // Determine the correct path for the header
        if (currentPath.includes('/nav-bar/')) {
            headerPath = '../helpers/header.html';
        } else {
            headerPath = 'helpers/header.html';
        }

        fetch(headerPath)
            .then(response => {
                if (!response.ok) {
                    throw new Error(`HTTP error! Status: ${response.status}`);
                }
                return response.text();
            })
            .then(data => {
                headerPlaceholder.innerHTML = data;

                // Initialize features after the header loads
                initializeMenuToggle();
                highlightActiveLink();
            })
            .catch(err => console.error('Error loading header:', err));
    } else {
        console.error('Header placeholder not found!');
    }
})