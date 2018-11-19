<?php

namespace App\model;

class ClienteDAO {

    function __construct(){
        //
    }

    function add($ClienteBean) {
        $conn = ConnectionFactory::getInstance();
        try {
            
            $sql = "INSERT INTO clientes (nome, data_nascimento, sexo, documento, email, cep, logradouro, numero, complemento, estado, cidade, bairro, status) values 
            (:nome, :data_nascimento, :sexo, :documento, :email, :cep, :logradouro, :numero, :complemento, :estado, :cidade, :bairro, :status)";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(":nome",$ClienteBean->nome);
            $stmt->bindParam(":data_nascimento",$ClienteBean->dataNascimento);
            $stmt->bindParam(":sexo",$ClienteBean->sexo);
            $stmt->bindParam(":documento",$ClienteBean->documento);
            $stmt->bindParam(":email",$ClienteBean->email);
            $stmt->bindParam(":cep",$ClienteBean->cep);
            $stmt->bindParam(":logradouro",$ClienteBean->logradouro);
            $stmt->bindParam(":numero",$ClienteBean->numero);
            $stmt->bindParam(":complemento",$ClienteBean->complemento);
            $stmt->bindParam(":estado",$ClienteBean->estado);
            $stmt->bindParam(":cidade",$ClienteBean->cidade);
            $stmt->bindParam(":bairro",$ClienteBean->bairro);
            $stmt->bindParam(":status",1);
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

    function edit($ClienteBean){
        
        $conn = ConnectionFactory::getInstance();
        try {
            $sql = "UPDATE clientes SET
                    nome = :nome,
                    data_nascimento = :data_nascimento,
                    sexo = :sexo,
                    documento = :documento,
                    email = :email,
                    cep = :cep,
                    logradouro = :logradouro,
                    numero = :numero ,
                    complemento = :complemento,
                    estado = :estado,
                    cidade = :cidade ,
                    bairro = :bairro, 
                    status = :status
                    WHERE id = :id";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(":id",$ClienteBean->id);
            $stmt->bindParam(":nome",$ClienteBean->nome);
            $stmt->bindParam(":data_nascimento",$ClienteBean->dataNascimento);
            $stmt->bindParam(":sexo",$ClienteBean->sexo);
            $stmt->bindParam(":documento",$ClienteBean->documento);
            $stmt->bindParam(":email",$ClienteBean->email);
            $stmt->bindParam(":cep",$ClienteBean->cep);
            $stmt->bindParam(":logradouro",$ClienteBean->logradouro);
            $stmt->bindParam(":numero",$ClienteBean->numero);
            $stmt->bindParam(":complemento",$ClienteBean->complemento);
            $stmt->bindParam(":estado",$ClienteBean->estado);
            $stmt->bindParam(":cidade",$ClienteBean->cidade);
            $stmt->bindParam(":bairro",$ClienteBean->bairro);
            $stmt->bindParam(":status",$ClienteBean->status);
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
            $sql = "SELECT * FROM clientes WHERE status <> 3";
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
            $sql = "SELECT C.*,S.titulo FROM clientes C
                    INNER JOIN status S
                    ON C.status = S.id
                    WHERE C.id = :id";
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
            $sql = "UPDATE  clientes 
                    SET status = 3
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
            $sql = "SELECT COUNT(*) as quantidade FROM clientes WHERE status <> 3";
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