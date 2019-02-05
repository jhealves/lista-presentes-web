<?php
require_once 'config.php';

$controller = new PresenteController();
$controller->home('Pagina inicial de ');
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

                <?php if ($controller->mensagem) echo '<h4 class="alert alert-warning" style="margin: 10px auto; text-align: center">' . $controller->mensagem . '</h4>'; ?>

                <hr>
                <h2 class="intro-text text-center"><strong>Meu Perfil</strong>
                </h2>
                <hr>
                <article class="col-md-6 column ">
                    <h4 class="intro-text text-center">Imagem de perfil</h4>
                    <img class="img-responsive img-border-left" src="<?php echo IMG_PATH . 'usuario' . SPR . $controller->perfil['foto']; ?>" alt="">
                    <hr />
                    <form class="form-basic" method="post" enctype="multipart/form-data">
                        <p><input class="form-control" type="file" name="arquivo"/></p>
                        <p><button name="enviarFoto" class="btn btn-lg btn-info btn-block" type="submit">Enviar</button></p>

                    </form>

                </article>

                <article class="col-md-6 column ">
                    <h4 class="intro-text text-center">Dados de perfil</h4>
                    <div class=" perfil">
                        <?php
                        //var_dump($controller->perfil);
                        echo '<p>Nome: ' . $controller->perfil['nome'] . '</p>';
                        echo '<p>Email: ' . $controller->perfil['email'] . '</p>';
                        echo '<p><a href="listas.php?search_id=' . $controller->perfil['id'] . '">Meu link</a>';
                        echo '<p>Data da criação: ' . $controller->perfil['criacao'] . '</p>';
                        ?>
                    </div>
                    <br />

                    <div class="bg-warning lista">
                        <h3>Minha Lista</h3>
                        <?php
                        if ($controller->lista) {
                            echo '<p>' . $controller->lista['descricao'] . '</p>';
                            echo '<form method="post" style="width: 150px;">';
                            echo '<button name="excluirLista" class="btn btn-danger" type="submit"><span class="glyphicon glyphicon-remove"> Excluir</span></button>';
                            echo '</form>';
                        } else {
                            echo '<form method="post" style="width: 250px;">';
                            echo '<input type="text" name="descricao" class="form-control" placeholder="Coloque aqui o nome de sua lista" required>';
                            echo '<br />';
                            echo '<button name="criarLista"  class="btn btn-lg btn-info btn-block" type="submit">Criar lista</button>';
                            echo '</form>';
                        }
                        ?>  

                    </div>
                </article>
            </div>


            <section class="row clearfix box">
                <hr>
                <h2 class="intro-text text-center"><strong>Serviços para sua lista</strong>
                </h2>
                <hr>

                <div class="col-md-12 column">

                    <div class="col-md-6 column" style="background-color: #fff;">
                        <h3 class="intro-text text-center">Itens da minha lista</h3>
                        <a href="produtos.php" class="btn btn-lg btn-success">Adicionar Itens</a>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Código</th>
                                    <th>Descricão</th>
                                    <th>Excluir</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                if ($controller->itens) {
                                    foreach ($controller->itens as $item) {
                                        echo '<tr>';
                                        echo '<td>' . $item['codigo'] . '</td> ';
                                        echo '<td>' . $item['nome'] . '</td> ';
                                        echo '<td>';
                                        echo '<form method="post">';
                                        echo '<input type="hidden" name="codProduto" value="' . $item['codigo'] . '">';
                                        echo '<button name="excluirItem" class="btn btn-danger" type="submit"><span class="glyphicon glyphicon-remove"></span> Excuir</button>';
                                        echo '</form>';
                                        echo '</td>';
                                        echo '</tr>';
                                    }
                                }
                                ?>

                            </tbody>
                        </table>

                    </div>
                    <div class="col-md-6 column">

                        <h3 class="intro-text text-center">Indicar para um amigo</h3>
                        <form class="form-basic" role="form" method="post">

                            <p><input type="text" name="nome" class="form-control" placeholder="Nome" required></p>
                            <p><input type="email" name="email" class="form-control" placeholder="Email" required></p>
                            <p><button class="btn btn-lg btn-info btn-block" type="submit">Indicar</button></p>
                        </form>
                    </div>

                </div>
            </section>

        </div>

    </body>

</html>
