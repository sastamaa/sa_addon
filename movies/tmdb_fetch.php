<?php
// Your TMDb API Key
$apiKey = '28797e7035babad606ddbc1642d2ec8b';

// Get the TMDb ID from the request
$tmdbId = $_GET['tmdb_id'] ?? null;

// If no TMDb ID is provided, return an error
if (!$tmdbId) {
    echo json_encode(['error' => 'Missing tmdb_id']);
    exit;
}

// TMDb API URL for fetching movie details
$tmdbApiUrl = "https://api.themoviedb.org/3/movie/$tmdbId?api_key=$apiKey&language=en-US";

// Fetch movie details from TMDb
$response = file_get_contents($tmdbApiUrl);
$movieDetails = json_decode($response, true);

// Add your streaming link to the movie data
$movieDetails['streaming_url'] = $_GET['streaming_url'] ?? '';

// Return the data as JSON
header('Content-Type: application/json');
echo json_encode($movieDetails);
