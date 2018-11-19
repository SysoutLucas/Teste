<?php

namespace App\model;

class DividaDAO {

    function __construct(){
        //
    }

    function add($DividaBean) {
        
        $conn = ConnectionFactory::getInstance();
        try {
            
            $sql = "INSERT INTO dividas (cliente_id, descricao, valor, vencimento, status) values 
            (:cliente_id, :descricao, :valor, :vencimento, :status)";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(":cliente_id",$DividaBean->clienteId);
            $stmt->bindParam(":descricao",$DividaBean->descricao);
            $stmt->bindParam(":valor",$DividaBean->valor);
            $stmt->bindParam(":vencimento",$DividaBean->vencimento);
            $stmt->bindValue(":status",4);
            $stmt->execute();
            if($stmt->rowCount() > 0 ){
                $retorno = [
                    "sucesso" => 1
                ];
            } else {
                $retorno = [
                    "sucesso" => 2,
                    "error_message" => "Falha ao processar as informações"
                ];
            }
        } catch (\PDOExeption $e){
            $retorno = [
                "sucesso" => 2,
                "error_message" => $e->getMessage()
            ];

        } finally {
            ConnectionFactory::closeInstance();
            return json_encode($retorno);
        }
    }

    function edit($DividaBean){
        
        $conn = ConnectionFactory::getInstance();
        try {
            $sql = "UPDATE dividas SET
                    cliente_id = :cliente_id,
                    descricao = :descricao,
                    valor = :valor,
                    vencimento = :vencimento,
                    status = :status
                    WHERE id = :id";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(":id",$DividaBean->id);
            $stmt->bindParam(":cliente_id",$DividaBean->clienteId);
            $stmt->bindParam(":descricao",$DividaBean->descricao);
            $stmt->bindParam(":valor",$DividaBean->valor);
            $stmt->bindParam(":vencimento",$DividaBean->vencimento);
            $stmt->bindParam(":status",$DividaBean->status);
            $stmt->execute();
            if($stmt->rowCount() > 0 ){
                $retorno = [
                    "sucesso" => 1
                ];
            } else {
                $retorno = [
                    "sucesso" => 2,
                    "error_message" => "Nenhum dado foi alterado"
                ];
            }
        } catch (\PDOExeption $e){
            $retorno = [
                "sucesso" => 2,
                "error_message" => $e->getMessage()
            ];
        } finally {
            ConnectionFactory::closeInstance();
            return json_encode($retorno);
        }
    }

    function list(){
        $conn = ConnectionFactory::getInstance();
        try {
            $sql = "SELECT D.*,C.id as cliente_id,C.nome FROM dividas D 
                    INNER JOIN clientes C
                    ON C.id = D.cliente_id
                    WHERE D.status <> 5";
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            if($stmt->rowCount() > 0) {
                $retorno = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            } else {
                $retorno = [];
            }
        } catch (\PDOExeption $e) { 
            exit($e->getMessage());
        } finally {
            ConnectionFactory::closeInstance();
            return $retorno;
        }
    }
    function getById($id){
        
        $conn = ConnectionFactory::getInstance();
        try {
            $sql = "SELECT D.*,S.titulo, C.nome FROM dividas D
                    INNER JOIN status S
                    ON D.status = S.id
                    INNER JOIN clientes C
                    ON C.id = D.cliente_id
                    WHERE D.id = :id";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(":id",$id);
            $stmt->execute();
            if( $stmt->rowCount() > 0 ) {
                $retorno = $stmt->fetch(\PDO::FETCH_ASSOC);
            } else {
                $retorno = [];
            }
        } catch (\PDOExeption $e) {
            exit($e->getMessage());
        } finally {
            ConnectionFactory::closeInstance();
            return $retorno;
        }
    }

    function delete($id){
        $conn = ConnectionFactory::getInstance();
        try {
            $sql = "UPDATE  dividas 
                    SET status = 5
                    WHERE id = :id";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(":id",$id);
            $stmt->execute();
            if( $stmt->rowCount() > 0 ) {
                $retorno = [
                    "sucesso" => 1
                ];
            } else {
                $retorno = [
                    "sucesso" => 0,
                    "error_message" => "Nenhum dado alterado"
                ];
            }
        } catch (\PDOExeption $e) {
            exit($e->getMessage());
        } finally {
            ConnectionFactory::closeInstance();
            return $retorno;
        }
    }

    function getQtde(){
        $conn = ConnectionFactory::getInstance();
        try {
            $sql = "SELECT COUNT(*) as quantidade FROM dividas WHERE status <> 5";
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            if( $stmt->rowCount() > 0 ) {
                $retorno = $stmt->fetch(\PDO::FETCH_ASSOC);
            } else {
                $retorno = [];
            }
        } catch (\PDOExeption $e) {
            exit($e->getMessage());
        } finally {
            ConnectionFactory::closeInstance();
            return $retorno;
        }
    }
}