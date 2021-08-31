<?php

use App\Model\DB;

include_once("./Model/DB.php");
include_once("./Model/Produto.php");
include_once("./Model/usuarios.php");
include_once("./Model/IndexDB.php")
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro simples usando Classes e PDO</title>
</head>
<body>
    <h1>Cadastro de nome e email</h1>

    <?php 
        // Tanto delete, quanto o edita só funcionam aqui acima do form. 
        // Trazendo nome e email do DB para dentro dos campos nome e email, através do ID
        if(!empty($_GET['edita']) and empty($_POST['nome']) and empty($_POST['email'])){
            $nomeSenha = IndexDB::indexSelectUserDB($_GET['edita']);
        }
        // Trazendo id via Get sob nome delete para deletar o item e dar refresh na página
        if(!empty($_GET['delete'])){
            IndexDB::indexDeleteUserDB($_GET['delete']);
        }
    ?>

    <div>
        <form action="" method="post">
            <label for="">Nome</label>
            <input type="text" name="nome" value="<?php echo (empty($_GET['edita'])) ? "" : $nomeSenha[0]; ?>">

            <label for="">Email</label>
            <input type="email" name="email" value="<?php echo (empty($_GET['edita'])) ? "" : $nomeSenha[1]; ?>">

            <button type="submit" name="btn"><?php echo (!empty($_GET['edita']) ? "Altera" : "Cadastra") ?></button>
        </form>
    </div>

    <?php
        // Se o botão for presssionado, o método irá ser invocado...
        // Questões de validação de entrada de inputs são realizados nos métodos da classe IndexDB.

        // Note bem que os métodos que são chamados pelo botão só funcionam aqui abaixo do form. Já os que recebem variáveis via get, funcionam na parte acima do formulário.
        if(isset($_POST['btn'])){
            IndexDB::SwitchEditaOuInsere($_POST['nome'], $_POST['email'], $_GET['edita']);
        }
    ?>

    <hr>
    <div>
        <table width="500px" border="1px">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
            <?php   $lista = new DB();
                    foreach($lista->select() as $linha){?>
                    <tr>
                        <td><a id="link" href="?edita=<?php echo $linha['id'] ?>"><?php echo $linha['id'] ?></a></td>
                        <td><?php echo $linha['nome'] ?></td>
                        <td><?php echo $linha['email'] ?></td>
                        <td><a href=?delete=<?php echo $linha['id'] ?> onclick="return confirm('Tem certeza que você quer deletar?')">Delete</a></td>
                    </tr>
                        
    <?php           }?>
            </tbody>
        </table>
    </div>
    <a href="./Model/refresh.php">Refresh</a>
    
</body>
</html>
