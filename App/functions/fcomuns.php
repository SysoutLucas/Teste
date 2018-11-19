<?php

function validaCpf($cpf) {
    // Extrai somente os números
    $cpf = preg_replace( '/[^0-9]/is', '', $cpf );
    if (strlen($cpf) != 11) return false;
    // Verifica se foi informada uma sequência de digitos repetidos. Ex: 111.111.111-11
    if (preg_match('/(\d)\1{10}/', $cpf)) return false;
    // Faz o calculo para validar o CPF
    for ($t = 9; $t < 11; $t++) {
        for ($d = 0, $c = 0; $c < $t; $c++) {
            $d += $cpf{$c} * (($t + 1) - $c);
        }
        $d = ((10 * $d) % 11) % 10;
        if ($cpf{$c} != $d) return false;
    }
    return true;
}

function validaEmail($email){
    if ( filter_var($email, FILTER_VALIDATE_EMAIL) ) {
        return true;
    } else {
        return false;
    }
}

function validaCep($cep){
    if ( !preg_match('/^[0-9]{5,5}([- ]?[0-9]{3,3})?$/', $cep) ) {
        return false;
    } else {
        return true;
    }
}
function validaData($data) {
    $data = str_replace("/","-",$data);
	return ((strtotime($data)) !== false);
}
function formataData($data){
    $data = str_replace("/","-",$data);
    return date('Y-m-d',strtotime($data));
}
function validaValor($valor){
    $valor = str_replace('.','', $valor);
    $valor = str_replace(',','.', $valor);
    return is_numeric($valor);
}

function formataValor($valor){
    $valor = str_replace('.','', $valor);
    $valor = str_replace(',','.', $valor);
    return $valor;
}