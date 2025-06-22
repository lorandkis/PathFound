<?php
// Handle form submission and resume upload
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $uploadDir = __DIR__ . '/uploads/';
    if (!file_exists($uploadDir)) mkdir($uploadDir, 0755, true);

    $resumeUrl = '';
    if (isset($_FILES['resume']) && $_FILES['resume']['error'] === UPLOAD_ERR_OK) {
        $ext = pathinfo($_FILES['resume']['name'], PATHINFO_EXTENSION);
        $newName = 'resume_' . time() . '.' . $ext;
        move_uploaded_file($_FILES['resume']['tmp_name'], "$uploadDir$newName");
        $resumeUrl = '/uploads/' . $newName;
    }

    // Prepare GET parameters for dashboard
    $params = [];
    $params['resume'] = $resumeUrl;
    $params['keywords'] = $_POST['keywords_tags'][0] ?? '';
    $params['locations'] = json_encode($_POST['locations'] ?? []);
    $params['job_type'] = implode(',', $_POST['job_type'] ?? []);
    $params['position_level'] = implode(',', $_POST['position_level'] ?? []);

    header('Location: userDashboard.php?' . http_build_query($params));
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Smart Job Matcher</title>
  <link rel="stylesheet" href="/reasources/css/uikit.min.css" />
  <script src="/reasources/js/uikit.min.js"></script>
  <script src="/reasources/js/uikit-icons.min.js"></script>
