<?php if(isset($user) && $user->getUserType() == 1): ?>
    <div id="sidebar">
        <nav id="mySidenav" class="sidenav">
            <button class="closebtn" aria-label="Close navigation menu">&times;</button>
            
            <div class="nav-group">
                <a href="../Controller/index.php?action=show_Profile" class="nav-link">
                    <img src="../logo/profile.png" alt="Profile" class="nav-icon">
                    <span class="nav-label">Profile</span>
                </a>

                <a href="../Controller/index.php?action=show_conversations" class="nav-link">
                    <img src="../logo/chat.png" alt="Chats" class="nav-icon">
                    <span class="nav-label">Chats</span>
                </a>
                
                <a href="../Controller/index.php?action=show_clientHome" class="nav-link">
                    <img src="../logo/home.png" alt="Home" class="nav-icon">
                    <span class="nav-label">Home</span>
                </a>
                
                <a href="../Controller/index.php?action=logout" class="nav-link">
                    <img src="../logo/logout.png" alt="Logout" class="nav-icon">
                    <span class="nav-label">Logout</span>
                </a>
            </div>
        </nav>
    </div>
    <?php endif; ?>