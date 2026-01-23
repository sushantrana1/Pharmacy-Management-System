<!DOCTYPE html>
<html>
<head>
<title>Forgot Password</title>
<style>
  h2 { 
  color: black;
  }
  button {
  color : white;
  background : green;
  }
  a {
  color: red;
  font-weight: bold;
}
</style>
</head>
<body>

<h2>Forgot Password</h2>

<form action="get_password.php" method="POST">
  <label>Enter your email:</label>
  <input type="text" name="identifier" required>
  <button type="submit">Show Password</button>
</form>

<p><a href="index.php">Back to Login</a></p>

</body>
</html>
