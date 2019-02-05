<?php

class Usuario {

    public function getUsuario($email) {
        try {
            $sql = "select * from usuario where email= '$email'";
            $stmt = Conexao::getConexao()->prepare($sql);
            $stmt->bindValue(1, $email);

            $stmt->execute();


            if ($stmt->rowCount() > 0) {
                $result = $stmt->fetch(PDO::FETCH_BOTH);

                return $result;
            }

            return false;
        } catch (Exception $ex) {
            return false;
        }
    }
    
    public function getUsuarioByField($field, $value) {
        try {
                        
            $sql = "select * from usuario where $field like '%$value%'";
            
            $stmt = Conexao::getConexao()->prepare($sql);
            $stmt->bindValue(1, $value);

            $stmt->execute();


            if ($stmt->rowCount() > 0) {
                $result = $stmt->fetchAll(PDO::FETCH_BOTH);

                return $result;
            }

            return false;
        } catch (Exception $ex) {
            return false;
        }
    }

    public function getUsuarios() {
        try {
            $sql = "select * from usuario";
            $stmt = Conexao::getConexao()->prepare($sql);
            $stmt->execute();


            if ($stmt->rowCount() > 0) {
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                return $result;
            }

            return false;
        } catch (Exception $ex) {
            return false;
        }
    }

    public function addUsuario($email, $nome, $senha) {

        try {
            $sql = "INSERT INTO usuario VALUES (?, ?, ?, ?, ?, ?)";
            $stmt = Conexao::getConexao()->prepare($sql);
            $stmt->bindValue(1, $email);
            $stmt->bindValue(2, md5($email));
            $stmt->bindValue(3, $nome);
            $stmt->bindValue(4, $senha);
            $stmt->bindValue(5, '2014-01-01');
            $stmt->bindValue(6, 'padrao.jpg');
            $stmt->execute();

            return 'Usuário cadastrado com sucesso';
        } catch (Exception $ex) {
            if ($ex->errorInfo[1] == 1062) {
                return 'Usuário já existente';
            } else {
                return 'Erro ao cadastrar usuário';
            }
        }
    }

    public function addFoto($email, $foto) {
        try {
            $sql = "UPDATE usuario SET foto = ? WHERE email = ?";
            $stmt = Conexao::getConexao()->prepare($sql);
            $stmt->bindValue(1, $foto);
            $stmt->bindValue(2, $email);
            $stmt->execute();

            return 'Foto inserida';
        } catch (Exception $ex) {
            return 'Erro ao inserir foto';
        }
    }

}
