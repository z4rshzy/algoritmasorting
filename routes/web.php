<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SelectionSortController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/selection-sort', [SelectionSortController::class, 'index']);
Route::post('/selection-sort/angka', [SelectionSortController::class, 'sortAngka']);
Route::post('/selection-sort/objek', [SelectionSortController::class, 'sortObjek']);

use App\Http\Controllers\InsertionSortController;
Route::get('/insertion-sort', [InsertionSortController::class, 'index']);
Route::post('/insertion-sort/angka', [InsertionSortController::class, 'sortAngka']);
Route::post('/insertion-sort/objek', [InsertionSortController::class, 'sortObjek']);

use App\Http\Controllers\MergeSortController;
Route::get('/merge-sort', [MergeSortController::class, 'index']);
Route::post('/merge-sort/angka', [MergeSortController::class, 'sortAngka']);
Route::post('/merge-sort/objek', [MergeSortController::class, 'sortObjek']);
