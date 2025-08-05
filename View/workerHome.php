<?php include 'workerHeader.php'; ?>

<div id="decorations">
    <div id="decorationImageSection">
        <img id="decorationImage" src="" alt="Worker Portfolio">
    </div>
</div>

<aside id="workerMenuWrapper">
    <div id="workerMenu">
        <a href="../Controller/index.php?action=show_Profile" class="worker-option">
            <img src="../logo/profile.png" class="logo" alt="Profile Icon">
            <p class="logoName">Profile</p>
        </a>
        <a href="../Controller/index.php?action=show_conversations" class="worker-option">
            <img src="../logo/chat.png" class="logo" alt="Chat Icon">
            <p class="logoName">Chats</p>
        </a>
        <a href="#" class="worker-option">
            <img src="../logo/feed.png" class="logo" alt="Jobs Feed Icon">
            <p class="logoName">Jobs Feed</p>
        </a>
        <a href="../Controller/index.php?action=logout" class="worker-option">
            <img src="../logo/logout.png" class="logo" alt="Logout Icon">
            <p class="logoName">Logout</p>
        </a>
    </div>
    <button id="workerMenuToggle" onclick="toggleWorkerMenu()">
        <img src="../logo/chevron-back-outline.svg" alt="Toggle Icon">
    </button>
</aside>


<script>
    // JavaScript remains the same, but could be moved to external file
    let pictures = [];
    var index = 1;

    setInterval(changePicture, 5000);

    let menuToggled = false;
    function toggleWorkerMenu() {
        const wrapper = document.getElementById("workerMenuWrapper");
        wrapper.style.left = menuToggled ? "-200px" : "0px";
        menuToggled = !menuToggled;
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
                    error: function() {
                        console.error("Error with location AJAX");
                    }
                });
            }
        } else {
            console.warn("Geolocation is not supported by this browser.");
        }
    }

    function changePicture() {
        if (pictures.length > 0) {
            document.getElementById("decorationImage").src = "../tradesPeoplePictures/" + pictures[index];
            index = (index >= pictures.length - 1) ? 0 : index + 1;
        }
    }

    function getPictures() {
        $.ajax({
            url: "../Controller/index.php",
            type: 'post',
            data: {
                action: "get_Worker_Pictures"
            },
            success: function(data) {
                pictures = JSON.parse(data);
                if (pictures.length > 0) {
                    document.getElementById("decorationImage").src = "../tradesPeoplePictures/" + pictures[0];
                }
            },
            error: function() {
                console.error("Error loading pictures");
            }
        });
    }

    window.addEventListener('load', function() {
        getPictures();
        getLocation();
    });
</script>

<?php include 'workerFooter.php'; ?>