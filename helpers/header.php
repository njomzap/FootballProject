<nav class="navbar">
    <div class="logo">Superliga</div>
    <button class="menu-toggle" aria-label="Toggle Menu">☰</button>
    <ul class="nav-links">
        <li><a href="/footballproject/index.php">Home</a></li>
        <li><a href="/footballproject/nav-bar/matches.php">Matches</a></li>
        <li><a href="/footballproject/nav-bar/teams.php">Teams</a></li>
        <li><a href="/footballproject/nav-bar/about.php">About</a></li>

        <?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true): ?>
            <li><a href="/footballproject/dashboard.php">Dashboard</a></li>
            <li><a href="/footballproject/classes/logout.php">Logout</a></li>
        <?php else: ?>
            <li><a href="/footballproject/nav-bar/login.php">Login</a></li>
        <?php endif; ?>
    </ul>
</nav>


