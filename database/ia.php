<?php
use App\Ai\Agents\CustomAgent;
use Illuminate\Http\Request;

Route::post('/coach', function (Request $request) {
    $response = (new CustomAgent)
        ->prompt('Analyze this sales transcript...', attachments: [
            $request->file('transcript'),
        ]);

    return [
        'analysis' => (string) $response,
    ];
});