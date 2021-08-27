<?php
namespace App\Model;

include_once("conexao.php");
include_once("./usuarios.php");

class DB {

    public function insert(Usuario $user){

        $query = "INSERT INTO cadastro (nome, email) VALUES (?, ?)";

        $stmt = \App\Model\Conexao::getConn()->prepare($query);
        $stmt->bindValue(1, $user->getNome());
        $stmt->bindValue(2, $user->getEmail());

        $stmt->execute();
    }

    
    public function select($id=null){

        if(!empty($id)){
            $query = "SELECT * FROM cadastro WHERE id=?";

            $stmt = \App\Model\Conexao::getConn()->prepare($query);
            $stmt->bindValue(1, $id);
            $stmt->execute();

        }else{
            $query = "SELECT * FROM cadastro ORDER BY nome ASC";

            $stmt = \App\Model\Conexao::getConn()->prepare($query);
            $stmt->execute();
        }
        
        

        if($stmt->rowCount() > 0){
            $resultado = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            return $resultado;
        }else{
            return [];
        }

    }


    public function update(Usuario $user){

        $query = "UPDATE cadastro SET nome=?, email=? WHERE id=?";

        $stmt = \App\Model\Conexao::getConn()->prepare($query);
        $stmt->bindValue(1, $user->getNome());
        $stmt->bindValue(2, $user->getEmail());
        $stmt->bindValue(3, $user->getID());

        $stmt->execute();
    }
    

    public function delete($id){
        $query = "DELETE FROM cadastro WHERE id=?";

        $stmt = \App\Model\Conexao::getConn()->prepare($query);
        $stmt->bindValue(1, $id);

        $stmt->execute();
    }
}
