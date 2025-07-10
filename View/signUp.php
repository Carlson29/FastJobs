<?php include 'header.php'; ?>

<main id="signUpBody">
  <div id="signUpPage">
    <div id="signUpDiv">
      <form action="../Controller/index.php" method="post" id="signUpForm">
        <input type="hidden" name="action" value="do_signup">
        
        <p id="errorMessage"></p>
        
        <div class="form-group">
          <label for="userName">Username</label>
          <input type="text" name="userName" id="userName" required>
        </div>
        
        <div class="form-group">
          <label for="password">Password</label>
          <input type="password" name="password" id="password" 
                 title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" 
                 required>
        </div>
        
        <div class="form-group">
          <label for="email">Email</label>
          <input type="email" name="email" id="email" required>
        </div>
        
        <div class="form-group">
          <label for="dateOfBirth">Date Of Birth</label>
          <input type="date" name="dateOfBirth" id="dateOfBirth" required>
        </div>
        
        <div class="form-group">
          <label>Register as a worker</label>
          <div class="checkbox-group">
            <div class="checkbox-option">
              <input type="checkbox" name="user" id="user" value="1">
              <label for="user">NO</label>
            </div>
            <div class="checkbox-option">
              <input type="checkbox" name="worker" id="worker" value="2">
              <label for="worker">YES</label>
            </div>
          </div>
        </div>
        
        <button hidden id="signUp">Sign Up</button>
        
        <div class="button-group">
          <a href="../Controller/index.php?action=show_login" class="btn btn-link">Already have account</a>
          <button type="button" class="btn" onclick="validateDetails()">Sign Up</button>
        </div>
      </form>
    </div>
  </div>
</main>

<script>
function validateDetails() {
  document.getElementById('errorMessage').innerHTML = "";
  const submit = document.getElementById('signUp');
  const userName = document.getElementById('userName').value.trim();
  const email = document.getElementById('email').value.trim();
  const password = document.getElementById('password').value;
  const dateOfBirth = document.getElementById('dateOfBirth').value;
  const worker = document.getElementById('worker').checked;
  const user = document.getElementById('user').checked;
  
  if (!dateOfBirth) {
    document.getElementById('errorMessage').innerHTML = "Please enter date of birth";
    return;
  }
  
  const date = new Date(dateOfBirth);
  const currentDate = new Date();
  const year = (currentDate - date) / 31557600000;
  
  if (!userName) {
    document.getElementById('errorMessage').innerHTML = "Please enter username";
  } else if (!password) {
    document.getElementById('errorMessage').innerHTML = "Please enter password";
  } else if (!email) {
    document.getElementById('errorMessage').innerHTML = "Please enter email";
  } else if (year < 18) {
    document.getElementById('errorMessage').innerHTML = "Sorry you must be 18yrs or over";
  } else if (!worker && !user) {
    document.getElementById('errorMessage').innerHTML = "Please choose user Type";
  } else {
    submit.click();
  }
}
</script>

<?php include 'footer.php'; ?>