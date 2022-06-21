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
$sexo  = $_POST["sexo"] ?? "";
$email = $_POST["email"] ?? "";
$data = $_POST["data_agendamento"] ?? "";
$medico = $_POST["medico"] ?? "";
$hora = $_POST["inputHorario"] ?? "";


try {

    $sql = <<<SQL
        SELECT Codigo FROM Pessoa WHERE Nome = ?
    SQL;

    $stmt = $pdo->prepare($sql);
    $stmt->execute([$medico]);
    $idmedico = $stmt->fetch();

    $sql2 = <<<SQL
        INSERT INTO Agenda (Data,Horario,Nome,Sexo,Email,CodigoMedico)
        VALUES (?,?,?,?,?,?)
    SQL;

    $pdo->beginTransaction();
    $stmt2 = $pdo->prepare($sql2);
    if (!$stmt2->execute([$data, $hora, $nome, $sexo, $email, $idmedico['Codigo']])) {
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
