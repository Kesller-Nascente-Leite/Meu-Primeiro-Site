<?php
session_start();
$msg = "";
class Atendimento
{
    private $conn;
    private $id;

    public function __construct($conn, $id, )
    {
        $this->conn = $conn;
        $this->id = $id;

    }



    public function historico()
    {
        try {
            $this->conn;
            $this->id;

            $query = 'SELECT paciente.paciente, pontuario.observacoes_gerais, pontuario.historico_atendimento 
        FROM pontuario 
        INNER JOIN paciente ON pontuario.id_paciente = paciente.id
        WHERE pontuario.id_paciente = :id';

            $vendoHistorico = $this->conn->prepare($query);
            $vendoHistorico->bindParam(':id', $this->id, PDO::PARAM_INT);
            $vendoHistorico->execute();

            if ($vendoHistorico->rowCount() > 0) {

                echo "<table border='1'>\n";

                echo "<strong class = 'dados'>\tPaciente</strong>\t";

                echo "\t<strong class = 'dados'>Resultado</strong>\t";

                echo "\t<strong id = 'dados'>Data do Exame</strong>\t";

                while ($linha = $vendoHistorico->fetch(PDO::FETCH_ASSOC)) {
                    echo "\t<tr>\n";
                    foreach ($linha as $colunas) {
                        echo "\t<td>" . htmlspecialchars($colunas) . "</td>\n";
                    }
                    echo "\t</tr>\n";
                }
                echo "</table>\n";
            } else {
                echo "<p>Sem atendimentos no momento</p>";
            }

        } catch (Exception $e) {
            echo $e;
        } catch (PDOException $e) {
            echo $e;
        }
    }



    public function totalDeAtendimentos()
    {
        try {
            $query = 'SELECT COUNT(*) FROM pontuario WHERE id_paciente = :id';

            $totalAtendimentos = $this->conn->prepare($query);
            $totalAtendimentos->bindParam(':id', $this->id, PDO::PARAM_INT);
            $totalAtendimentos->execute();

            $resultado = $totalAtendimentos->fetch(PDO::FETCH_COLUMN);
            echo $resultado;
            
        } catch (Exception $e) {
            echo $e;
        } catch (PDOException $e) {
            echo $e;
        }
    }
}
include_once "loginphp.php";
include_once "../../configdb.php";
include 'verifica_sessao.php';


$atendimeto = new Atendimento($conn, $id, );
