<?php

class Lista {

    public function addLista($email, $descricao) {
        try {
            $sql = "INSERT INTO lista VALUES (?, ?, ?)";
            $stmt = Conexao::getConexao()->prepare($sql);
            $stmt->bindValue(1, '0');
            $stmt->bindValue(2, $descricao);
            $stmt->bindValue(3, $email);

            $stmt->execute();

            return true;
        } catch (Exception $ex) {

            return false;
        }
    }

    public function addItem($email, $produto) {

        try {
            $lista = $this->getLista($email);

            if (!$lista) {
                return 'Lista não encontrada';
            }
            
            $sql = "INSERT INTO item VALUES (?, ?)";
            $stmt = Conexao::getConexao()->prepare($sql);
            $stmt->bindValue(1, $lista['codigo']);
            $stmt->bindValue(2, $produto);
            $stmt->execute();

            return 'Produto adicionado à lista';
        } catch (Exception $ex) {
            if ($ex->errorInfo[1] == 1062) {
                return 'Produto já adicionado à lista';
            } else {
                return 'Produto não adicionado';
            }
        }
    }

    public function getLista($email) {
        try {
            $sql = "select * from lista where usuario= '$email'";
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

    public function getItens($lista) {
        try {
            $sql = "select produto.codigo, produto.nome from produto "
                    . "inner join item on item.produto_codigo = produto.codigo "
                    . "inner join lista on lista.codigo = item.lista_codigo "
                    . "where lista.codigo = ?";


            $stmt = Conexao::getConexao()->prepare($sql);
            $stmt->bindValue(1, $lista);

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
    
    public function getItensByUsuario($email) {
        try {
            $sql = "select produto.codigo, produto.nome, lista.descricao from produto "
                    . "inner join item on item.produto_codigo = produto.codigo "
                    . "inner join lista on lista.codigo = item.lista_codigo "
                    . "inner join usuario on usuario.email = lista.usuario "
                    . "where usuario.email = ?";


            $stmt = Conexao::getConexao()->prepare($sql);
            $stmt->bindValue(1, $email);

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

    public function removeLista($email) {
        try {
            $sql = "delete from lista where usuario= '$email'";
            $stmt = Conexao::getConexao()->prepare($sql);
            $stmt->bindValue(1, $email);

            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                return 'Lista excluida!';
            }else{
                return 'Nenhuma lista excluida';
            }

            
        } catch (Exception $ex) {
            return 'Erro ao excluir lista';
        }
    }
    
    public function removeItem($lista, $produto){
        try {
            $sql = "delete from item where lista_codigo= $lista "
                    . "and produto_codigo = $produto";
            $stmt = Conexao::getConexao()->prepare($sql);
            $stmt->bindValue(1, $lista);
            $stmt->bindValue(2, $produto);

            $stmt->execute();
            
            if ($stmt->rowCount() > 0) {
                return 'Item excluido';
            }else{
                return 'Nenhum item removido';
            }

            
        } catch (Exception $ex) {
            return 'Erro ao excluir item';
        }
    }
}
