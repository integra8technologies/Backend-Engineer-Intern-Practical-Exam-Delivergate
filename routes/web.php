<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('pos.index');
});

// Routes for Role Dashboards
Route::get('/owner-dashboard', function () {
    return view('pos.owner');
});

Route::get('/manager-dashboard', function () {
    return view('pos.manager');
});

Route::get('/cashier-dashboard', function () {
    return view('pos.cashier');
});
