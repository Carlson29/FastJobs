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
        width: 7vw;
        height: 10vh;
     margin-top: 10vh;
    }

</style>
<body>

<div >
    <img id="profilePic" src=" <?php echo $pic ?> ">
</div>
<div>
    <p><?php echo $mySelf->getName() ?></p>
    <p><?php echo  $mySelf->getEmail() ?></p>
</div>

</body>

<?php
include 'footer.php';
?>


