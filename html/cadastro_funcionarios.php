<?php

require_once "../php/conexaoMysql.php";
require_once "../php/autenticacao.php";

session_start();
$pdo = mysqlConnect();
exitWhenNotLogged($pdo);

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


    <title>Cadastrar Funcionario</title>
</head>


<body>
<header>
    <nav class="navbar">
        <img alt="logo" height="70" src="../images/logo.png" width="70"/>
        <div>
            <ul class="nav nav-pills">
                <li class="itemmenu"><a href="../php/home.php"><i class="bi bi-house"></i> Home</a></li>
                <li class="itemmenu"><a href="../php/galeria_session.php"><i class="bi bi-image"></i> Galeria</a></li>
                <li class="itemmenu"><a href="../php/cadastro_enderecos_session.php"><i class="bi bi-geo"></i> Novo
                    Endereço</a></li>
                <li class="itemmenu"><a href="../php/agendamento_session.php"><i class="bi bi-calendar2-event"></i>
                    Agendamento</a></li>
                <li class="itemmenu"><a href="cadastro_funcionarios.php"><i class="bi bi-person-plus-fill"></i> Novo
                    funcionario</a></li>
                <li class="itemmenu"><a href="cadastro_paciente.php"><i class="bi bi-person-heart"></i> Novo
                    paciente</a>
                </li>
                <li class="itemmenu"><a href="../php/listar_funcionarios.php"><i class="bi bi-person-badge-fill"></i>
                    Funcionarios</a></li>
                <li class="itemmenu"><a href="../php/listar_pacientes.php"><i class="bi bi-person-hearts"></i> Pacientes</a>
                </li>
                <li class="itemmenu"><a href="../php/listar_enderecos.php"><i class="bi bi-geo-alt-fill"></i> Endereços</a>
                </li>
                <li class="itemmenu"><a href="../php/listar_agendamentos.php"><i class="bi bi-calendar-event-fill"></i>
                    Agendamentos</a></li>
                <li class="itemmenu"><a href="../php/listar_agendamentos_por_medico.php"><i
                        class="bi bi-calendar-heart-fill"></i> Agendamentos Médico</a></li>
            </ul>
        </div>
        <div class="itemmenu">
            <a href="../php/logout.php"><i class="bi bi-door-closed-fill"></i> Sair</a>
        </div>
    </nav>
</header>

<main>
    <div class="container">
        <h3 id="teste">Cadastrar Funcionario</h3>
        <form class="row g-2" id="form_input">
            <div class="col-md-8">
                <div class="form-floating">
                    <input class="form-control" id="nome" name="nome" placeholder=" " type="text"/>
                    <label for="nome">Nome:</label>
                </div>
            </div>

            <div class="form-floating col-sm-4">
                <select aria-placeholder="Sexo" class="form-select" id="sexo" name="sexo" required>
                    <option selected>Selecione</option>
                    <option>Masculino</option>
                    <option>Feminino</option>
                </select>
                <label class="form-label" for="sexo">Sexo</label>
            </div>


            <div class="col-md-6">
                <div class="form-floating">
                    <input class="form-control" id="email" name="email" placeholder=" " type="text"/>
                    <label for="email">Email:</label>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-floating">
                    <input class="form-control" id="telefone" name="telefone" placeholder=" " type="text"/>
                    <label for="telefone">Telefone:</label>
                </div>
            </div>

            <div class="col-md-3">
                <div class="form-floating">
                    <input class="form-control" id="cep" name="cep" placeholder=" " type="text"/>
                    <label for="cep">CEP:</label>
                </div>
            </div>

            <div class="col-md-3">
                <div class="form-floating">
                    <input class="form-control" id="logradouro" name="logradouro" placeholder=" " type="text"/>
                    <label for="logradouro">Logradouro:</label>
                </div>
            </div>


            <div class="col-md-3">
                <div class="form-floating">
                    <input class="form-control" id="cidade" name="cidade" placeholder=" " type="text"/>
                    <label for="cidade">Cidade:</label>
                </div>
            </div>


            <div class="col-md-3">
                <div class="form-floating">
                    <input class="form-control" id="data" name="data" type="date"/>
                </div>
            </div>

            <div class="col-md-3">
                <div class="form-floating">
                    <input class="form-control" id="salario" name="salario" placeholder=" " type="text"/>
                    <label for="salario">Salario: </label>
                </div>
            </div>


            <div class="col-md-9">
                <div class="form-floating">
                    <input class="form-control" id="senha" name="senha" placeholder=" " type="password"/>
                    <label for="senha">Senha:</label>
                </div>
            </div>


            <div class="col-md-12">
                <div class="form-check">
                    <input class="form-check-input" id="check" name="check" onclick="habilitar_desabilitar()"
                           type="checkbox">
                    <label class="form-check-label" for="check">Médico ?</label>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-floating">
                    <input class="form-control" disabled id="especialidade" name="especialidade" placeholder=" "
                           type="text"/>
                    <label for="especialidade">Especialidade</label>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-floating">
                    <input class="form-control" disabled id="crm" name="crm" placeholder=" " type="text"/>
                    <label for="crm">CRM</label>
                </div>
            </div>


            <!-- <button type="submit">Cadastrar</button> -->

            <div class="col-md-12">
                <button class="btn btn-primary" id="btncadastrar" type="submit">
                    Cadastrar
                </button>
            </div>


        </form>
    </div>
