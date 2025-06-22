<!-- signup.php -->
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $confirm = $_POST['confirm_password'] ?? '';

    if ($password !== $confirm) {
        $errorMessage = "Passwords do not match.";
    } else {
        // TODO: Save user to DB, hash password, etc.
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Sign Up – Smart Job Matcher</title>
  <link rel="icon" type="image/x-icon" href="/reasources/baj_logo.svg">
  <link rel="stylesheet" href="/reasources/css/uikit.min.css" />
  <script src="/reasources/js/uikit.min.js"></script>
  <script src="/reasources/js/uikit-icons.min.js"></script>
</head>
<body class="uk-flex uk-flex-center uk-flex-middle uk-background-muted" style="min-height:100vh;">

  <div class="uk-card uk-card-default uk-card-body uk-width-1-2@m uk-box-shadow-medium">
    <h3 class="uk-card-title uk-text-center">Create Your Account</h3>

    <?php if (!empty($errorMessage ?? '')): ?>
      <div class="uk-alert-danger" uk-alert><?= htmlspecialchars($errorMessage) ?></div>
    <?php endif; ?>

    <form class="uk-form-stacked" method="POST" action="">
      <div class="uk-margin">
        <label class="uk-form-label" for="name">Full Name</label>
        <div class="uk-form-controls">
          <input id="name" name="name" class="uk-input" type="text" required placeholder="John Doe">
        </div>
      </div>

      <div class="uk-margin">
        <label class="uk-form-label" for="email">Email</label>
        <div class="uk-form-controls">
          <input id="email" name="email" class="uk-input" type="email" required placeholder="you@example.com">
        </div>
      </div>

      <div class="uk-margin">
        <label class="uk-form-label" for="password">Password</label>
        <div class="uk-form-controls">
          <input id="password" name="password" class="uk-input" type="password" required placeholder="••••••••">
        </div>
      </div>

      <div class="uk-margin">
        <label class="uk-form-label" for="confirm_password">Confirm Password</label>
        <div class="uk-form-controls">
          <input id="confirm_password" name="confirm_password" class="uk-input" type="password" required placeholder="••••••••">
        </div>
      </div>

      <div class="uk-margin">
        <label><input class="uk-checkbox" type="checkbox" required> I agree to the <a href="#">Terms & Conditions</a></label>
      </div>

      <div class="uk-margin">
        <button class="uk-button uk-button-primary uk-width-1-1" type="submit">Sign Up</button>
      </div>
    </form>

    <p class="uk-text-center uk-text-small">
      Already have an account? <a href="login.php">Login here</a>
    </p>
  </div>

</body>
</html>
