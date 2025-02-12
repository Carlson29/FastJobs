<!DOCTYPE html>

<html>

<head>
    <meta charset="UTF-8">
    <title></title>
</head>
<body>

<form action="../Controller/index.php" method="post">
    <input type="hidden" name="action" value="do_signup"  />
    <p id="Message" ></p>
<label>Username</label>
    <input type="text" name="userName">
    <label>Password</label>
    <input type="password" name="password">
    <label>email</label>
    <input type="email" name="email">
    <label>date Of Birth</label>
    <input type="date" name="dateOfBirth" id="dateOfBirth">
    <label>Register as a worker</label>
    <label>NO</label>
    <input type="checkbox" name="user" value="1">
    <label>YES</label>
    <input type="checkbox" name="worker" value="2">
    <button hidden id="signUp" >Sign Up</button>
</form>
<button type="" name="" onclick="vakidateDetails()">Sign Up</button>
</body>
<script>
    function vakidateDetails() {
        document.getElementById('Message').innerHTML="";
       const submit= document.getElementById('signUp')
        var dateOfBirth = document.getElementById('dateOfBirth').value;
        const date = new Date(dateOfBirth);
        const currentDate = new Date();
        const year = (currentDate-date)/ 31557600000;
        if(year < 18){
            document.getElementById('Message').innerHTML="Sorry you must be 18yrs or over";
        }
        else {
        submit.click();
        }
    }

</script>

</html>
