<?php
require_once 'config.php';
$controller = new PresenteController();
$controller->produtos('Página de produtos');
?>
<!DOCTYPE html>
<html>

    <?php include INC . 'head.php'; ?>

    <body>
        <div class="container">
            <header class="row clearfix box-title">
                <div class="col-md-12 column">

                    Presentes.meu

                </div>
            </header>
            <?php include_once INC . 'nav.php'; ?>

            <div class="row clearfix box">

                <section class="col-lg-12">
                    <?php if ($controller->mensagem) echo '<h4 class="alert alert-warning" style="margin: 10px auto; text-align: center">' . $controller->mensagem . '</h4>'; ?>
                    <hr>

                    <h2 class="intro-text text-center"><strong>Produtos para sua lista</strong>
                    </h2>
                    <hr>
                </section>

                <?php foreach ($controller->produtos as $produto) { 
                        echo '<a id="' . $produto['codigo'] . '"></a>';
                ?>
                    
                    <article class="col-lg-12 text-center margin-botton">

                        <img class="img-responsive" src="<?php echo IMG_PATH . 'produtos/' . $produto['foto']; ?>" alt="foto" />
                        <h2><?php echo $produto['nome']; ?>
                            <br>
                            <small><?php echo $produto['buscar']; ?></small>
                        </h2>
                        <p><?php echo $produto['descricao']; ?></p>
                        <?php
                        if ($controller->login) {
                            echo '<form method="post">';
                            echo '<input type="hidden" name="add" value="' . $produto['codigo'] . '">';
                            echo '<button class="btn btn-default btn-lg">Adicionar à lista</button>';

                            echo '</form>';
                        }
                        ?> 
                    </article>
                <?php } ?>

            </div>

        </div>

    </body>

</html>
