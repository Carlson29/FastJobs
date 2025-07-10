<?php include 'header.php'; ?>

<main id="loginBody">
  <div id="loginPage">
    <div id="signUpDiv">
      <form action="../Controller/index.php" method="post" id="loginForm">
        <input type="hidden" name="action" value="do_login">
        
        <div id="errorMessage">
          <?php 
          global $msg; 
          if ($msg != null) { 
            echo htmlspecialchars($msg); 
          } 
          ?>
        </div>
        
        <div class="form-group">
          <label for="email">Email</label>
          <input type="email" name="email" id="email" required>
        </div>
        
        <div class="form-group">
          <label for="password">Password</label>
          <input type="password" name="password" id="password" required>
        </div>
        
        <button hidden id="signUp">Login</button>
        
        <div class="button-group">
          <a href="../Controller/index.php?action=show_signup" class="btn btn-link">I have no account</a>
          <button type="button" class="btn" onclick="validateDetails()">Login</button>
        </div>
      </form>
    </div>
  </div>
</main>

<script>
function validateDetails() {
  document.getElementById('errorMessage').innerHTML = "";
  const submit = document.getElementById('signUp');
  const email = document.getElementById('email').value.trim();
  const password = document.getElementById('password').value;
  
  if (!email) {
    document.getElementById('errorMessage').innerHTML = "Please enter email";
  } else if (!password) {
    document.getElementById('errorMessage').innerHTML = "Please enter password";
  } else {
    submit.click();
  }
}
</script>

<?php include 'footer.php'; ?>