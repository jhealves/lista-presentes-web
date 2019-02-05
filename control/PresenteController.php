<?php

class PresenteController {

    //atributos de página
    public $titulo = 'Presentes.meu';
    public $mensagem = false;
    public $login = false;
    //atributos de controle 
    public $produtos = false;
    public $lista = false;
    public $itens = false;
    public $perfil = false;
    public $listas = false;

    public function index($titulo) {

        session_start();

        if (array_key_exists("email", $_SESSION)) {
            header('Location: home.php');
            exit;
        }

        if (isset($_COOKIE['email'])) {

            $_SESSION['email'] = $_COOKIE['email'];
            header('Location:home.php');
            exit;
        }

        $this->titulo = $titulo;

        if ($_SERVER['REQUEST_METHOD'] == "POST") {

            if (isset($_POST['login'])) {

                $email = $_POST['email'];
                $senha = $_POST['senha'];
                $login = new Login();

                if ($login->validarLogin($email, $senha)) {

                    if (isset($_POST['lembrete'])) {

                        setcookie('email', $email, time() + 60 * 60);
                    }

                    $_SESSION['email'] = $email;

                    header('Location:home.php');
                    exit;
                } else {
                    $this->login = "Dados Inválidos";
                }
            }


            if (isset($_POST['cadastro'])) {
                $email = $_POST['email'];
                $nome = $_POST['nome'];
                $senha = $_POST['senha'];

                $usuario = new Usuario();
                $this->mensagem = $usuario->addUsuario($email, $nome, $senha);
            }
        }
    }

    public function produtos($titulo) {
        $this->titulo = $titulo;
        $p = new Produto();
        $this->produtos = $p->getProdutos();

        $login = new Login();
        if ($login->verificaLogin()) {

            $this->login = true;

            if (isset($_POST['add'])) {
                $lista = new Lista();

                $this->mensagem = $lista->addItem($_SESSION['email'], $_POST['add']);
            }
        }
    }

    public function home($titulo) {
        $login = new Login();
        if (!$login->verificaLogin()) {
            header('Location: index.php');
            exit();
        }
        $this->titulo = $titulo;

        if (isset($_POST['criarLista'])) {
            $descricao = $_POST['descricao'];
            $l = new Lista();
            $resultado = $l->addLista($_SESSION['email'], $descricao);

            if (!$resultado) {
                $this->mensagem = 'Erro ao criar lista';
            }
        }

        if (isset($_POST['excluirLista'])) {
            $l = new Lista();
            $this->mensagem = $l->removeLista($_SESSION['email']);
        }

        if (isset($_POST['enviarFoto'])) {

            $this->mensagem = $this->uploadFoto($_SESSION['email'], $_FILES['arquivo'], IMG_PATH . 'usuario' . SPR);
        }

        $u = new Usuario();

        $this->perfil = $u->getUsuario($_SESSION['email']);

        $this->titulo .= $this->perfil['nome'];


        $l = new Lista();
        $this->lista = $l->getLista($_SESSION['email']);

        if ($this->lista) {

            if (isset($_POST['excluirItem'])) {

                //$l = new Lista();
                $this->mensagem = $l->removeItem($this->lista['codigo'], $_POST['codProduto']);
            }

            $this->itens = $l->getItens($this->lista['codigo']);
        }
    }

    public function listas($titulo) {
        session_start();
        $this->titulo = $titulo;
        $u = new Usuario();

        
        if(isset($_GET['search_nome'])){
            $this->listas = $u->getUsuarioByField('nome', $_GET['search_nome']);
        }else if (isset($_GET['search_id'])) {
            $this->listas = $u->getUsuarioByField('id', $_GET['search_id']);
        }  
        else {
            $this->listas = $u->getUsuarios();
        }
        

        

        if ($this->listas) {

            $l = new Lista();

            $getLista = array();

            $i = 0;
            foreach ($this->listas as $itens) {
                $getItens = $l->getItensByUsuario($itens['email']);

                if ($getItens) {

                    $this->listas[$i]['lista'] = $getItens;
                    //$perfil['lista'] = $getLista;
                }
                $i++;
            }
        }
    }

    private function uploadFoto($email, $arquivo, $pasta) {
        $tipo = $arquivo['type'];
        $tamanho = $arquivo['size'] / 1024;
        $erro = $arquivo['error'];
        $nome = $arquivo['name'];
        $temp = $arquivo['tmp_name'];

        if ($erro > 0) {
            return 'Erro ao selecionar arquivo';
        } else if ($tamanho > 100) {
            return 'Tamanho inadequado';
        } else if ($tipo == 'jpg') {
            return 'Tipo incorreto de arquivo';
        }

        $foto = md5($nome) . rand(0, 10000) . '.jpg';

        if (!move_uploaded_file($temp, $pasta . $foto)) {
            return 'Erro ao fazer upload de arquivo';
        }


        $u = new Usuario();
        $fotoAntiga = $u->getUsuario($email);
        if ($fotoAntiga['foto'] != 'padrao.jpg') {
            unlink($pasta . $fotoAntiga['foto']);
        }

        return $u->addFoto($email, $foto);
    }

}
