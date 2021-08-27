<?php

namespace App\Model;

class Usuario {
    private $id, $nome, $email;

    // Get Set id
    public function getID(){
        return $this->id;
    }

    public function setID($id){
        $this->id = $id;
    }

    // Get Set nome
    public function getNome(){
        return $this->nome;
    }

    public function setNome($nome){
        $this->nome = $nome;
    }

    // Get Set email
    public function getEmail(){
        return $this->email;
    }

    public function setEmail($email){
        $this->email = $email;
    }
}