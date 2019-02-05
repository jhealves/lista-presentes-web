<?php

class Login {

    

    public function verificaLogin() {

        session_start();

        if (!array_key_exists("email", $_SESSION)) {
            return false;
        }

        return true;
    }

    public function validarLogin($email, $senha) {

        try {
            $sql = "SELECT * FROM usuario WHERE email= ? AND senha=?";
            $stmt = Conexao::getConexao()->prepare($sql);
            $stmt->bindValue(1, $email);
            $stmt->bindValue(2, $senha);
            $stmt->execute();
            $result = $stmt->rowCount();

            return $result;
        } catch (Exception $ex) {
            return false;
        }
    }

    public function efetuarLogout() {
        session_start();
        if (isset($_SESSION['email'])) {
            session_destroy();
            setcookie('email', '', time() - 3600);

            header('Location:index.php');
            exit;
        } else
            header('Location: index.php');
    }

}
