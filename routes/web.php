<?php

use App\Http\Controllers\MemoController;
use Illuminate\Support\Facades\Route;

Route::get('/', [MemoController::class, 'list'])->name('memo.list');
Route::post('/', [MemoController::class, 'create'])->name('memo.create');
Route::get('/new', [MemoController::class, 'new'])->name('memo.new');
