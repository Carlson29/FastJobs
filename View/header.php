<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php 
    echo htmlspecialchars($pageTitle); ?>
    </title>
    <link rel="stylesheet" href="../css/styles.css">
    <!-- Favicon would go here -->
</head>
<body>
    <header id="header">
        <?php if(isset($user) && $user->getUserType() == 1): ?>
            <button id="openSideBar" class="menu-toggle" aria-label="Open navigation menu">
                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 16">
                    <path d="M16 14a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12zm-4.5-6.5H5.707l2.147-2.146a.5.5 0 1 0-.708-.708l-3 3a.5.5 0 0 0 0 .708l3 3a.5.5 0 0 0 .708-.708L5.707 8.5H11.5a.5.5 0 0 0 0-1z"/>
                </svg>
            </button>
        <?php endif; ?>

        <div id="mainLogoSection">
            <img src="../logo/main2.png" alt="Company Logo" id="mainLogo">
        </div>
    </header>

    <?php if(isset($user) && $user->getUserType() == 1): ?>
    <aside id="sidebar">
        <nav id="mySidenav" class="sidenav">
            <button class="closebtn" aria-label="Close navigation menu">&times;</button>
            
            <div class="nav-group">
                <a href="../Controller/index.php?action=show_conversations" class="nav-link">
                    <img src="/logo/chat.png" alt="" class="nav-icon">
                    <span class="nav-label">Chats</span>
                </a>
                
                <a href="../Controller/index.php?action=show_Profile" class="nav-link">
                    <img src="/logo/profile.png" alt="" class="nav-icon">
                    <span class="nav-label">Profile</span>
                </a>
                
                <a href="../Controller/index.php?action=show_clientHome" class="nav-link">
                    <img src="/logo/home.png" alt="" class="nav-icon">
                    <span class="nav-label">Home</span>
                </a>
                
                <a href="../Controller/index.php?action=logout" class="nav-link">
                    <img src="/logo/logout.png" alt="" class="nav-icon">
                    <span class="nav-label">Logout</span>
                </a>
            </div>
        </nav>
    </aside>
    <?php endif; ?>

    <script>
    // Navigation Toggle Functionality
    document.addEventListener('DOMContentLoaded', function() {
        const openBtn = document.getElementById('openSideBar');
        const closeBtn = document.querySelector('.closebtn');
        const sideNav = document.getElementById('mySidenav');
        
        if (openBtn && closeBtn && sideNav) {
            openBtn.addEventListener('click', function() {
                sideNav.classList.add('open');
            });
            
            closeBtn.addEventListener('click', function() {
                sideNav.classList.remove('open');
            });
        }

        // Close nav when clicking outside
        document.addEventListener('click', function(event) {
            if (sideNav && sideNav.classList.contains('open')) {
                if (!event.target.closest('#mySidenav') && 
                    !event.target.closest('#openSideBar')) {
                    sideNav.classList.remove('open');
                }
            }
        });
        
        // Escape key closes nav
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape' && sideNav && sideNav.classList.contains('open')) {
                sideNav.classList.remove('open');
            }
        });
    });

    // Form Validation Helper (example)
    function validateForm(formId) {
        const form = document.getElementById(formId);
        if (!form) return false;
        
        let isValid = true;
        const inputs = form.querySelectorAll('input[required]');
        
        inputs.forEach(input => {
            if (!input.value.trim()) {
                input.classList.add('error');
                isValid = false;
            } else {
                input.classList.remove('error');
            }
        });
        
        return isValid;
    }
    </script>