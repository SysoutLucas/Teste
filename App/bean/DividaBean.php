<?php
namespace App\bean;

class DividaBean
{
	public $id;
	public $clienteId;
	public $descricao;
	public $valor;
	public $vencimento;
	public $status;
	public $criadoEm;
    public $atualizadoEm;
    public $errors = [];

    function __construct($params = []){
		$this->setId($params["id"] ?? "");
		$this->setClienteId($params["cliente_id"] ?? "");
        $this->setDescricao($params["descricao"] ?? "");
        $this->setValor($params["valor"] ?? "");
        $this->setVencimento($params["vencimento"] ?? "");
        $this->setStatus($params["status"] ?? "4");
    }

	// Metodos getters
	function getId(){
		return $this->id;
	}
	function getClienteId(){
		return $this->ClienteId;
	}
	function getDescricao(){
		return $this->descricao;
	}
	function getValor(){
		return $this->valor;
	}
	function getVencimento(){
		return $this->vencimento;
	}
	function getStatus(){
		return $this->status;
	}
	function getErrors(){
		return $this->errors;
	}
	// fim metodos getters

	//Métodos setters

	function setId($id){
		$this->id = $id;
	}
	function setClienteId($clienteId){
		if( !empty($clienteId) ){
			$this->clienteId = $clienteId;
		} else {
			$this->setError(["campo" => "cliente_id", "error" => "O campo <b>Cliente</b> é obrigatório"]);
		}
	}
	function setDescricao($descricao){
		if( !empty($descricao) ) {
			$this->descricao = $descricao;
		} else {
			$this->setError(["campo" => "descricao", "error" => "O campo <b>Descrição</b> é obrigatório"]);
		}
	}
	function setValor($valor){
		if( !empty($valor) ) {
			if( validaValor($valor) ){
				$this->valor = formataValor($valor);
			} else {
				$this->setError(["campo" => "valor" , "error" => "O campo <b>Valor</b> é inválido"]);
			}
		} else {
			$this->setError(["campo" => "valor" , "error" => "O campo <b>Valor</b> é obrigatório"]);
		}
	}
	function setVencimento($vencimento){
		if( !empty($vencimento) ) {
            if( validaData($vencimento) ) {
                $this->vencimento = formataData($vencimento);
            } else {
                $this->setError(["campo" => "vencimento" , "error" => "O campo <b>Vencimento</b> é inválido"]);
            }
		} else {
			$this->setError(["campo" => "vencimento" , "error" => "O campo <b>Vencimento</b> é obrigatório"]);
		}
	}
	function setStatus($status){
		if( !empty($status)) {
			$this->status = $status;
		} else {
			$this->setError(["campo" => "status" , "error" => "O campo <b>Status</b> é obrigatório"]);
		}	
	}
	function setCriadoEm($criadoEm){
		$this->criadoEm = $criadoEm;
	}
	function setAtualizadoEm($atualizadoEm){
		$this->atualizadoEm = $atualizadoEm;
	}
	function setError($error){
		array_push($this->errors,$error);
	}
}
 ?>
