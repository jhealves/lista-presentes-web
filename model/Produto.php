<?php

class Produto {

    function getProdutos() {
        try {
            $sql = "SELECT * FROM produto";
            $stmt = Conexao::getConexao()->query($sql);
            $result = $stmt->fetchAll(PDO::FETCH_BOTH);


            return $result;
        } catch (Exception $ex) {
            return false;
        }
    }

}
