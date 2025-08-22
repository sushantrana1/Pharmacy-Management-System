<!DOCTYPE html>
<html lang="en">

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Pharmacy Login</title>
  <link rel="stylesheet" href="login.css">

</head>

<body>

  <div class="login-container">
    <h2>Pharmacy Login</h2>
    <p>Secure login for pharmacy staff</p>

    <div class="role-toggle">
      <button id="adminBtn" class="admin-active">Admin</button>
      <button id="pharmaBtn">Pharmacist</button>
    </div>

    <h3 id="roleTitle" style="font-family: 'Comic Sans MS', cursive;">Admin Login</h3>
    <p id="roleSub">Access administrative controls and system settings</p>

    <!-- <form action="login.php" method="POST">
      <input type="hidden" name="role" id="roleInput" value="admin">

      <div class="form-group">
        <label>Email</label>
        <input type="email" name="email" placeholder="Enter your email" required>
      </div>

      <div class="form-group">
        <label>Password</label>
        <input type="password" name="password" placeholder="********" required>
      </div>

      <div class="form-options">
        <label><input type="checkbox"> Remember me </label>
      </div>

      <button type="submit" class="login-btn btn-admin" id="loginBtn">Sign In as Admin</button>
      <a href="forgot_password.php">Forgot password</a>

    </form> -->
    <form action="login.php" method="POST" id="loginForm">
  <input type="hidden" name="role" id="roleInput" value="admin">

  <div class="form-group">
    <label>Email</label>
    <input type="email" name="email" id="email" placeholder="Enter your email" required>
    <small id="emailError" style="color:red; display:none;">Enter a valid email address</small>
  </div>

  <div class="form-group">
    <label>Password</label>
    <input type="password" name="password" id="password" placeholder="********" required minlength="6">
    <small id="passError" style="color:red; display:none;">Password must be at least 6 characters</small>
  </div>

  <div class="form-options">
    <label><input type="checkbox" name="remember"> Remember me </label>
  </div>

  <button type="submit" class="login-btn btn-admin" id="loginBtn">Sign In as Admin</button>
  <a href="forgot_password.php">Forgot password</a>
</form>

<script>
document.getElementById("loginForm").addEventListener("submit", function(e){
    let email = document.getElementById("email").value.trim();
    let password = document.getElementById("password").value.trim();
    let emailError = document.getElementById("emailError");
    let passError = document.getElementById("passError");
    let valid = true;

    // Email validation
    let emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if(!emailPattern.test(email)){
        emailError.style.display = "block";
        valid = false;
    } else {
        emailError.style.display = "none";
    }

    // Password validation (min 6 chars, at least 1 letter + 1 number)
    let passPattern = /^(?=.*[A-Za-z])(?=.*\d).{6,}$/;
    if(!passPattern.test(password)){
        passError.style.display = "block";
        valid = false;
    } else {
        passError.style.display = "none";
    }

    if(!valid){
        e.preventDefault(); 
    }
});
</script>

  </div>

  <script>
    const adminBtn = document.getElementById("adminBtn");
    const pharmaBtn = document.getElementById("pharmaBtn");
    const loginBtn = document.getElementById("loginBtn");
    const roleTitle = document.getElementById("roleTitle");
    const roleSub = document.getElementById("roleSub");

    adminBtn.addEventListener("click", () => {
      adminBtn.classList.add("admin-active");
      pharmaBtn.classList.remove("active");
      loginBtn.classList.remove("btn-pharmacist");
      loginBtn.classList.add("btn-admin");
      loginBtn.textContent = "Sign In as Admin";
      roleTitle.textContent = "Admin Login";
      roleSub.textContent = "Access administrative controls and system settings";
    });

    pharmaBtn.addEventListener("click", () => {
      pharmaBtn.classList.add("active");
      adminBtn.classList.remove("admin-active");
      loginBtn.classList.remove("btn-admin");
      loginBtn.classList.add("btn-pharmacist");
      loginBtn.textContent = "Sign In as Pharmacist";
      roleTitle.textContent = "Pharmacist Login";
      roleSub.textContent = "Sign in to manage prescriptions and patient records";
    });

    const roleInput = document.getElementById("roleInput");

    adminBtn.addEventListener("click", () => {
      roleInput.value = "admin"; // sets role for PHP
      // ... (rest remains same)
    });

    pharmaBtn.addEventListener("click", () => {
      roleInput.value = "pharmacist";
    });


  </script>

</body>

</html>