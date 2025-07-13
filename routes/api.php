<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;

Route::get('/proxy/ideas', function (Request $request) {
    $page = $request->input('page', 1); // default 1
    $size = $request->input('size', 10); // default 10
    $sort = $request->input('sort', '-published_at'); // default descending
    $backendUrl = '';

    // Kirim request ke backend API
    $response = Http::get($backendUrl, [
        'page[number]' => $page,
        'page[size]' => $size,
        'append' => ['small_image', 'medium_image'],
        'sort' => $sort,
    ]);

    // Forward response langsung ke client
    return response()->json($response->json(), $response->status());
});


