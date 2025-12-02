    <!-- chama a parte fixa da navbar -->
    <?php include(__DIR__."/menu.php"); ?>
                </ul>
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a href="/<?= $_ENV['BASE_URL']; ?>/logout" class="btn btn-danger">Sair</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <main>

        <div>
            <div style="text-align: center;">
                <h3>Bem-vindo(a) <?= $_SESSION['nomeSobrenome'] ?></h3>
                
            </div>
        </div>

    </main>

</body>

</html>