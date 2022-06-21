<?php

require "conexaoMysql.php";
class RequestResponse
{
  public $success;
  public $destination;
  function __construct($success, $destination)
  {
    $this->success = $success;
    $this->destination = $destination;
  }
}

$pdo = mysqlConnect();

$cep = $_POST["cep"] ?? "";
$cidade = $_POST["cidade"] ?? "";
$logradouro = $_POST["logradouro"] ?? "";
$estado = $_POST["estado"] ?? "";


try {

  $sql = <<<SQL
    INSERT INTO BasedeEndereçosAJAX (CEP,Cidade,Logradouro,Estado)
    VALUES (?, ?, ?, ?)
    SQL;

  $stmt = $pdo->prepare($sql);
  $stmt->execute([
    $cep, $cidade, $logradouro, $estado
  ]);
  header("location: ../index.html");
  exit();
} catch (Exception $e) {
  if ($e->errorInfo[1] === 1062)
    exit('Dados duplicados: ' . $e->getMessage());
  else
    exit('Falha ao cadastrar os dados: ' . $e->getMessage());
}
