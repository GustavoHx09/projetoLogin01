<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SystLog01</title>
    <link rel="stylesheet" href="/<?= $_ENV['BASE_URL']; ?>/assets/css/bootstrap.min.css">
    <script src="/<?= $_ENV['BASE_URL']; ?>/assets/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    
<nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container-fluid">
                <a class="navbar-brand" href="">
                    <h2>SystLog01</h2>
                </a>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarNavDropdown">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="/<?= $_ENV['BASE_URL']; ?>/">Início</a>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Registros
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="/<?= $_ENV['BASE_URL']; ?>/users">Registros Usuarios</a></li>
                                <li><a class="dropdown-item" href="/<?= $_ENV['BASE_URL']; ?>/grupos">Registros Grupos</a></li>
                            </ul>
                        </li>