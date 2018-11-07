<!-- Projeto GitHub: https://github.com/jccamargo15/projeto-web2 -->
<nav class="col-md-2 d-none d-md-block bg-light sidebar">
    <div class="sidebar-sticky">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link <?php if ($page=='home') {echo 'active';} ?>" href="?page=home">
                    <span data-feather="home"></span> Home
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="">
                    <span data-feather="file"></span> Cadastro
                </a>
                <ul>
                    <li class="nav-subitem">
                        <a class="nav-link <?php if ($page=='cadastro_conta') {echo 'active';} ?>" href="?page=cadastro_conta">
                            <span data-feather="credit-card"></span>Contas
                        </a>
                    </li>
                    <li class="nav-subitem">
                        <a class="nav-link <?php if ($page=='cadastro_categoria') {echo 'active';} ?>" href="?page=cadastro_categoria">
                            <span data-feather="bookmark"></span>Categorias
                        </a>
                    </li>
                    <li class="nav-subitem">
                        <a class="nav-link <?php if ($page=='cadastro_item') {echo 'active';} ?>" href="?page=cadastro_item">
                            <span data-feather="gift"></span>Item
                        </a>
                    </li>
                </ul>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="#">
                    <span data-feather="dollar-sign"></span>Movimentação
                </a>
                <ul>
                    <li class="nav-subitem">
                        <a class="nav-link <?php if ($page=='movimentacao_credito') {echo 'active';} ?>" href="?page=movimentacao_credito">
                            <span data-feather="plus-square"></span>Crédito
                        </a>
                    </li>
                    <li class="nav-subitem">
                        <a class="nav-link <?php if ($page=='movimentacao_debito') {echo 'active';} ?>" href="?page=movimentacao_debito">
                            <span data-feather="minus-square"></span>Débito
                        </a>
                    </li>
                </ul>
            </li>

            <li class="nav-item">
                <a class="nav-link <?php if ($page=='relatorios') {echo 'active';} ?>" href="?page=relatorios">
                    <span data-feather="bar-chart-2"></span>
                    Relatórios
                </a>
            </li>

        </ul>
    </div>
</nav>