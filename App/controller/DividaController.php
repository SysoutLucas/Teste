<?php

namespace App\controller;

use App\model\DividaDAO;
use App\model\ClienteDAO;
use App\bean\DividaBean;
use App\View\View;

class DividaController {

    function __construct(){
        
    }
    function showAdd(){
        $View = new View();
        $ClienteDAO = new ClienteDAO;
        $page_data = [
            "clientes" => $ClienteDAO->list()
        ];
        $View->render('dividas_add',$page_data);
    }
    function add($params){
        $DividaBean = new DividaBean($params);
        $DividaDAO = new DividaDAO;
        if( empty($DividaBean->getErrors()) ){
            if( !empty($DividaBean->getId()) ) {
                echo $DividaDAO->edit($DividaBean);
            } else {
                echo $DividaDAO->add($DividaBean);
            }
        } else {
            echo json_encode(["sucesso" => 0, "errors" => $DividaBean->errors]);
        }
    }
    function showEdit($id){
        $DividaDAO = new DividaDAO;
        $ClienteDAO = new ClienteDAO;
        $page_data = [
            "divida" => $DividaDAO->getById($id),
            "clientes" => $ClienteDAO->list()
        ];
        $View = new View;
        //reaproveitando a tela 
        $View->render('dividas_add',$page_data);
    }
    function list(){
        $DividaDAO = new DividaDAO;
        $page_data = [
            "dividas" => $DividaDAO->list()
        ];
        $View = new View;
        $View->render('dividas_list',$page_data);
    }

    function delete($id){
        $DividaDAO = new DividaDAO;
        echo json_encode($DividaDAO->delete($id));
    }

    function getQtde(){
        $DividaDAO = new DividaDAO;
        return $DividaDAO->getQtde();
    }

    function showView($id){
        $DividaDAO = new DividaDAO;
        $page_data = [
            "divida" => $DividaDAO->getById($id)
        ];
        $View = new View;
        //reaproveitando a tela 
        $View->render('dividas_view',$page_data);

    }
}