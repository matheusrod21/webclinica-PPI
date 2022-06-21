<?php
require "conexaoMysql.php";
$pdo = mysqlConnect();
$nome = $_GET['nome'] ?? '';
$data = $_GET['data'] ?? '';
try {
    $sql = <<<SQL
        SELECT a.Horario 
        from Agenda a 
        join Pessoa m 
        on a.CodigoMedico = m.Codigo 
        WHERE m.Nome=? and a.Data=?
    SQL;
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$nome, $data]);
    $horarios = $stmt->fetchAll();
} catch (Exception $e) {
    echo $e;
}
echo json_encode($horarios);
