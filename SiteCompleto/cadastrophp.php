<?php
session_start();

$msg = "";

class Cadastro
{
    private $paciente;
    private $email;
    private $senha;
    private $sexo;
    private $nascimento;
    private $telefone;
    private $conn;
    
    public function __construct($conn,$paciente, $email, $sexo, $senha, $nascimento, $telefone)
    {

        $this->conn = $conn;
        $this->paciente = $paciente;
        $this->email = $email;
        $this->senha = $senha;
        $this->sexo = $sexo;
        $this->nascimento = $nascimento;
        $this->telefone = $telefone;
    }

    public function checandoEmail()
    {        

        try {

            // Verificando se o e-mail já existe
            $checandoEmailquery = "SELECT id FROM paciente WHERE email = :email";

            $checandoStmt = $this->conn->prepare($checandoEmailquery);
            $checandoStmt->bindParam(':email', $this->email);
            $checandoStmt->execute();
            
            if ($checandoStmt->rowCount() > 0) {
                // E-mail já existe, redireciona de volta para a página de cadastro
                $_SESSION['msg'] = "Email já cadastrado";
                header("Location: cadastro.php");
                exit();
            }
        } catch (PDOException $e) {
            error_log($e->getMessage());
            echo "Erro ao acessar o banco de dados.";
        }
    }

    
    public function cadastrando()
    {
        try {
            $cripto = password_hash($this->senha, PASSWORD_DEFAULT);
            // Consulta SQL para inserir os dados
            $query = "INSERT INTO paciente (paciente,email,senha,data_nascimento,telefone,id_sexo) VALUES (:paciente,:email,:senha,:data_nascimento,:telefone,:sexo)";
            $enviando = $this->conn->prepare($query);

            // Bind dos parâmetros
            $enviando->bindParam(':paciente', $this->paciente);
            $enviando->bindParam(':email', $this->email);
            $enviando->bindParam(':senha', $cripto);
            $enviando->bindParam(':data_nascimento', $this->nascimento);
            $enviando->bindParam(':telefone', $this->telefone);
            $enviando->bindParam(':sexo', $this->sexo);


            // Executa a consulta
            if ($enviando->execute()) {
                header("Location: index.php");
                exit();
            } 
        } catch (PDOException $e) {
            echo "Erro ao acessar o banco de dados.";
        }
    }
}


if (isset($_POST['enviar'])) {
    include_once "../../configdb.php";
    try {
        $cadastro = new Cadastro($conn,$_POST['paciente'], $_POST['email'], $_POST['sexo'], $_POST['senha'], $_POST['nascimento'], $_POST['telefone']);

        $cadastro->checandoEmail();
        $cadastro->cadastrando();
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}
