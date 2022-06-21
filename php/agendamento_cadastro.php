<?php
require "conexaoMysql.php";
$pdo = mysqlConnect();
class Medico
{
  public $nome;

  function __construct($nome)
  {
    $this->nome = $nome;
  }
}

$especialidade = $_GET['especialidade_medica'] ?? '';

try {
  $sql = <<<SQL
    SELECT p.Nome
    FROM Pessoa p
    INNER JOIN Medico m ON p.Codigo = m.Codigo 
    WHERE m.Especialidade = ?
    SQL;

  $stmt = $pdo->prepare($sql);
  $stmt->execute([$especialidade]);
} catch (Exception $e) {
  exit('Ocorreu uma falha: ' . $e->getMessage());
}

while ($row = $stmt->fetch()) {
  $medicos[] = new Medico($row['Nome']);
}

echo json_encode($medicos);
