<?php

require "conexaoMysql.php";
require_once "autenticacao.php";

session_start();
$pdo = mysqlConnect();
exitWhenNotLogged($pdo);

$medico = $_SESSION['emailUsuario'];
try {

  $sql = <<<SQL
  SELECT a.Data,a.Horario,a.Nome,a.Sexo,a.Email,m.Nome
  FROM Agenda a
  inner join Pessoa m on a.CodigoMedico = m.Codigo and m.Email=?
  SQL;


  $stmt = $pdo->prepare($sql);
  $stmt->execute([$medico]);
} catch (Exception $e) {
  exit('Ocorreu uma falha: ' . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

  <link rel="stylesheet" href="../css/defaut.css" />

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous" />

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">

  <title>Agendamentos Medico</title>
</head>


<body>
  <header>
    <nav class="navbar">
      <img src="../images/logo.png" alt="logo" height="70" width="70" />
      <div>
        <ul class="nav nav-pills">
          <li class="itemmenu"><a href="home.php"><i class="bi bi-house"></i> Home</a></li>
          <li class="itemmenu"><a href="galeria_session.php"><i class="bi bi-image"></i> Galeria</a></li>
          <li class="itemmenu"><a href="cadastro_enderecos_session.php"><i class="bi bi-geo"></i> Novo Endereço</a></li>
          <li class="itemmenu"><a href="agendamento_session.php"><i class="bi bi-calendar2-event"></i> Agendamento</a></li>
          <li class="itemmenu"><a href="../html/cadastro_funcionarios.php"><i class="bi bi-person-plus-fill"></i> Novo funcionario</a></li>
          <li class="itemmenu"><a href="../html/cadastro_paciente.php"><i class="bi bi-person-heart"></i> Novo paciente</a></li>
          <li class="itemmenu"><a href="listar_funcionarios.php"><i class="bi bi-person-badge-fill"></i> Funcionarios</a></li>
          <li class="itemmenu"><a href="listar_pacientes.php"><i class="bi bi-person-hearts"></i> Pacientes</a></li>
          <li class="itemmenu"><a href="listar_enderecos.php"><i class="bi bi-geo-alt-fill"></i> Endereços</a></li>
          <li class="itemmenu"><a href="listar_agendamentos.php"><i class="bi bi-calendar-event-fill"></i> Agendamentos</a></li>
          <li class="itemmenu"><a href="listar_agendamentos_por_medico.php"><i class="bi bi-calendar-heart-fill"></i> Agendamentos Médico</a></li>
        </ul>
      </div>
      <div class="itemmenu">
        <a href="logout.php"><i class="bi bi-door-closed-fill"></i> Sair</a>
      </div>
    </nav>
  </header>


  <main>
    <h3>Agendamento Medico</h3>
    <table class="table table-striped table-hover">
      <tr>

        <th>DATA</th>
        <th>HORARIO</th>
        <th>Nome</th>
        <th>Sexo</th>
        <th>Email</th>
        <th>Nome do Medico</th>
      </tr>

      <?php
      while ($row = $stmt->fetch()) {
        $data = htmlspecialchars($row['Data']);
        $horario = htmlspecialchars($row['Horario']);
        $nome = htmlspecialchars($row['Nome']);
        $sexo = htmlspecialchars($row['Sexo']);
        $email = htmlspecialchars($row['Email']);
        $codigomedico = htmlspecialchars($row['Nome']);
        echo <<<HTML
          <tr>
            
            <td>$data</td> 
            <td>$horario</td>
            <td>$nome</td>
            <td>$sexo</td>
            <td>$email</td>
            <td>$codigomedico</td>
          </tr>      
        HTML;
      }
      ?>

    </table>
  </main>


  <footer>
    <div class="rodape">

      <div id="imgrodape">
        <img src="../images/logoinv.png" alt="logo" height="200" width="200" />
      </div>

      <div class="mapa">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1887.0900545011502!2d-48.286494991772166!3d-18.92342035954946!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x94a444f8f2f407cd%3A0x13b587c75013856b!2sR.%20Tiradentes%20-%20Fundinho%2C%20Uberl%C3%A2ndia%20-%20MG%2C%2038400-200!5e0!3m2!1spt-BR!2sbr!4v1647036787373!5m2!1spt-BR!2sbr" width="200" height="200" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
        <!-- <h6>ENDEREÇO:</h6> -->
        <ul id="listarodape">
          <li><i class="bi bi-telephone-fill"></i> (34) 9232-3232</li>
          <li><i class="bi bi-envelope-fill"></i> clinicagmv@mail.com</li>
          <li>CEP: 38400-200</li>
          <li>R. Tiradentes, 200</li>
          <li>Uberlândia - MG</li>
        </ul>
      </div>
    </div>
  </footer>


  <!-- Optional JavaScript -->
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>