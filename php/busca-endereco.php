<?php

require "conexaoMysql.php";
$pdo = mysqlConnect();

class Endereco
{

  public $cidade;
  public $logradouro;
  public $estado;

  function __construct($cidade, $logradouro, $estado)
  {

    $this->cidade = $cidade;
    $this->logradouro = $logradouro;
    $this->estado = $estado;
  }
}


$cep = $_GET['cep'] ?? '';


try {
  $sql = <<<SQL
    SELECT Cidade,Logradouro,Estado
    FROM BasedeEndereçosAJAX
    WHERE CEP = ?
    SQL;

  $stmt = $pdo->prepare($sql);
  $stmt->execute([$cep]);
  $row = $stmt->fetch();
} catch (Exception $e) {
  echo $e;
}


$endereco = new Endereco($row['Cidade'], $row['Logradouro'], $row['Estado']);


echo json_encode($endereco);
