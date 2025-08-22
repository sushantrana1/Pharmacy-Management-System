<?php
$conn = new mysqli("localhost", "root", "", "pharmacy");

$identifier = $_POST['identifier'];

$query = $conn->query("SELECT * FROM users WHERE email='$identifier'");

if ($query && $query->num_rows > 0) {
  $user = $query->fetch_assoc();
  echo "<h3>Password Found</h3>";
  echo "<p><strong>Username:</strong> " . $user['email'] . "</p>";
  echo "<p><strong>Role:</strong> " . $user['role'] . "</p>";
  echo "<p><strong>Password:</strong> <span style='color: green; font-weight: bold'>" . $user['password'] . "</span></p>";
  echo "<p><a style='color:red;' href='index.php'>Back to Login</a></p>";
} else {
  echo "<p style='color: red;'>User not found with this username or email.</p>";
  echo "<a href='forgot_password.php'>Try Again</a>";
}
?>
