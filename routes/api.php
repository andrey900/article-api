<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/tokens/create', function (Request $request) {
    $token = \App\Models\User::find(1)->createToken('test2');

    return ['token' => $token->plainTextToken];
});

//2|dGaIdahTllLD2a7P09hqaJGQlhcOd4I0SLwjVeUhe33cbbc2
