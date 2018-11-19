<?php
namespace App\bean;

class ClienteBean
{
	public $id;
	public $nome;
	public $dataNascimento;
	public $sexo;
	public $documento;
	public $email;
	public $cep;
	public $logradouro;
	public $numero;
	public $complemento;
	public $estado;
	public $cidade;
	public $bairro;
	public $status;
	public $criadoEm;
    public $atualizadoEm;
    public $errors = [];

    function __construct($params = []){
        $this->setId($params["id"] ?? "");
        $this->setNome($params["nome"] ?? "");
        $this->setDataNascimento($params["data_nascimento"] ?? "");
        $this->setSexo($params["sexo"] ?? "");
        $this->setDocumento($params["documento"] ?? "");
        $this->setEmail($params["email"] ?? "");
        $this->setCep($params['cep'] ?? "");
        $this->setLogradouro($params['logradouro'] ?? "");
        $this->setNumero($params['numero'] ?? "");
        $this->setComplemento($params['complemento'] ?? "");
        $this->setEstado($params['estado'] ?? "");
        $this->setCidade($params['cidade'] ?? "");
        $this->setBairro($params['bairro'] ?? "");
        $this->setStatus($params["status"] ?? "");
    }

	// Metodos getters
	function getId(){
		return $this->id;
	}
	function getNome(){
		return $this->nome;
	}
	function getDataNascimento(){
		return $this->dataNascimento;
	}
	function getSexo(){
		return $this->sexo;
	}
	function getDocumento(){
		return $this->documento;
	}
	function getEmail(){
		return $this->email;
	}
	function getCep(){
		return $this->cep;
	}
	function getLogradouro(){
		return $this->logradouro;
	}
	function getNumero(){
		return $this->numero;
	}
	function getComplemento(){
		return $this->complemento;
	}
	function getEstado(){
		return $this->estado;
	}
	function getCidade(){
		return $this->cidade;
	}
	function getBairro(){
		return $this->bairro;
	}
	function getStatus(){
		return $this->status;
	}
	function getCriadoEm(){
		return $this->criadoEm;
	}
	function getAtualizadoEm(){
		return $this->AtualizadoEm;
	}
	function getErrors(){
		return $this->errors;
	}
	// fim metodos getters

	//Métodos setters

	function setId($id){
		$this->id = $id;
	}
	function setNome($nome){
		if( !empty($nome) ) {
			$this->nome = $nome;
		} else {
			$this->setError(["campo" => "nome", "error" => "O campo <b>Nome</b> é obrigatório"]);
		}
	}
	function setDataNascimento($dataNascimento){
		if( !empty($dataNascimento) ) {
			if( validaData($dataNascimento) ){
				$this->dataNascimento = formataData($dataNascimento);
			} else {
				$this->setError(["campo" => "data_nascimento" , "error" => "O campo <b>Data de Nascimento</b> é inválido"]);
			}
		} else {
			$this->setError(["campo" => "data_nascimento" , "error" => "O campo <b>Data de Nascimento</b> é obrigatório"]);
		}
	}
	function setSexo($sexo){
		if( !empty($sexo) ) {
			$this->sexo = $sexo;
		} else {
			$this->setError(["campo" => "sexo" , "error" => "O campo <b>Sexo</b> é obrigatório"]);
		}
	}
	function setDocumento($documento){
		if( !empty($documento) ) {
			if(  validaCpf($documento) ){
				$this->documento = preg_replace( '/[^0-9]/is', '', $documento );
			} else {
				$this->setError(["campo" => "documento", "error" => "O <b>CPF</b> informado é inválido"]);
			}
			
		} else {
			$this->setError(["campo" => "documento" , "error" => "O campo <b>CPF</b> é obrigatório"]);
		}
		
	}
	function setEmail($email){
		if( !empty($email) ) {
			if( validaEmail($email) ){
				$this->email = $email;
			} else {
				$this->setError(["campo" => "email", "error" => "O <b>E-mail</b> informado é inválido"]);
			}
		} else {
			$this->setError(["campo" => "email" , "error" => "O campo <b>E-mail</b> é obrigatório"]);
		}
		
	}
	function setCep($cep){
		if( !empty($cep)) {
			if( validaCep($cep) ){
				$this->cep = preg_replace("/[^0-9]/", "", $cep);
			} else {
				$this->setError(["campo" => "cep" , "error" => "O campo <b>CEP</b> é inválido"]);
			}
		} else {
			$this->setError(["campo" => "cep" , "error" => "O campo <b>CEP</b> é obrigatório"]);
		}
		
	}
	function setLogradouro($logradouro){
		if( !empty($logradouro)) {
			$this->logradouro = $logradouro;
		} else {
			$this->setError(["campo" => "logradouro" , "error" => "O campo <b>Logradouro</b> é obrigatório"]);
		}
	}
	function setNumero($numero){
		if(!empty($numero)){
			$this->numero = $numero;
		} else {
			$this->setError(["campo" => "numero" , "error" => "O campo <b>Numero</b> é obrigatório"]);
		}
	}
	function setComplemento($complemento){
		$this->complemento = $complemento;
	}
	function setEstado($estado){
		if(!empty($estado)){
			$this->estado = $estado;
		} else {
			$this->setError(["campo" => "estado" , "error" => "O campo <b>UF</b> é obrigatório"]);
		}
		
	}
	function setCidade($cidade){
		if( !empty($cidade)) {
			$this->cidade = $cidade;
		} else {
			$this->setError(["campo" => "cidade" , "error" => "O campo <b>Cidade</b> é obrigatório"]);
		}
		
	}
	function setBairro($bairro){
		if( !empty($bairro)){
			$this->bairro = $bairro;
		} else {
			$this->setError(["campo" => "bairro" , "error" => "O campo <b>Bairro</b> é obrigatório"]);
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
