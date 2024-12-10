<?php
session_start();
$msg = "";
class Atendimento
{
    private $conn;
    private $id;
    private $pontuario;
    private $observacoes;
    private $historico;
    private $examesResultados;

    public function __construct($conn, $id, $pontuario, $observacoes, $historico, $examesResultados)
    {
        $this->conn = $conn;
        $this->id = $id;
        $this->pontuario  = $pontuario;
        $this->observacoes = $observacoes;
        $this->historico = $historico;
        $this->examesResultados = $examesResultados;
    }



    private function set_historico($connNovo, $idNovo)
    {
        $this->conn = $connNovo;
        $this->id = $idNovo;

        $query = 'SELECT paciente.paciente, pontuario.observacoes_gerais, pontuario.historico_atendimento 
        FROM pontuario 
        INNER JOIN paciente ON pontuario.id_paciente = paciente.id
        WHERE pontuario.id_paciente = :id';

        $query = $connNovo->prepare($query);
        $query->bindParam(':id', $idNovo, PDO::PARAM_INT);
        if ($query->execute()) {

            echo "<table border='1'>\n";

            echo "<strong class = 'dados'>\tPaciente</strong>\t";

            echo "\t<strong class = 'dados'>Resultado</strong>\t";

            echo "\t<strong id = 'dados'>Data do Exame</strong>\t";

            while ($linha = $query->fetch(PDO::FETCH_ASSOC)) {
                echo "\t<tr>\n";
                foreach ($linha as $colunas) {
                    echo "\t<td>" . htmlspecialchars($colunas) . "</td>\n";
                }
                echo "\t</tr>\n";
            }
            echo "</table>\n";
        }
    }
    public function get_historico()
    {
        return $this->set_historico($this->conn, $this->id);
    }
}
include_once "loginphp.php";
include_once "../../configdb.php";

if (isset($_SESSION['id'])) {
    $id = $_SESSION['id'];

    $atendimeto = new Atendimento($conn, $id, $_POST['pontuario'], $_POST['observacoes'], $_POST['historico'], $_POST['examesResultado']);
} else {
    $id = "Cadastro nescessario";
}

if (isset($_SESSION['paciente'])) {
    $paciente = $_SESSION['paciente'];
} else {
    $paciente = $_SESSION['paciente'] = "Usuario não logado";
}
