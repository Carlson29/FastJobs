<?php
include 'header.php';
global $mySelf;
$pic = "../defaultPic/default.jpg";
if($mySelf->getProfilePic()!="" && $mySelf->getProfilePic()!=null){
    $pic=$mySelf->getProfilePic();
}
?>
<style>
    #profilePic{
        width: 20vw;
        height: 25vh;
        margin-right: 5vw;
    }
    #profileComp{
        margin-top: 10vh;
        display: flex;
        flex-direction: row;
        margin-left: 10vw;
    }
    #profileDetails{
        margin-top: 7vh;
    }

</style>
<body>
<div id="profileComp">
<div >
    <img id="profilePic" src=" <?php echo $pic ?> ">
</div>
<div id="profileDetails" >
    <p> Name: <?php echo $mySelf->getName() ?></p>
    <p> Email: <?php echo  $mySelf->getEmail() ?></p>
</div>
</div>
</body>
<script>

</script>

<?php
include 'footer.php';
?>


