<?php
include 'header.php';
?>
<body id="loginBody">
<div id="loginPage">
    <div id="signUpDiv">
        <form action="../Controller/index.php" method="post" id="loginForm">
            <input type="hidden" name="action" value="do_login"/>
            <p id="errorMessage">
                <?php
                global $msg;
                if ($msg != null) {
                    echo $msg;
                }
                ?>

            </p>
            <label>Email</label>
            <br>
            <input type="email" name="email" id="email" required>
            <br>
            <label>Password</label>
            <br>
            <input type="password" name="password" id="password" required>
            <br>
            <br>
            <button hidden id="signUp">Sign Up</button>
        </form>
        <button id="" name="" onclick=""><a href="../Controller/index.php?action=show_signup">Sign up</a></button>
        <button id="loginValidateButton" name="" onclick="validateDetails()">Login</button>
    </div>
</div>
</body>
<script>


    function validateDetails() {
        document.getElementById('errorMessage').innerHTML = "";
        const submit = document.getElementById('signUp')
        var email = document.getElementById('email').value.trim();
        var password = document.getElementById('password').value;
        if (email == null || email == '') {
            document.getElementById('errorMessage').innerHTML = "Please enter email";
        } else if (password == null || password == '') {
            document.getElementById('errorMessage').innerHTML = "Please enter password";
        } else {
            submit.click();
        }

    }

</script>

<?php
include 'footer.php';
?>

