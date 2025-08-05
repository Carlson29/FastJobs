<?php include 'header.php'; ?>
<link rel="stylesheet" href="../css/clientStyles.css">

<body onload="getLocation()">
    <div id="search-suggest">
        <div id="searchBar">
            <input placeholder="Search workers or categories" id="search">
            <div id="suggestions"></div>
        </div>
    </div>

    <aside id="clientMenuWrapper">
        <div id="clientMenu">
            <a href="../Controller/index.php?action=show_Profile" class="client-option">
                <img src="../logo/profile.png" class="logo" alt="Profile Icon">
                <p class="logoName">Profile</p>
            </a>
            <a href="../Controller/index.php?action=show_conversations" class="client-option">
                <img src="../logo/chat.png" class="logo" alt="Chat Icon">
                <p class="logoName">Chats</p>
            </a>
            <a href="#" class="client-option">
                <img src="../logo/feed.png" class="logo" alt="Feed Icon">
                <p class="logoName">Feed</p>
            </a>
            <a href="../Controller/index.php?action=logout" class="client-option">
                <img src="../logo/logout.png" class="logo" alt="Logout Icon">
                <p class="logoName">Logout</p>
            </a>
        </div>
        <button id="clientMenuToggle" onclick="toggleClientMenu()">
            <img src="../logo/chevron-back-outline.svg" alt="Toggle">
        </button>
    </aside>

    <!-- Main Content Area (scrollable) -->
    <div id="workers-container">
        <div id="workers">
            <!-- javascript here -->
            <!-- <?php for ($i = 0; $i < 24; $i++) { ?>
                <div class="worker-card">
                    <img src="../defaultPic/default.jpg" class="worker-picture" alt="Worker">
                    <div class="worker-details">
                        <div class="worker-name">BBB</div>
                        <a href="../Controller/index.php?action=show_conversations&otherUserId=<?= $i ?>" class="message-link">
                            <svg class="message-icon" viewBox="0 0 16 16">
                                <path d="M16 2a2 2 0 0 0-2-2H2a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h9.586a1 1 0 0 1 .707.293l2.853 2.853a.5.5 0 0 0 .854-.353V2zM3.5 3h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1 0-1zm0 2.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1 0-1zm0 2.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1 0-1z" />
                            </svg>
                        </a>
                        <p class="distance-away">122km away</p>
                    </div>
                </div>
            <?php } ?> -->
        </div>
    </div>


    <script>
        let clientMenuToggled = false;
        function toggleClientMenu() {
            const menu = document.getElementById("clientMenuWrapper");
            menu.style.left = clientMenuToggled ? "-200px" : "0px";
            clientMenuToggled = !clientMenuToggled;
        }

        function getLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(showPosition);

                function showPosition(position) {
                    let latitude = position.coords.latitude;
                    let longitude = position.coords.longitude;

                    $.ajax({
                        url: "../Controller/index.php",
                        type: 'post',
                        data: {
                            action: "store_Location",
                            "latitude": latitude,
                            "longitude": longitude
                        },
                        success: function(data) {
                            getUsersByLocation();
                        },
                        error: function() {
                            console.error("Error with location AJAX");
                        }
                    });
                }
            } else {
                console.warn("Geolocation not supported");
            }
        }

        function getUsersByLocation() {
            $.ajax({
                url: "../Controller/index.php",
                type: 'post',
                data: {
                    action: "get_Workers_By_Location"
                },
                success: function(data) {
                    var allUsers = JSON.parse(data);
                    var workersHTML = "";

                    allUsers.forEach(function(user) {
                        var profilePic = user[2] ? "../profilePics/" + user[2] : "../defaultPic/default.jpg";

                        workersHTML += `
                        <div class="worker-card">
                            <img src="${profilePic}" class="worker-picture" alt="${user[1]}">
                            <div class="worker-details">
                                <div class="worker-name">${user[1]}</div>
                                <a href="../Controller/index.php?action=show_conversations&otherUserId=${user[0]}" class="message-link">
                                    <svg class="message-icon" viewBox="0 0 16 16">
                                        <path d="M16 2a2 2 0 0 0-2-2H2a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h9.586a1 1 0 0 1 .707.293l2.853 2.853a.5.5 0 0 0 .854-.353V2zM3.5 3h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1 0-1zm0 2.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1 0-1zm0 2.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1 0-1z" />
                                    </svg>
                                </a>
                                <p class="distance-away">${user[3]} away</p>
                            </div>
                        </div>
                        `;
                    });

                    document.getElementById("workers").innerHTML = workersHTML;
                },
                error: function() {
                    console.error("Error loading workers");
                }
            });
        }

        // Rest of your existing JavaScript (search functionality, etc.)
        const entry = document.getElementById("search");
        var timeOutId = null;

        entry.addEventListener('input', function() {
            const searchInput = entry.value.trim();
            if (searchInput) {
                clearTimeout(timeOutId);
                timeOutId = setTimeout(function() {
                    $.ajax({
                        url: "../Controller/index.php",
                        type: 'post',
                        data: {
                            action: "search_Cat_Worker",
                            "searchInput": searchInput
                        },
                        success: function(data) {
                            var results = JSON.parse(data);
                            var suggestionsHTML = "";

                            results.forEach(function(item) {
                                if (item[2] == "u") {
                                    var profilePic = item[3] ? "../profilePics/" + item[3] : "../defaultPic/default.jpg";
                                    suggestionsHTML += `
                    <div class="suggestion-item">
                      <img src="${profilePic}" class="suggestion-pic" alt="${item[1]}">
                      <span class="suggestion-name">${item[1]}</span>
                    </div>`;
                                } else if (item[2] == "c") {
                                    suggestionsHTML += `
                    <div class="suggestion-item" onclick="getUserByCategoryId(${item[0]})">
                      <span class="suggestion-name">${item[1]}</span>
                    </div>`;
                                }
                            });

                            document.getElementById("suggestions").innerHTML = suggestionsHTML;
                        },
                        error: function() {
                            console.error("Search error");
                        }
                    });
                }, 500);
            }
        });

        document.addEventListener('click', function(event) {
            if (!document.getElementById('suggestions').contains(event.target)) {
                document.getElementById('suggestions').innerHTML = "";
            }
        });

        window.addEventListener('beforeunload', function() {
            $.ajax({
                url: "../Controller/index.php",
                type: 'post',
                data: {
                    action: "clear_DateTime"
                },
                error: function() {
                    console.error("Clear error");
                }
            });
        });
    </script>
</body>

<?php include 'footer.php'; ?>