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
require_once "autenticacao.php";

session_start();
$pdo = mysqlConnect();
exitWhenNotLogged($pdo);



$nome = $_POST["nome"] ?? "";
$sexo = $_POST["sexo"] ?? "";
$email = $_POST["email"] ?? "";
$telefone = $_POST["telefone"] ?? "";
$cep = $_POST["cep"] ?? "";
$logradouro = $_POST["logradouro"] ?? "";
$cidade = $_POST["cidade"] ?? "";
$estado = $_POST["estado"] ?? "";



$data = $_POST["data"] ?? "";
$salario = $_POST["salario"] ?? "";
$senha = $_POST["senha"] ?? "";
$hashsenha = password_hash($senha, PASSWORD_DEFAULT);

$ifmedico = $_POST["check"] ?? "";
$especialidade = $_POST["especialidade"] ?? "";
$crm = $_POST["crm"] ?? "";



try {

    $sql = <<<SQL
        INSERT INTO Pessoa (Nome, Sexo, Email, Telefone, CEP, Logradouro, Cidade, Estado)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?)
    SQL;

    $sql2 = <<<SQL
        INSERT INTO Funcionario (DataContrato, Salario, SenhaHash, Codigo)
        VALUES (?, ?, ?, ?)
    SQL;

    
    


    $pdo->beginTransaction();
    $stmt = $pdo->prepare($sql);
    if (!$stmt->execute([$nome, $sexo, $email, $telefone, $cep, $logradouro, $cidade, $estado])) {
        throw new Exception('Não foi possível inserir');
    }

    $idFuncionario = $pdo->lastInsertId();
    $stmt2 = $pdo->prepare($sql2);

    if (!$stmt2->execute([$data, $salario, $hashsenha, $idFuncionario])) {
        throw new Exception('Não foi possível inserir');
    }

    if($ifmedico=="on"){
        $sql3 = <<<SQL
            INSERT INTO Medico (Codigo,Especialidade,CRM)
            VALUES (?, ?, ?)
        SQL;
        $stmt3=$pdo->prepare($sql3);
        if (!$stmt3->execute([$idFuncionario, $especialidade, $crm])) {
            throw new Exception('Não foi possível inserir');
        }
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
