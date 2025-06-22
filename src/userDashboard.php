<?php

$resumeUrl = $_GET['resume'] ?? '';
$keywords = array_filter(array_map('trim', explode(',', $_GET['keywords'] ?? '')));
$locations = json_decode($_GET['locations'] ?? '{}', true);
$jobTypes = array_filter(array_map('trim', explode(',', $_GET['job_type'] ?? '')));
$positionLevels = array_filter(array_map('trim', explode(',', $_GET['position_level'] ?? '')));


$queryParams = [
    'keywords' => implode(',', $keywords),
    'roles' => implode(',', $positionLevels),
    'exclude' => '', // Optional: you can set exclusions based on resume parsing
    'locations' => json_encode($locations),
    'job_types' => implode(',', $jobTypes),
    'resume' => $resumeUrl
];


$query = http_build_query($queryParams);

$url = "http://api:4000/search?$query";

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$response = curl_exec($ch);
curl_close($ch);

$data = json_decode($response, true);

$jobs = $data['results'] ?? [];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Job Dashboard</title>
    <link rel="icon" type="image/x-icon" href="/reasources/baj_logo.svg">
    <link rel="stylesheet" href="/reasources/css/uikit.min.css" />
    <script src="/reasources/js/uikit.min.js"></script>
    <script src="/reasources/js/uikit-icons.min.js"></script>
    <script src="/reasources/js/uikit.js"></script>
</head>
<body>


    <!-- Nav Bar -->

    <!-- Navbar content -->
    <nav class="uk-navbar-container uk-light" style="background: rgba(0, 0, 0, 0.3);">
        <div class="uk-container">
            <div uk-navbar>
                <div class="uk-navbar-left">
                    <a class="uk-navbar-item uk-logo" href="#" aria-label="Home">
                      <img src="reasources\baj_logo.svg" alt="BBJ Logo" style="height: 85px;">
                    </a>
                </div>

                <div class="uk-navbar-center">
                    <div class="uk-navbar-item">
                        <h3>Job Matches</h3>
                    </div>
                </div>

                <div class="uk-navbar-right">

                    <ul class="uk-navbar-nav">
                        <li>
                            <a href="#" style="color:white;"><span uk-icon="icon: bell"></span></a>
                            <div uk-dropdown="mode: click" uk-dropdown="pos: bottom-center">
                                <ul class="uk-nav uk-navbar-dropdown-nav">
                                    <li class="uk-active"><a href="#">Active</a></li>
                                    <li><a href="#">Item</a></li>
                                    <li><a href="#">Item</a></li>
                                </ul>
                            </div>
                        </li>
                        <li>
                            <a href="#" style="color:white;"><span uk-icon="icon: user"></span></a>
                            <div uk-dropdown="mode: click" uk-dropdown="pos: bottom-center">
                                <ul class="uk-nav uk-navbar-dropdown-nav">
                                    <li class="uk-active"><a href="#">Active</a></li>
                                    <li><a href="#">Item</a></li>
                                    <li><a href="#">Item</a></li>
                                </ul>
                            </div>
                        </li>
                    </ul>

                </div>
            </div>
        </div>
    </nav>



    <div class="uk-grid-collapse uk-child-width-1-6@s uk-flex-nowrap" uk-grid>
        <!-- Sidebar -->
        <div class="uk-background-muted uk-padding">
            <h3>Dashboard</h3>
            <ul class="uk-nav uk-nav-default">
                <li class="uk-active"><a href="#">Job Matches</a></li>
                <li><a href="#">Applications</a></li>
                <li><a href="#">Settings</a></li>
            </ul>
        </div>

        <!-- Main Content -->
        <div class="uk-width-expand uk-padding">

            <!-- TABLES! -->
            <table class="uk-table uk-table-hover uk-table-striped">
                <thead>
                    <tr>
                        <th>Company</th>
                        <th>Job Title</th>
                        <th>Location</th>
                        <th>Posted</th>
                        <th>Match Score</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($jobs as $index => $job):
                        $fit = (int)$job['pct_fit'];
                        $labelClass = 'uk-label-danger';
                        if ($fit >= 85) {
                            $labelClass = 'uk-label-success';
                        } elseif ($fit >= 65) {
                            $labelClass = 'uk-label-warning';
                        }
                        $labelClass .= " uk-box-shadow-large uk-box-shadow-hover-small";
                    ?>

                    <tr uk-toggle="target: #preview-modal-<?php echo $index; ?>" style="cursor: pointer;">
                        <td><?php echo htmlspecialchars($job['company']); ?></td>
                        <td><?php echo htmlspecialchars($job['title']); ?></td>
                        <td><?php echo htmlspecialchars($job['location']); ?></td>
                        <td><?php echo htmlspecialchars($job['posted']); ?></td>
                        <td><span class="uk-label <?php echo $labelClass ?>"><?php echo $fit; ?>%</span></td>
                    </tr>

                    <!-- Modal -->
                    <div id="preview-modal-<?php echo $index; ?>" uk-modal>
                        <div class="uk-modal-dialog uk-modal-body uk-width-1-1@s uk-height-large uk-overflow-auto">
                            <h2 class="uk-modal-title"><?php echo htmlspecialchars($job['title']); ?> at <?php echo htmlspecialchars($job['company']); ?></h2>
                            <p><strong>Location:</strong> <?php echo htmlspecialchars($job['location']); ?> (<?php echo htmlspecialchars($job['type']); ?>)</p>
                            <p><strong>Posted:</strong> <?php echo htmlspecialchars($job['posted']); ?></p>
                            <hr>
                            <p><?php echo nl2br(htmlspecialchars($job['description'])); ?></p>
                            <div class="uk-margin">
                                <a href="<?php echo htmlspecialchars($job['url']); ?>" target="_blank" class="uk-button uk-button-primary">Apply Now</a>
                                <button class="uk-button uk-button-default uk-modal-close" type="button">Close</button>
                            </div>
                        </div>
                    </div>

                    <?php endforeach; ?>

                </tbody>
            </table>

        </div>
    </div>

</body>
</html>
