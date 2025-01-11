<?php
// TMDb API Key
$apiKey = 'your_tmdb_api_key';

// Get series TMDb ID and optional season number
$tmdbId = $_GET['tmdb_id'] ?? null;
$seasonNumber = $_GET['season'] ?? null;

if (!$tmdbId) {
    echo json_encode(['error' => 'Missing tmdb_id']);
    exit;
}

// Build the TMDb API URL
$tmdbApiUrl = $seasonNumber
    ? "https://api.themoviedb.org/3/tv/$tmdbId/season/$seasonNumber?api_key=$apiKey&language=en-US"
    : "https://api.themoviedb.org/3/tv/$tmdbId?api_key=$apiKey&language=en-US";

// Fetch data
$response = file_get_contents($tmdbApiUrl);
$data = json_decode($response, true);

// Add custom streaming URL data
if ($seasonNumber) {
    $data['streaming_url'] = $_GET['streaming_url'] ?? '';
} else {
    foreach ($data['seasons'] as &$season) {
        $seasonNumber = $season['season_number'];
        $season['streaming_url'] = $_GET["season_$seasonNumber"] ?? '';
    }
}

// Return JSON response
header('Content-Type: application/json');
echo json_encode($data);