</head>
<body>

    <!-- Nav Bar -->
    <nav class="uk-navbar-container uk-navbar-transparent uk-light" uk-navbar>
      <!-- Navbar content -->
      <nav class="uk-navbar-container uk-light uk-position-absolute uk-position-top uk-width-1-1" style="background: rgba(0, 0, 0, 0.3); z-index: 1000;">
        <div class="uk-container">
            <div uk-navbar>
                <div class="uk-navbar-left">
                    <a class="uk-navbar-item uk-logo" href="#" aria-label="Home">
                      <img src="reasources\baj_logo.svg" alt="BAJ Logo" style="height: 85px;">
                    </a>
                </div>

                <div class="uk-navbar-center">
                    <ul class="uk-navbar-nav">
                        <li class="uk-active"><a href="#">Home</a></li>
                        <li>
                            <a href="#">About Us</a>
                            <div class="uk-navbar-dropdown">
                                <ul class="uk-nav uk-navbar-dropdown-nav">
                                    <li class="uk-active"><a href="#">Active</a></li>
                                    <li><a href="#">Item</a></li>
                                    <li><a href="#">Item</a></li>
                                </ul>
                            </div>
                        </li>
                        <li><a href="#">Contact</a></li>
                    </ul>
                </div>

                <div class="uk-navbar-right">
                    <div class="uk-navbar-item">
                        <button class="uk-button uk-button-primary">Login</button>
                    </div>
                    <div class="uk-navbar-item">
                        <button class="uk-button uk-button-default">Sign Up</button>
                    </div>
                </div>
            </div>
        </div>
      </nav>
    </nav>




    



  <!-- Hero Section with Video Background -->
  <section class="uk-section uk-section-primary uk-padding-remove" style="position: relative; overflow: hidden; height: 100vh;">

    <!-- Background Video -->
    <video autoplay muted loop playsinline
      style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover; z-index: 0;">
      <source src="/reasources/BAJ-Back-Vid.mp4" type="video/mp4">
      Your browser does not support the video tag.
    </video>


    <!-- Overlay -->
    <div class="uk-container uk-position-relative uk-position-z-index uk-flex uk-flex-middle uk-flex-center uk-text-center" style="height: 100%;">
      <div>
        <!-- <a class="uk-logo" href=""><img src="/reasources/baj_logo.svg" width="300" height="300" alt="BAJ Logo"></a> -->
        <h1 class="uk-heading-medium uk-light">Find Your Perfect Job Match</h1>
        <p class="uk-text-lead uk-light">Upload your resume and let our AI connect you to your ideal job.</p>
        <a class="uk-button uk-button-secondary uk-button-large" href="#upload-section" uk-scroll>Get Started</a>
      </div>
    </div>
  </section>


  <!-- Features Overview -->
  <section class="uk-section uk-section-default">
    <div class="uk-container">
      <div class="uk-grid-match uk-child-width-1-3@m" uk-grid>
        <div>
          <div class="uk-card uk-card-default uk-card-body uk-text-center">
            <span uk-icon="icon: bolt; ratio: 2"></span>
            <h3 class="uk-card-title">Smart Matching</h3>
            <p>Our AI analyzes your resume and finds jobs that align with your strengths.</p>
          </div>
        </div>
        <div>
          <div class="uk-card uk-card-default uk-card-body uk-text-center">
            <span uk-icon="icon: settings; ratio: 2"></span>
            <h3 class="uk-card-title">Tailored Preferences</h3>
            <p>Customize job roles, locations, and more to suit your goals.</p>
          </div>
        </div>
        <div>
          <div class="uk-card uk-card-default uk-card-body uk-text-center">
            <span uk-icon="icon: clock; ratio: 2"></span>
            <h3 class="uk-card-title">Real-Time Updates</h3>
            <p>Get job results fast with up-to-date postings and intelligent sorting.</p>
          </div>
        </div>
      </div>
    </div>
  </section>


  <!-- Upload Section -->
  <section id="upload-section" class="uk-section uk-section-muted">
    <div class="uk-container">
      <h2 class="uk-heading-line uk-text-center"><span>Upload Your Resume</span></h2>

      <div uk-grid class="uk-grid-small uk-child-width-1-2@m">
        <div>
          <div class="uk-placeholder uk-text-center">
            <span uk-icon="icon: cloud-upload"></span>
            <span class="uk-text-middle">Attach resume by dropping it here or</span>
            <div uk-form-custom="target: #resumeName">
              <input type="file" name="resume" required>
              <input class="uk-input" type="text" id="resumeName" placeholder="No file selected" disabled>
            </div>
          </div>
        </div>

        <div>
          <div class="uk-card uk-card-default uk-card-body uk-box-shadow-small">
            <form method="POST" enctype="multipart/form-data" class="uk-form-stacked" id="searchForm">

              <!-- Job Keywords (Tags) -->
              <div class="uk-margin">
                <label class="uk-form-label">Job Keywords</label>
                <input class="uk-input" id="keywordInput" type="text" placeholder="Type keyword and press Enter">
                <div id="keywordTags" class="uk-margin-small-top"></div>
              </div>

              <!-- Hidden field to collect tags -->
              <input type="hidden" name="keywords_tags[]" id="keywordsField">

              <!-- Preferred Locations -->
              <div class="uk-margin">
                <label class="uk-form-label">Preferred Locations</label>
                <div id="locationsContainer"></div>
                <button type="button" class="uk-button uk-button-text" onclick="addLocationField()">+ Add Another Location</button>
              </div>

              <!-- Job Type & Position Level (side by side) -->
              <div class="uk-grid-small" uk-grid>
                <div class="uk-width-1-2@s">
                  <label class="uk-form-label">Job Type</label>
                  <?php foreach(['Full-time','Part-time','Contract','Freelance','Internship'] as $type): ?>
                    <div class="uk-margin-small"><label><input class="uk-checkbox" type="checkbox" name="job_type[]" value="<?= $type ?>"> <?= $type ?></label></div>
                  <?php endforeach; ?>
                </div>
                <div class="uk-width-1-2@s">
                  <label class="uk-form-label">Position Level</label>
                  <?php foreach(['Junior','Intermediate','Senior','Lead','Executive'] as $level): ?>
                    <div class="uk-margin-small"><label><input class="uk-checkbox" type="checkbox" name="position_level[]" value="<?= $level ?>"> <?= $level ?></label></div>
                  <?php endforeach; ?>
                </div>
              </div>

              <!-- Submit -->
              <div class="uk-text-center uk-margin-top">
                <button type="submit" class="uk-button uk-button-primary uk-button-large">Find Matching Jobs</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- UIkit location autocomplete and tag handling JS unchanged -->
  <script>
    // Tag Input Logic
    const keywordInput = document.getElementById('keywordInput');
    const tagsContainer = document.getElementById('keywordTags');
    const keywordsField = document.getElementById('keywordsField');
    let tags = [];
    keywordInput.addEventListener('keydown', e => {
      if (e.key === 'Enter' || e.key === ',') {
        e.preventDefault();
        const val = keywordInput.value.trim();
        if (val && !tags.includes(val)) {
          tags.push(val);
          const span = document.createElement('span');
          span.className = 'uk-label uk-margin-small-right uk-margin-small-bottom';
          span.textContent = val;
          const close = document.createElement('a');
          close.href = '#';
          close.className = 'uk-margin-small-left';
          close.innerHTML = '&times;';
          close.onclick = () => { span.remove(); tags = tags.filter(t => t !== val); updateHidden(); };
          span.append(close);
          tagsContainer.append(span);
          updateHidden();
          keywordInput.value = '';
        }
      }
    });
    function updateHidden() {
      keywordsField.value = tags.join(',');
    }

    // Location input logic remains unchanged (with enableAutocomplete and addLocationField)
    // Handle dynamic location inputs
    const locationsContainer = document.getElementById('locationsContainer');

    function addLocationField() {
      const wrapper = document.createElement('div');
      wrapper.className = 'uk-grid-small uk-flex-middle uk-margin-small-bottom';
      wrapper.setAttribute('uk-grid', '');

      wrapper.innerHTML = `
        <div class="uk-width-expand">
          <input class="uk-input location-autocomplete" type="text" placeholder="e.g. Ontario, Montreal, USA">
        </div>
        <div class="uk-width-auto">
          <select class="uk-select">
            <option value="in-person">In-Person</option>
            <option value="remote">Remote</option>
            <option value="any">Any</option>
          </select>
        </div>
        <div class="uk-width-auto">
          <button class="uk-button uk-button-danger uk-button-small" onclick="this.parentNode.parentNode.remove();">Remove</button>
        </div>
      `;
      locationsContainer.appendChild(wrapper);

      // Enable autocomplete on the new input
      const input = wrapper.querySelector('.location-autocomplete');
      enableAutocomplete(input);
    }



    // Load cities for autocomplete (your JSON should be at this path)
    let citiesData = [];

    fetch('/reasources/data/cities.json')
      .then(response => response.json())
      .then(data => {
        citiesData = data;
      })
      .catch(err => console.error("Could not load cities.json", err));

    // Enhance newly added location inputs
    function enableAutocomplete(input) {
      const suggestionBox = document.createElement('ul');
      suggestionBox.className = 'uk-list uk-list-striped uk-box-shadow-medium uk-border-rounded uk-padding-small';
      suggestionBox.style.position = 'absolute';
      suggestionBox.style.zIndex = '999';
      suggestionBox.style.background = 'white';
      suggestionBox.style.marginTop = '4px';
      suggestionBox.style.display = 'none';
      input.parentNode.appendChild(suggestionBox);

      input.addEventListener('input', function () {
        const query = input.value.toLowerCase().trim();
        suggestionBox.innerHTML = '';

        if (query.length < 2) {
          suggestionBox.style.display = 'none';
          return;
        }

        const cityMatches = citiesData.filter(city =>
          city.city.toLowerCase().includes(query) ||
          (city.admin_name && city.admin_name.toLowerCase().includes(query)) ||
          (city.country && city.country.toLowerCase().includes(query))
        );

        // Add unique simulated region/country matches
        const extraMatches = [];

        if (citiesData.some(c => c.admin_name?.toLowerCase() === query)) {
          const match = citiesData.find(c => c.admin_name?.toLowerCase() === query);
          extraMatches.push({ city: "", admin_name: match.admin_name, country: match.country });
        }

        if (citiesData.some(c => c.country?.toLowerCase() === query)) {
          const match = citiesData.find(c => c.country?.toLowerCase() === query);
          extraMatches.push({ city: "", admin_name: "", country: match.country });
        }

        const results = [...extraMatches, ...cityMatches].slice(0, 10);


        if (results.length === 0) {
          suggestionBox.style.display = 'none';
          return;
        }

        results.forEach(city => {
          const li = document.createElement('li');
          const parts = [city.city, city.admin_name, city.country].filter(Boolean);
          li.textContent = parts.join(', ');
          li.style.cursor = 'pointer';
          li.onclick = () => {
            input.value = li.textContent;
            suggestionBox.style.display = 'none';
          };
          suggestionBox.appendChild(li);
        });

        suggestionBox.style.display = 'block';
      });

      document.addEventListener('click', e => {
        if (!suggestionBox.contains(e.target) && e.target !== input) {
          suggestionBox.style.display = 'none';
        }
      });
    }


    // Add one initial location row
    addLocationField();
  </script>
</body>
</html>