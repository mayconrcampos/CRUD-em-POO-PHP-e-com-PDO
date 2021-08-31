<?php

use App\Model\DB;
use App\Model\Usuario;

include_once("./DB.php");
include_once("./conexao.php");

class IndexDB {

    public static function indexSelectUserDB($id){
        $listaUser = New DB();
        foreach($listaUser->select($id) as $user){
            $nome = $user['nome'];
            $email = $user['email'];
        }

        return array($nome, $email);
    }




    static function indexDeleteUserDB($id){
        $db = new DB();
        $db->delete($id);
        header("Refresh: 0; index.php");
    }



    // Método Switch - Ele recebe três parâmetros e decide se vai executar o insert ou update na tabela.

    public static function SwitchEditaOuInsere($nome, $email, $id=null){
        if(!empty($id)){
            IndexDB::indexEditarUserDB($nome, $email, $id);
        }else{
            IndexDB::indexInsertUser($nome, $email);
        }
    }

    private static function indexEditarUserDB($nome, $email, $id) {
        if(!empty($nome) and !empty($email) and !empty($id)){

            $nome = filter_var($nome, FILTER_SANITIZE_STRING);
            $email = filter_var($email, FILTER_SANITIZE_EMAIL);

            $User = new Usuario();
            $User->setNome($nome);
            $User->setEmail($email);
            $User->setID($id);

            $db = new DB();
            $db->update($User);
            header("Refresh: 0; index.php");
        }else{
            echo "ERRO ao editar usuário. É preciso preencher todos os campos.";
        }
        
    }

    private static function indexInsertUser($nome, $email){
        if(!empty($nome) and !empty($email)){
            $nome = filter_var($nome, FILTER_SANITIZE_STRING);
            $email = filter_var($email, FILTER_SANITIZE_EMAIL);

            $User = new Usuario();
            $User->setNome($nome);
            $User->setEmail($email);

            $db = new DB();
            $db->insert($User);
            header("Refresh: 0; index.php");
        }else{
            echo "Erro ao inserir usuário. É preciso preencher todos os campos.";
        }
    }
}