<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->

<footer>
    <div class="container-fluid" id="foot">
        <p>All rights reserved <?php
          echo date("Y"); ?></p>
    </div>

</footer>
<script>
    // setInterval(getUsersByLocation, 2000);
    function openNav() {
        document.getElementById("mySidenav").style.width = "4vw";
        //document.getElementById("main").style.marginLeft = "4vw";
    }

    function closeNav() {
        document.getElementById("mySidenav").style.width = "0";
       // document.getElementById("main").style.marginRight = "0";
    }
    window.addEventListener('load', function(event) {
        closeNav();
    });

    document.addEventListener('click', function(event) {
        let mySidenav= document.getElementById('mySidenav');
        let openSideBar= document.getElementById('openSideBar');
        if(!mySidenav.contains(event.target) && !openSideBar.contains(event.target)){
         mySidenav.style.width="0";
        }
    });

    </script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js" integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE" crossorigin="anonymous"></script>
</body>
</html>