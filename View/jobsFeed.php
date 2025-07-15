<?php
include 'header.php';
?>
<body>
<input type="file" id="feedInput" name="files[]" accept="image/*,video/*" multiple/>
<input type="text" id="aboutFeed">
<button onclick="uploadFeed()">Upload</button>
<br>
<button onclick="getFeed()">Get feed</button>
<div id="feed">

</div>
</body>
<script>
    document.getElementById('feedInput').addEventListener('change', function () {
        if (this.files.length > 5) {
            alert('You can only upload up to 5 files.');
            this.value = ''; // Reset the input
        }
    });

    async function uploadFeed() {
        var feedImgs = document.getElementById('feedInput');
        var aboutFeed = document.getElementById('aboutFeed').value.trim();
        if (feedImgs.files.length > 0 || (aboutFeed !== '' && aboutFeed !== null)) {
            var formData = new FormData();
            formData.append('action', 'upload_feed');
            // Append each file individually
            alert(feedImgs.files.length);
            for (let i = 0; i < feedImgs.files.length; i++) {
                formData.append('files[]', feedImgs.files[i]);
            }
            formData.append('aboutFeed', aboutFeed);
            await fetch('../Controller/index.php', {
                method: "POST",
                body: formData
            }).then(response => response.json()) // parse JSON response
                .then(data => {
                    if (data.success) {
                        console.log('Upload successful:', data.message);
                        alert(data.message);
                    } else {
                        console.error('Upload failed:', data.message);
                        alert('Error: ' + data.message);
                    }
                })
                .catch(error => {
                    console.error('Fetch error:', error);
                    alert('Fetch error occurred');
                });

            //  feedImgs="";
            document.getElementById('feedInput').value = "";
            document.getElementById('aboutFeed').value = "";
            //alert(response.body);
        } else {
            alert("please enter feed details");
        }
    }

    function getFeed() {
        $(document).ready(function () {
            $.ajax({
                url: "../Controller/index.php",
                type: 'post',
                data: {action: "get_Feed"},
                success: function (data) {
                    var allFeed = JSON.parse(data);
                    alert(allFeed);
                    //console.log(data);
                    var feed= "";
                    for (var i = 0; i < allFeed.length; i++) {
                        feed = feed + "<div><p>" + allFeed[i][0] + "</p> ";
                        for (var j = 0; j < allFeed[i][1].length; j++) {
                             if(allFeed[i][1][j][1]==1){
                                 feed = feed + "<img src='../feedMedia/"+ allFeed[i][1][j][0] +"' >"
                             }
                             else if(allFeed[i][1][j][1]==2){
                                 feed = feed + "<video> <source src='../feedMedia/"+ allFeed[i][1][j][0] +"'> </video>"
                             }
                        }
                        feed = feed +"</div> <br>"
                    }
                    document.getElementById('feed').innerHTML += feed;
                },
                error: function () {
                    alert("Error with ajax");
                }
            });
        });

    }
</script>
<?php
include 'footer.php';
?>
