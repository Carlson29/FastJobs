<!DOCTYPE html>

<html>

<head>
    <meta charset="UTF-8">
    <title></title>
</head>
<body>

<form action="../Controller/index.php" method="post">
    <input type="hidden" name="action" value="do_signup"  />
<label>Username</label>
    <input type="text" name="userName">
    <label>Password</label>
    <input type="password" name="password">
    <label>email</label>
    <input type="email" name="email">
    <label>date Of Birth</label>
    <input type="date" name="dateOfBirth">
    <label>Register as a worker</label>
    <input type="checkbox" name="worker" value="2">
    <button type="submit">Sign Up</button>
</form>
</body>

</html>
