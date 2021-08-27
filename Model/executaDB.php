<?php

use App\Model\DB;
use App\Model\Usuario;

include_once("./DB.php");
include_once("./conexao.php");

class ExecutaDB {

    static function indexSelectUserDB($id){
        $listaUser = New DB();
        foreach($listaUser->select($id) as $user){
            $nome = $user['nome'];
            $email = $user['email'];
        }

        return array($nome, $email);
    }

    static function indexDeleteUserDB($id){
        $deleteUser = new DB();
        $deleteUser->delete($id);
        header("Refresh: 0; index.php");
    }

    private static function indexEditarUserDB($nome, $email, $id) {
        $User = new Usuario();
        $User->setNome($nome);
        $User->setEmail($email);
        $User->setID($id);

        $editaUser = new DB();
        $editaUser->update($User);
        header("Refresh: 0; index.php");
    }

    static function indexInsertOrEditUser($nome, $email, $id=null){
        if(!empty($id)){
            return ExecutaDB::indexEditarUserDB($nome, $email, $id);
        }elseif($id == null){
            $nome = filter_var($nome, FILTER_SANITIZE_STRING);
            $email = filter_var($email, FILTER_SANITIZE_EMAIL);

            $User = new Usuario();
            $User->setNome($nome);
            $User->setEmail($email);

            $insertUser = new DB();
            $insertUser->insert($User);
            header("Refresh: 0; index.php");
        }
    }
}