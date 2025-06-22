<!-- login.php -->
<?php
// Example place for processing login (server‑side logic not included here)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    // TODO: Authenticate user and handle errors, sessions, redirects, etc.
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Login – Smart Job Matcher</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/uikit@3.17.6/dist/css/uikit.min.css" />
  <script src="https://cdn.jsdelivr.net/npm/uikit@3.17.6/dist/js/uikit.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/uikit@3.17.6/dist/js/uikit-icons.min.js"></script>
</head>
<body class="uk-flex uk-flex-center uk-flex-middle uk-background-muted" style="min-height:100vh;">

  <div class="uk-card uk-card-default uk-card-body uk-width-1-3@m uk-box-shadow-medium">
    <h3 class="uk-card-title uk-text-center">Welcome Back</h3>

    <?php if (!empty($errorMessage ?? '')): ?>
      <div class="uk-alert-danger" uk-alert><?= htmlspecialchars($errorMessage) ?></div>
    <?php endif; ?>

    <form class="uk-form-stacked" method="POST" action="">
      <div class="uk-margin">
        <label class="uk-form-label" for="email">Email</label>
        <div class="uk-form-controls">
          <input id="email" name="email" class="uk-input" type="email" required autofocus placeholder="you@example.com">
        </div>
      </div>

      <div class="uk-margin">
        <label class="uk-form-label" for="password">Password</label>
        <div class="uk-form-controls uk-position-relative">
          <input id="password" name="password" class="uk-input" type="password" required placeholder="••••••••">
          <a class="uk-form-icon uk-form-icon-flip" uk-icon="icon: eye" href="#" onclick="togglePassword();return false;"></a>
        </div>
      </div>

      <div class="uk-margin uk-flex uk-flex-between uk-text-small">
        <label><input class="uk-checkbox" type="checkbox" name="remember"> Remember me</label>
        <a href="#">Forgot password?</a>
      </div>

      <div class="uk-margin">
        <button class="uk-button uk-button-primary uk-width-1-1" type="submit">Log In</button>
      </div>
    </form>

    <p class="uk-text-center uk-text-small">
      Don't have an account? <a href="signUp.php">Sign up here</a>
    </p>
  </div>

  <script>
    function togglePassword() {
      const pw = document.getElementById('password');
      const icon = pw.nextElementSibling;
      if (pw.type === 'password') {
        pw.type = 'text';
        icon.setAttribute('uk-icon', 'icon: eye-slash');
      } else {
        pw.type = 'password';
        icon.setAttribute('uk-icon', 'icon: eye');
      }
    }
  </script>

</body>
</html>
