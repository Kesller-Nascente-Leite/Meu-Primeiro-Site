<?php
session_start();
$msg = "";
class Atendimento extends Cadastro
{
    public $conn;
    public $id;
    public $paciente;
    public $pontuario;
    public $observacoes;
    public $historico;
    public $examesResultados;
    public function __construct($conn, $id, $paciente, $pontuario, $observacoes, $historico, $examesResultados)
    {
        $this->conn = $conn;
        $this->id = $id;
        $this->paciente = $paciente;
        $this->pontuario  = $pontuario;
        $this->observacoes = $observacoes;
        $this->historico = $historico;
        $this->examesResultados = $examesResultados;
    }
    public function historico()
    {
        // Consulta SQL
        $queryTabela = 'SELECT * FROM pontuario;';
        $tabela = $this->conn->query($queryTabela);

        // Exibindo resultados em HTML
        echo "<table border='1'>\n";
        while ($linha = $tabela->fetch()) {
            echo "\t<tr>\n";
            foreach ($linha as $coluna) {
                echo "\t\t<td>" . htmlspecialchars($coluna) . "</td>\n";
            }
            echo "\t</tr>\n";
        }
        echo "</table>\n";
    }
}



include_once "cadastrophp.php";
include_once "../../configdb.php";
$atendimeto = new Atendimento($conn, $id, $_SESSION['paciente'], $_POST['pontuario'], $_POST['observacoes'], $_POST['historico'], $_POST['examesResultado']);



if (isset($_SESSION['paciente'])) {
    $paciente = $_SESSION['paciente'];
} else {
    $paciente = $_SESSION['paciente'] = "Usuario não logado";
}
