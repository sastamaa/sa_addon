<?php

error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);
header('Content-Type: application/json');
// TMDb API Key
$api_key = "28797e7035babad606ddbc1642d2ec8b";

// List of movies (add only tmdb_id and streaming_url here)
$movies = [
    [
        "tmdb_id" => "585083", 
        "streaming_url" => "https://s1.hdvbua.pro/media1/content/stream/films/hotel_transylvania_transformania_2022_webrip_1080p_83600/hls/1080/index.m3u8"
    ],
    [
        "tmdb_id" => "616747", 
        "streaming_url" => "https://s1.hdvbua.pro/media1/content/stream/films/haunted_mansion_2023_webdl_1080p_91673/hls/1080/index.m3u8"
    ]
];

$output = [
    "type" => "list",
    "headline" => "Movies",
    "entries" => []
];

// Fetch movie details from TMDb
foreach ($movies as $movie) {
    $tmdb_id = $movie['tmdb_id'];
    $streaming_url = $movie['streaming_url'];

    // Fetch movie data from TMDb
    $response = file_get_contents("https://api.themoviedb.org/3/movie/{$tmdb_id}?api_key={$api_key}&language=en-US");
    $details = json_decode($response, true);

    // Check if the API call was successful
    if (isset($details['title'])) {
        $output['entries'][] = [
            "title" => $details['title'],
            "image" => "https://image.tmdb.org/t/p/w500" . $details['poster_path'],
            "description" => $details['overview'],
            "data" => $streaming_url
        ];
    }
}

// Output final JSON
header('Content-Type: application/json');
echo json_encode($output, JSON_PRETTY_PRINT);
?>
