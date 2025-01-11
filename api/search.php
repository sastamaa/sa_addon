<?php
$query = strtolower($_GET['query'] ?? '');

// Load data files
$movies = json_decode(file_get_contents('../movies/list.json'), true);
$series = json_decode(file_get_contents('../series/list.json'), true);

// Merge and filter results
$results = [];
foreach ($movies as $movie) {
    if (strpos(strtolower($movie['title'] ?? ''), $query) !== false) {
        $results[] = $movie;
    }
}
foreach ($series as $show) {
    if (strpos(strtolower($show['title'] ?? ''), $query) !== false) {
        $results[] = $show;
    }
}

// Output JSON
header('Content-Type: application/json');
echo json_encode($results);
?>
