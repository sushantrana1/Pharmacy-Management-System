<?php
session_start();

$conn = new mysqli("localhost", "root", "", "pharmacy");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$email = mysqli_real_escape_string($conn, $_POST['email']);
$password = ($_POST['password']);
$role = $_POST['role'];

$sql = "SELECT * FROM users WHERE email='$email' AND password='$password' AND role='$role'";
$result = $conn->query($sql);

if ($result->num_rows == 1) {
    $user = $result->fetch_assoc();

    $_SESSION['user'] = $user['name'];
    $_SESSION['role'] = $user['role'];

    header("Location: dashboard.php");
    exit();

    // Redirect to correct dashboard
    // if ($role == 'admin') {
    //     header("Location: users/admin.php");
    // } else {
    //     header("Location: users/pharmacist.php");
    // }

} else {
    header("Location: index.php?error=1");
}
?>