<nav class="row clearfix box">

    <div class="col-md-12 column">

        <ul class="nav nav-pills nav-style">

            <li class="active"><a href="index.php">Inicio</a></li>
            <li><a href="listas.php">Listas</a></li>
            <li><a href="produtos.php">Produtos</a></li>
            <li><a href="contact.html">Contato</a></li>

            <?php
            if (isset($_SESSION['email'])) {
                echo '<li><a href="logout.php">Sair</a></li>';
            }
            ?>
        </ul>
    </div>

</nav>