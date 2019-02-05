<?php
require_once 'config.php';

$controller = new PresenteController();
$controller->listas('Página inicial');
?>
<!DOCTYPE html>
<html>
    <?php include INC . 'head.php'; ?>

    <body>
        <div class="container">
            <header class="row clearfix ">
                <div class="col-md-8 column box-title">

                    Presentes.meu

                </div>
                <div class="col-md-4 column " style="margin-top: 25px;">

                    <form class="form-inline text-right" role="form" method="get">

                        <input type="text" name="search_nome" class="form-control" placeholder="Nome do usuário" required>
                        <button class="btn btn-success" type="submit"><span class="glyphicon glyphicon-search"></span> Buscar</button>
                    </form>

                </div>
            </header>
            <?php include_once INC . 'nav.php'; ?>

            <?php
            if ($controller->listas) {
                foreach ($controller->listas as $perfil) {
                    ?>

                    <div class="row clearfix box">
                        <hr>
                        <h2 class="intro-text text-center"><strong><?php echo isset($perfil['lista'][0]) ? $perfil['lista'][0]['descricao'] : 'Sem itens'; ?></strong>
                        </h2>
                        <hr>
                        <section class="col-md-6 column text-center">

                            <h4 class="intro-text text-center">Perfil</h4>
                            <img class="img-responsive img-border-left" src="<?php echo IMG_PATH . 'usuario' . SPR . $perfil['foto']; ?>" alt="">
                            <p>Nome: <?php echo $perfil['nome']; ?></p>
                            <p>Email: <?php echo $perfil['email']; ?></p>
                            <p><?php echo '<a href="listas.php?search_id=' . $perfil['id'] . '"><span class="glyphicon glyphicon-link"></span> Link</a>'  ; ?></p>
                            <p>Data de criação: <?php echo $perfil['criacao']; ?></p>

                        </section>

                        <section class="col-md-6 column ">
                            <?php if (isset($perfil['lista'])) { ?>
                            <h3 class="intro-text text-center">Itens da lista</h3>
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Código</th>
                                        <th>Nome</th>
                                        <th>Detalhes</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php
                                    
                                        foreach ($perfil['lista']as $item) {
                                            echo '<tr>';
                                            echo '<td>' . $item['codigo'] . '</td>';
                                            echo '<td>' . $item['nome'] . '</td>';
                                            echo '<td><a href="produtos.php#'  . $item['codigo'].  '" class="btn btn-info" ><span class="glyphicon glyphicon-gift"></span> Ver</a></td>';
                                            echo '</tr>';
                                        }
                                    
                                    ?>
                                </tbody>
                            </table>
                            <?php }?>
                        </section>

                    </div>
            <?php
                }
            }
            ?>

        </div>
    </body>
</html>