</main>


<footer>
    <div class="rodape">

        <div id="imgrodape">
            <img alt="logo" height="200" src="../images/logoinv.png" width="200"/>
        </div>

        <div class="mapa">
            <iframe allowfullscreen=""
                    height="200" loading="lazy"
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1887.0900545011502!2d-48.286494991772166!3d-18.92342035954946!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x94a444f8f2f407cd%3A0x13b587c75013856b!2sR.%20Tiradentes%20-%20Fundinho%2C%20Uberl%C3%A2ndia%20-%20MG%2C%2038400-200!5e0!3m2!1spt-BR!2sbr!4v1647036787373!5m2!1spt-BR!2sbr"
                    style="border:0;" width="200"></iframe>
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
    function sendForm(form) {
        let formData = new FormData(document.querySelector("form"));
        const options = {
            method: "POST",
            body: formData,
        };

        fetch("../php/cadastro_funcionario.php", options)
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

    window.onload = function () {
        const form = document.querySelector("#form_input");
        const inputCep = document.querySelector("#cep");
        inputCep.onkeyup = () => buscaEndereco(inputCep.value);
        form.onsubmit = function () {
            sendForm(form);
            return false;
        };
    };

    function habilitar_desabilitar() {
        if (document.getElementById("check").checked) {
            document.getElementById("especialidade").disabled = false;
            document.getElementById("crm").disabled = false;
        } else {
            document.getElementById("especialidade").disabled = true;
            document.getElementById("crm").disabled = true;
        }
    }

    function buscaEndereco(cep) {
        if (cep.length != 9) return;

        let xhr = new XMLHttpRequest();
        xhr.open("GET", "../php/busca-endereco.php?cep=" + cep, true);

        xhr.onload = function () {
            // verifica o código de status retornado pelo servidor
            if (xhr.status != 200) {
                console.error("Falha inesperada: " + xhr.responseText);
                return;
            }

            // converte a string JSON para objeto JavaScript
            try {
                var endereco = JSON.parse(xhr.responseText);
            } catch (e) {
                console.error("String JSON inválida: " + xhr.responseText);
                return;
            }

            // utiliza os dados retornados para preencher formulário
            let form = document.querySelector("form");

            form.cidade.value = endereco.cidade;
            form.logradouro.value = endereco.logradouro;
            form.estado.value = endereco.estado;
        };

        xhr.onerror = function () {
            console.error("Erro de rede - requisição não finalizada");
        };

        xhr.send();
    }
</script>

<!-- Optional JavaScript -->
<script crossorigin="anonymous"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
        src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script crossorigin="anonymous"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"></script>
<script crossorigin="anonymous"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"></script>
</body>

</html>