<?php
require "../php/conexaoMysql.php";
$pdo = mysqlConnect();

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>

  <!-- Required meta tags -->
  <meta charset="UTF-8"/>
  <meta content="width=device-width, initial-scale=1" name="viewport"/>
  <!-- Bootstrap CSS -->

  <link crossorigin="anonymous" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha3/dist/css/bootstrap.min.css"
        integrity="sha384-CuOF+2SnTUfTwSZjCXf01h7uYhfOBuxIhGKPbfEJ3+FqH/s6cIFN9bGr1HmAg4fQ" rel="stylesheet"/>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css" rel="stylesheet">

  <link href="../css/cadastro.css" rel="stylesheet"/>
  <link href="../css/defaut.css" rel="stylesheet"/>

  <title>Agendamento</title>
</head>

<body>


  <header>
    <nav class="navbar">
      <img src="../images/logo.png" alt="logo" height="70" width="70" />
      <div>
        <ul class="nav nav-pills">
          <li class="itemmenu"><a href="../index.html"><i class="bi bi-house"></i> Home</a></li>
          <li class="itemmenu"><a href="galeria.html"><i class="bi bi-image"></i> Galeria</a></li>
          <li class="itemmenu"><a href="cadastro_enderecos.html"><i class="bi bi-geo"></i> Novo
              Endereço</a></li>
          <li class="itemmenu"><a href="agendamento.php"><i class="bi bi-calendar2-event"></i>
              Agendamento</a></li>
        </ul>
      </div>
      <div class="itemmenu">
        <a href="../login.html"><i class="bi bi-person-fill"></i> Login</a>
      </div>
    </nav>
  </header>

  <main>
    <div class="container">
      <h3>Agendamento</h3>
      <form class="row g-3" id="form_input">
        <!-- Nome-->
        <div class="form-floating col-10">
          <input type="text" class="form-control" id="nome" name="nome" placeholder="Nome" required>
          <label for="nome">Nome completo: </label>
        </div>
        <!-- Sexo -->
        <div class="form-floating col-sm-2">
          <select name="sexo" class="form-select" id="sexo" aria-placeholder="Sexo" required>
            <option selected>Selecione</option>
            <option>Masculino</option>
            <option>Feminino</option>
          </select>
          <label for="sexo" class="form-label">Sexo</label>
        </div>
        <!-- Email -->
        <div class="form-floating col-sm-6">
          <input type="email" class="form-control" id="email" name="email" placeholder="email@example">
          <label for="email" class="form-label">E-mail</label>
        </div>


        <div class="form-floating col-sm-6">
          <select name="especialidade" class="form-select" id="espec" aria-placeholder="Especialidade" onchange="consultaEspecialidade(this)" required>

            <option selected>Selecione</option>
            <?php

            $sql = $pdo->prepare("SELECT DISTINCT Especialidade FROM Medico");
            $sql->execute();
            $especialidades = $sql->fetchAll();
            foreach ($especialidades as $key => $value) {
            ?>
              <option value="<?php echo $value['Especialidade']; ?>">
                <?php echo $value['Especialidade']; ?></option>
            <?php
            }
            ?>
          </select>
          <label for="espec">Especialidade</label>
        </div>

        <div class="form-floating col-sm-12">
          <select class="form-select" id="medico" name="medico"></select>
          <label for="medico">Profissional</label>
        </div>

        <!-- Select da data de agendamento -->
        <div class="form-floating col-sm-6">
          <input type="date" class="form-control" id="data" name="data_agendamento" placeholder="Data" onchange="atualiza_horario()" required>
          <label for="data"></label>
        </div>

        <div class="form-floating col-sm-6">
          <select name="inputHorario" class="form-select" id="select_horario" aria-placeholder="Horário" required>
            <option selected>Horário da consulta</option>
          </select>
          <label for="select_horario"></label>
        </div>
        <div class="col-md-12">
          <button type="submit" class="btn btn-primary" id="btncadastrar">
            Agendar
          </button>
        </div>
      </form>
    </div>
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

  <script>
    const atualiza_horario = () => {
      let xhr = new XMLHttpRequest();
      const inputData = document.querySelector("#data");
      const inputNome = document.querySelector("#medico");

      xhr.open("GET", "../php/busca_horarios.php?data=" + inputData.value + "&nome=" + inputNome.value, true);
      xhr.responseType = "json";


      xhr.onload = function() {
        document.getElementById("select_horario").innerHTML = ""; //Selecionando o select do horário.
        var array = [8, 9, 10, 11, 12, 13, 14, 15, 16, 17]; //Esse é o array auxiliar que vai ser devolvido ao usuário.
        for (i in xhr.response) { //Essa função é para remover do array auxiliar todos os horários já ocupados.

          /*A função splice serve para remover um elemento de um array, ele tem como argumento onde ta o elemento
          e quantos elementos é para ser removido. Para isso usamos o indexOf para acharmos onde está o elemento
          a ser removido dentro do array auxiliar, e por fim removemos*/
          array.splice(array.indexOf(xhr.response[i].Horario), 1);
        }
        for (i in array) { //Para cada elemento do array que sobrou, printamos no select
          let option = document.createElement("option"); //Criando o option
          option.text = array[i]; //setando o texto
          option.value = array[i]; //setando o valor
          document.getElementById("select_horario").add(option); //Inserindo no html
        }
      }
      xhr.onerror = function() {
        console.error("Erro de rede - requisição não finalizada");
      };
      xhr.send();
    }




    const consultaEspecialidade = (e) => {
      let xhr = new XMLHttpRequest();
      xhr.open("GET", "../php/agendamento_cadastro.php?especialidade_medica=" + e.value, true);
      xhr.responseType = "json";
      xhr.onload = function() {
        document.getElementById("medico").innerHTML = "";
        for (i in xhr.response) {
          let option = document.createElement("option");
          option.text = xhr.response[i].nome;
          option.value = xhr.response[i].nome;
          document.getElementById("medico").add(option);
        }
      };
      xhr.onerror = function() {
        console.error("Erro de rede - requisição não finalizada");
      };
      xhr.send();
    };

    function sendForm(form) {
      let formData = new FormData(document.querySelector("form"));
      const options = {
        method: "POST",
        body: formData,
      };

      fetch("../php/cadastro_agendamento.php", options)
        .then((response) => {
          if (!response.ok) {
            throw new Error(response.status);
          }
          return response.json();
        })
        .then((resposta) => {
          window.location.href = resposta.destination;
        })
        .catch((error) => {
          form.reset();
          console.error("Falha inesperada: " + error);
        });
      return false;
    }
    window.onload = function() {
      const form = document.querySelector("#form_input");
      form.onsubmit = function() {
        sendForm(form);
        return false;
      }
    }
  </script>
</body>

</html>