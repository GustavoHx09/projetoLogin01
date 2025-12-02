<?php

namespace App\Controllers;

use App\Core\Auth;

class HomeController {
    // redireciona para a home após o ligin efetivado
    public function index() {
        Auth::check();
        include __DIR__ . '/../Views/home.php';
    }
}