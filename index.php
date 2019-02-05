<?php
require_once 'config.php';

$controller = new PresenteController();
$controller->index('Página inicial');
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
                <section class="col-md-6 column ">

                    <?php if ($controller->login) echo '<h4 class="alert alert-warning" style="margin: 10px auto; text-align: center">' . $controller->login . '</h4>'; ?>

                    <form class="form-basic" role="form" method="post">
                        <hr>
                        <h2 class="intro-text text-center"><strong>Efetue o login</strong>
                        </h2>
                        <hr>
                        <p><input type="email" name="email" class="form-control" placeholder="Digite seu email" required></p>
                        <p><input type="password" name="senha" class="form-control" placeholder="Digite sua senha" required></p>
                        <label class="checkbox">
                            <input type="checkbox" name="lembrete" > Lembrar senha
                        </label>
                        <p><button name="login" class="btn btn-lg btn-info btn-block" type="submit">Entrar</button></p>
                    </form>

                </section>

                <section class="col-md-6 column ">

                    <?php if ($controller->mensagem) echo '<h4 class="alert alert-warning" style="margin: 10px auto; text-align: center">' . $controller->mensagem . '</h4>'; ?>

                    <form class="form-basic" method="post" >
                        <hr>
                        <h2 class="intro-text text-center"><strong>Cadastre-se agora</strong>
                        </h2>
                        <hr>
                        <p><input type="email" name="email" class="form-control" placeholder="Digite seu email" required></p>
                        <p><input type="text" name="nome" class="form-control" placeholder="Digite seu nome" required></p>

                        <p><input type="password" name="senha" class="form-control" placeholder="Digite sua senha" required></p>
                        <p><button name="cadastro" class="btn btn-lg btn-info btn-block" type="submit">Cadastrar</button></p>
                    </form>
                </section>

            </div>

            <section class="row clearfix box">
                <hr>
                <h2 class="intro-text text-center"><strong>Como criar sua própria lista?</strong>
                </h2>
                <hr>

                <div class="col-md-12 column">

                    <div class="row clearfix dica">

                        <div class="col-md-6 column">
                            <img class="img-responsive" alt="fig" src="bootstrap/img/index/fig1.jpg">
                        </div>
                        <div class="col-md-6 column">

                            <p>
                                Nosso site tem o intuito de oferecer aos nossos usuários um ambiente virtual para compartilhar
                                com amigos os presentes que gostaria de receber em uma ocasião especial, como aniversário,
                                casamento e chá de bebê dentre outros.
                            </p>

                        </div>

                    </div>
                    <hr>
                    <div class="row clearfix dica">
                        <div class="col-md-6 column">
                            <img class="img-responsive" alt="fig" src="bootstrap/img/index/fig2.jpg">
                        </div>
                        <div class="col-md-6 column">

                            <p>
                                Ao efetuar o cadastro, você terá uma seção exclusiva para criar sua própria lista de presentes
                                e selecionar uma foto de perfil
                            </p>
                        </div>

                    </div>
                    <hr>
                    <div class="row clearfix dica">
                        <div class="col-md-6 column">
                            <img class="img-responsive" alt="fig" src="bootstrap/img/index/fig3.jpg">
                        </div>
                        <div class="col-md-6 column">

                            <p>
                                Após criada a lista, você pode navegar pelo menu produtos e adicionar à sua lista os presentes
                                que gostaria de receber
                            </p>
                        </div>

                    </div>
                    <hr>
                    <div class="row clearfix dica">
                        <div class="col-md-6 column">
                            <img class="img-responsive" alt="fig" src="bootstrap/img/index/fig4.jpg">
                        </div>
                        <div class="col-md-6 column">
                            <p>
                                Uma vez adicionados, os produtos podem ser consultados na sua página de perfil, clicando no
                                menu início. Clicando sobre o código do produto você é direcionado direto ao produto. Além
                                disso, você pode excluir produtos da sua lista no momento que desejar
                            </p>

                        </div>

                    </div>
                    <hr>
                    <div class="row clearfix dica">
                        <div class="col-md-6 column">
                            <img class="img-responsive" alt="fig" src="bootstrap/img/index/fig5.jpg">
                        </div>
                        <div class="col-md-6 column">

                            <p>
                                No menu produtos, além de adicionar novos produtos à sua lista, você pode clicar no link
                                buscar produto e ser redirecionado para um site que trabalhe com a venda do produto. Caso
                                você não possua cadastro, você poderá visualizar produtos mas não adicioná-los à uma lista.
                            </p>
                        </div>

                    </div>
                    <hr>
                    <div class="row clearfix dica">
                        <div class="col-md-6 column">
                            <img class="img-responsive" alt="fig" src="bootstrap/img/index/fig6.jpg">
                        </div>
                        <div class="col-md-6 column">
                            <p>
                                Compartilhe sua lista enviando seu link ou indicando um a amigo por email.
                            </p>

                        </div>

                    </div>
                    <hr>
                    <div class="row clearfix dica">
                        <div class="col-md-6 column">
                            <img class="img-responsive" alt="fig" src="bootstrap/img/index/fig7.jpg">
                        </div>
                        <div class="col-md-6 column">
                            <p>
                                Visualize a lista de outras pessoas e divirta-se
                            </p>

                        </div>

                    </div>
                    <hr>

                </div>
            </section>

        </div>

    </body>

</html>
