<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Profile & Settings</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/uikit@3/dist/css/uikit.min.css" />
  <script src="https://cdn.jsdelivr.net/npm/uikit@3/dist/js/uikit.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/uikit@3/dist/js/uikit-icons.min.js"></script>
</head>
<body>

<div class="uk-grid-collapse uk-child-width-auto@s uk-flex-middle uk-height-viewport" uk-grid>

  <!-- Sidebar Tabs -->
  <div class="uk-width-auto@s uk-background-muted uk-padding-small">
    <ul class="uk-tab-left uk-flex-column uk-child-width-expand" uk-tab="connect: #settings-switcher; swiping: true; active: 0">
      <li><a href="#">Account</a></li>
      <li><a href="#">Job Settings</a></li>
      <li><a href="#">Advanced</a></li>
    </ul>
  </div>

  <!-- Panel Content -->
  <div class="uk-width-expand@s uk-padding uk-flex uk-flex-top">
    <ul id="settings-switcher" class="uk-switcher uk-width-1-1">
      <!-- Account Panel -->
      <li>
        <h2>Account</h2>
        <form class="uk-form-stacked uk-grid-small" uk-grid>
          <div class="uk-width-1-2@s">
            <label class="uk-form-label">Name</label>
            <div class="uk-form-controls">
              <input class="uk-input" type="text" name="name">
            </div>
          </div>
          <div class="uk-width-1-2@s">
            <label class="uk-form-label">Email</label>
            <div class="uk-form-controls">
              <input class="uk-input" type="email" name="email">
            </div>
          </div>
          <div class="uk-width-1-2@s">
            <label class="uk-form-label">Password</label>
            <div class="uk-form-controls">
              <input class="uk-input" type="password" name="password">
            </div>
          </div>
          <div class="uk-width-1-2@s">
            <label class="uk-form-label">Profile Picture</label>
            <div class="uk-form-controls">
              <input class="uk-input" type="file" name="avatar">
            </div>
          </div>
          <div class="uk-width-1-1">
            <button class="uk-button uk-button-primary">Save Account</button>
          </div>
        </form>
      </li>

      <!-- Job Settings Panel -->
      <li>
        <h2>Job Settings</h2>
        <form class="uk-form-stacked uk-grid-small" uk-grid>
          <div class="uk-width-1-1">
            <label class="uk-form-label">Resume</label>
            <div class="uk-form-controls uk-flex uk-flex-middle">
              <span class="uk-text-muted">resume.pdf</span>
              <button class="uk-button uk-button-text uk-margin-left" type="button">Change</button>
            </div>
          </div>
          <div class="uk-width-1-1">
            <label class="uk-form-label">Job Keywords</label>
            <!-- Your tag input logic -->
          </div>
          <div class="uk-width-1-1">
            <label class="uk-form-label">Locations</label>
            <!-- Your autocomplete logic -->
          </div>
          <div class="uk-width-1-2@s">
            <label class="uk-form-label">Job Type</label>
            <!-- Your checkboxes -->
          </div>
          <div class="uk-width-1-2@s">
            <label class="uk-form-label">Position Level</label>
            <!-- Your checkboxes -->
          </div>
          <div class="uk-width-1-1">
            <button class="uk-button uk-button-primary">Save Job Settings</button>
          </div>
        </form>
      </li>

      <!-- Advanced Panel -->
      <li>
        <h2>Advanced</h2>
        <form class="uk-form-stacked uk-grid-small" uk-grid>
          <div class="uk-width-1-1">
            <label><input class="uk-checkbox" type="checkbox" name="2fa"> Enable Two‑Factor Authentication</label>
          </div>
          <div class="uk-width-1-1">
            <button class="uk-button uk-button-danger">Delete Account</button>
          </div>
        </form>
      </li>
    </ul>
  </div>

</div>

</body>
</html>
