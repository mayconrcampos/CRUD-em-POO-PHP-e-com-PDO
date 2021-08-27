Primeiro CRUD utilizando Programação Orientada a Objeto, utilizando PDO.

Frontend tosco sem CSS, somente para fins de estudos.

- Inicialmente, este CRUD foi feito com padrão Singleton pelo professor da Node Studio, mas não foi aplicado neste estudo.

Basicamente temos os arquivos: 

    - conexao.php - Contém a conexao com o banco de dados utilizando PDO. A classe conexão e apenas um método estático, chamado getConn(), o qual retorna a conexão.

    - DB.php - Contém a classe DB com os métodos: insert, select, update e delete.

    - usuarios.php - contém a classe Usuario, a qual conta com os atributos que correspondem as colunas da tabela cadastro.
        - id
        - nome
        - email

    - executaDB - Foi uma classe que criei para conter os métodos mais específicos que manipulam diretamente os dados no arquivo index.php. Os métodos contidos em executaDB são: 
        - indexSelectUserDB($id), o qual recebe um ID, instancia um DB, utiliza o método select($id) para trazer somente os dados de um registro. O parâmetro $id possui valor nulo por default, pra quando quiser utilizar o mesmo método para fazer um select de toda a tabela.
    
        - indexDeleteUserDB($id), o qual também recebe um ID, instanciando um objeto do tipo DB, utilizando o método delete e passando o ID como parâmetro.

        - indexEditarUserDB($nome, $email, $id) - o qual recebe nome, email e id, instanciando um objeto DB e, também, instanciando um objeto Usuario, setando nome, email e id, para depois inserir este objeto Usuário como parâmetro no método update da instância de DB. Mas como este é um método privado, ele só pode ser chamado pelo outro método que será o próximo que vou falar.

        - indexInsertOrEditUser($nome, $email, $id=null) - Se este método receber um ID como parâmetro, ele irá executar o if, chamando o método anterior indexEditarUserDB.
        Mas se caso ele não receber um ID, o elseif será executado criando um objeto do tipo Usuário e um objeto do tipo DB, setando atributos de usuário nome e email para depois inserir este objeto como parâmetro no método insert.
    
