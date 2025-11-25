<?php

namespace App\Controllers;

use App\Core\Auth;

class HomeController {

    public function index() {
        Auth::check();
        include __DIR__ . '/../Views/home.php';
    }
}