<?php
$response = null;

if (isset($_POST['submit'])) {
    // Prepare search parameters
    $keywords = ['react', 'node'];
    $roles = ['frontend'];
    $exclude = ['robotics', 'hardware'];
    $locations = [
        'Toronto' => 'in-person',
        'Quebec City' => 'remote',
        'Waterloo' => 'any'
    ];

    // Convert to query string
    $query = http_build_query([
        'keywords' => implode(',', $keywords),
        'roles' => implode(',', $roles),
        'exclude' => implode(',', $exclude),
        'locations' => json_encode($locations)
    ]);

    // Make GET request to Node.js API
    $url = "http://api:4000/search?$query";

    // Use file_get_contents (or you can use cURL instead)
    $responseJson = @file_get_contents($url);

    if ($responseJson === false) {
        $response = ['error' => 'Failed to connect to API'];
    } else {
        $response = json_decode($responseJson, true);
    }
}
?>

    <h2>Test Search API</h2>

    <form method="POST">
        <button type="submit" name="submit">Send Search Request</button>
    </form>

    <?php if ($response): ?>
        <h3>Response:</h3>
        <pre><?php echo htmlspecialchars(json_encode($response, JSON_PRETTY_PRINT)); ?></pre>
    <?php endif; ?>

