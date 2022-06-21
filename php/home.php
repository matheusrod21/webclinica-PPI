<?php

require_once "conexaoMysql.php";
require_once "autenticacao.php";

session_start();
$pdo = mysqlConnect();
exitWhenNotLogged($pdo);

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

  <title>Home GMV</title>
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

    <!-- SLIDES -->
    <div id="slide" class="carousel slide" data-ride="carousel">

      <!-- Indicadores -->
      <ul class="carousel-indicators">
        <li data-target="#slide" data-slide-to="0" class="active"></li>
        <li data-target="#slide" data-slide-to="1"></li>
        <li data-target="#slide" data-slide-to="2"></li>
        <li data-target="#slide" data-slide-to="3"></li>
        <li data-target="#slide" data-slide-to="4"></li>
        <li data-target="#slide" data-slide-to="5"></li>
      </ul>

      <!-- slideshow -->
      <div class="carousel-inner">
        <div class="carousel-item active">
          <img class="d-block w-100" src="../images/slides/foto1.png" alt="slide1" style="height: 600px">
        </div>
        <div class="carousel-item">
          <img class="d-block w-100" src="../images/slides/foto2.png" alt=" slide2" style="height: 600px">
        </div>
        <div class="carousel-item">
          <img class="d-block w-100" src="../images/slides/foto3.png" alt=" slide3" style="height: 600px">
        </div>
        <div class="carousel-item">
          <img class="d-block w-100" src="../images/slides/foto4.png" alt=" slide4" style="height: 600px">
        </div>
        <div class="carousel-item">
          <img class="d-block w-100" src="../images/slides/foto5.png" alt=" slide5" style="height: 600px">
        </div>
        <div class="carousel-item">
          <img class="d-block w-100" src="../images/slides/foto6.png" alt=" slide6" style="height: 600px">
        </div>
      </div>

      <!-- controles para esquerda e direita -->
      <a class="carousel-control-prev" href="#slide" data-slide="prev">
        <span class="carousel-control-prev-icon"></span>
      </a>
      <a class="carousel-control-next" href="#slide" data-slide="next">
        <span class="carousel-control-next-icon"></span>
      </a>

    </div>

    <section>
      <div class="sobre">
        <img src="../images/Medico.png" alt="Medico">
        <div class="text-sobre">
          <h2>Sobre Nós</h2>
          <h5>Descrição</h5>
          <p>A Clínica Médica GMV é a especialidade da Medicina. O médico desta especialidade é responsável
            por avaliar o paciente de maneira completa e está apto a resolver a maioria das enfermidades,
            além de gerenciar o cuidado do paciente escolhendo de forma dinâmica o especialista adequado
            através de nosso sistema ágil e simples para melhor atender o cliente.</p>
          <h5>Valores</h5>
          <p>A Clínica GMV coloca à disposição dos clientes, de forma rapida sem perder em quesito de
            qualidade de atendimento junto da nossa equipe de médicos capacitados. Além disso, a Rede
            disponibiliza toda a estrutura necessária para que o diagnóstico seja feito da maneira mais
            rápida e eficaz possível. </p>
          <h5>Nossos Profissionais</h5>
          <p>Na GMV, cada paciente é tratado de maneira única, de forma humanizada, com eficiência técnica e
            respeito proporcionados por uma equipe completa e altamente treinada, preparada para promover a
            melhor linha de cuidados.</p>
          <h4>Contato:</h4>
          <ul id="contato">
            <li><i class="bi bi-telephone-fill"></i> (34) 9232-3232</li>
            <li><i class="bi bi-envelope-fill"></i> clinicagmv@mail.com</li>
          </ul>
        </div>

      </div>
    </section>
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