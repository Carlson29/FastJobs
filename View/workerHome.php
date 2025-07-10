<?php include 'workerHeader.php'; ?>

<div id="decorations">
   <div id="decorationImageSection">
       <img id="decorationImage" src="" alt="Worker Portfolio">
   </div>
</div>

<div id="mainComponents">
    <div class="logoSection">
        <a href="../Controller/index.php?action=show_Profile" class="nav-link" aria-label="Profile">
            <img src="../logo/profile.png" class="logo" id="profileImage" alt="Profile Icon">
            <p class="logoName">Profile</p>
        </a>
    </div>

    <div class="logoSection">
        <a href="../Controller/index.php?action=show_conversations" class="nav-link" aria-label="Chats">
            <img src="../logo/chat.png" class="logo" id="chatImage" alt="Chat Icon">
            <p class="logoName">Chats</p>
        </a>
    </div>

    <div class="logoSection">
        <a href="#" class="nav-link" aria-label="Jobs Feed"> <!-- Update href when implemented -->
            <img src="../logo/feed.png" class="logo" id="feedImage" alt="Jobs Feed Icon">
            <p class="logoName">Jobs Feed</p>
        </a>
    </div>

    <div class="logoSection">
        <a href="../Controller/index.php?action=logout" class="nav-link" aria-label="Logout">
            <img src="../logo/logout.png" class="logo" id="logoutImage" alt="Logout Icon">
            <p class="logoName">Logout</p>
        </a>
    </div>
</div>

<script>
// JavaScript remains the same, but could be moved to external file
let pictures = [];
var index = 1;

setInterval(changePicture, 5000);

function getLocation() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition);

        function showPosition(position) {
            let latitude = position.coords.latitude;
            let longitude = position.coords.longitude;
            
            $.ajax({
                url: "../Controller/index.php",
                type: 'post',
                data: {action: "store_Location", "latitude": latitude, "longitude": longitude},
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
        document.getElementById("decorationImage").src = "../tradesPeoplePictures/"+pictures[index];
        index = (index >= pictures.length-1) ? 0 : index + 1;
    }
}

function getPictures() {
    $.ajax({
        url: "../Controller/index.php",
        type: 'post',
        data: {action: "get_Worker_Pictures"},
        success: function(data) {
            pictures = JSON.parse(data);
            if (pictures.length > 0) {
                document.getElementById("decorationImage").src = "../tradesPeoplePictures/"+ pictures[0];
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