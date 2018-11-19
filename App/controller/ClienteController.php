<?php

namespace App\controller;

use App\model\ClienteDAO;
use App\bean\ClienteBean;
use App\View\View;

class ClienteController {

    function __construct(){
        
    }
    function showAdd(){
        $View = new View();
        $View->render('clientes_add');
    }
    function add($params){
        $ClienteBean = new ClienteBean($params);
        $ClienteDAO = new ClienteDAO;
        if( empty($ClienteBean->getErrors()) ){
            if( !empty($ClienteBean->getId()) ) {
                echo $ClienteDAO->edit($ClienteBean);
            } else {
                echo $ClienteDAO->add($ClienteBean);
            }
        } else {
            echo json_encode(["sucesso" => 0, "errors" => $ClienteBean->errors]);
        }
    }
    function showEdit($id){
        $ClienteDAO = new ClienteDAO;
        $page_data = [
            "cliente" => $ClienteDAO->getById($id)
        ];
        $View = new View;
        //reaproveitando a tela 
        $View->render('clientes_add',$page_data);
    }
    function list(){
        $ClienteDAO = new ClienteDAO;
        $page_data = [
            "clientes" => $ClienteDAO->list()
        ];
        $View = new View;
        $View->render('clientes_list',$page_data);
    }

    function delete($id){
        $ClienteDAO = new ClienteDAO;
        echo json_encode($ClienteDAO->delete($id));
    }

    function getQtde(){
        $ClienteDAO = new ClienteDAO;
        return $ClienteDAO->getQtde();
    }
    function showView($id){
        $ClienteDAO = new ClienteDAO;
        $page_data = [
            "cliente" => $ClienteDAO->getById($id)
        ];
        $View = new View;
        //reaproveitando a tela 
        $View->render('clientes_view',$page_data);

    }
}