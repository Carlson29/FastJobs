<?php
    include 'header.php';
?>
<body id="signUpBody" >
<div id="signUpPage">
<div id="signUpDiv">
<form action="../Controller/index.php" method="post" id="signUpForm" >
    <input type="hidden" name="action" value="do_signup"  />
    <p id="errorMessage" ></p>
<label>Username</label>
    <br>
    <input type="text" name="userName" id="userName" required>
    <br>
    <label>Password</label>
    <br>
    <input type="password" name="password" id="password" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required>
    <br>
    <label>Email</label>
    <br>
    <input type="email" name="email" id="email" required>
    <br>
    <label>Date Of Birth</label>
    <br>
    <input type="date" name="dateOfBirth" id="dateOfBirth" required>
    <br>
    <br>
    <label>Register as a worker</label>
    <br>
    <label >NO</label>
    <input type="checkbox" name="user" id="user" value="1">
    <br>
    <label for="worker" >YES</label>
    <input type="checkbox" name="worker" id="worker" value="2">
    <br>
    <br>
    <button hidden id="signUp" >Sign Up</button>
</form>
    <button id="" name="" onclick=""><a href="../Controller/index.php?action=show_login">Login</a></button>
<button id="validateButton" name="" onclick="vakidateDetails()">Sign Up</button>
</div>
</div>
</body>
<script>



    function vakidateDetails() {
        document.getElementById('errorMessage').innerHTML="";
       const submit= document.getElementById('signUp')
        var userName = document.getElementById('userName').value.trim();
        var email = document.getElementById('email').value.trim();
        var password = document.getElementById('password').value;
        var dateOfBirth = document.getElementById('dateOfBirth').value;
        var worker = document.getElementById('worker').checked;
        var user = document.getElementById('user').checked;
        var year =0;
        var dobState=false;
        if(dateOfBirth!="" || dateOfBirth!=null){
            const date = new Date(dateOfBirth);
            const currentDate = new Date();
             year = (currentDate-date)/ 31557600000;
             dobState=true;
        }
        else{
            document.getElementById('errorMessage').innerHTML="Please enter date of birth";
        }
        if(dobState==true) {
            if (userName == null || userName == '') {
                document.getElementById('errorMessage').innerHTML = "Please enter username";
            }else if (password == null || password == '') {
                document.getElementById('errorMessage').innerHTML = "Please enter password";
            }
            else if (email == null || email == '') {
                document.getElementById('errorMessage').innerHTML = "Please enter email";
            } else if (dateOfBirth == null || dateOfBirth == '') {
                document.getElementById('errorMessage').innerHTML = "Please enter email";
            } else if (year < 18) {
                document.getElementById('errorMessage').innerHTML = "Sorry you must be 18yrs or over";
            }else if (worker==false && user == false) {
                document.getElementById('errorMessage').innerHTML = "Please choose user Type";
            }
            else {
                submit.click();
            }
        }
    }

</script>

<?php
include 'footer.php';
?>
