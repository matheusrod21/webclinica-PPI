<?php

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
require "conexaoMysql.php";
$pdo = mysqlConnect();


$nome = $_POST["nome"] ?? "";
$sexo = $_POST["sexo"] ?? "";
$email = $_POST["email"] ?? "";
$telefone = $_POST["telefone"] ?? "";
$cep = $_POST["cep"] ?? "";
$logradouro = $_POST["logradouro"] ?? "";
$cidade = $_POST["cidade"] ?? "";
$estado = $_POST["estado"] ?? "";
$peso = $_POST["peso"] ?? "";
$altura = $_POST["altura"] ?? "";
$tipos = $_POST["tipos"] ?? "";

try {

  $sql = <<<SQL
        INSERT INTO Pessoa (Nome, Sexo, Email, Telefone, CEP, Logradouro, Cidade, Estado)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?)
    SQL;

  $sql2 = <<<SQL
        INSERT INTO Paciente (Peso, Altura, TipoSanguineo, Codigo)
        VALUES (?, ?, ?, ?)
    SQL;


    $pdo->beginTransaction();
    $stmt = $pdo->prepare($sql);
    if (!$stmt->execute([$nome, $sexo, $email, $telefone, $cep, $logradouro, $cidade, $estado])) {
        throw new Exception('Não foi possível inserir');
    }

    $idPessoa = $pdo->lastInsertId();
    $stmt2 = $pdo->prepare($sql2);

    if (!$stmt2->execute([$peso, $altura, $tipos, $idPessoa])) {
        throw new Exception('Não foi possível inserir');
    }

    $pdo->commit();


  header("location: ../index.html");
  exit();
} catch (Exception $e) {
  //error_log($e->getMessage(), 3, 'log.php');
  if ($e->errorInfo[1] === 1062)
    exit('Dados duplicados: ' . $e->getMessage());
  else
    exit('Falha ao cadastrar os dados: ' . $e->getMessage());
}



    

