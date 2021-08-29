<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sistema de Gestão Acadêmica - Samir Turquetto Melo</title>
</head>

<body>
  <?php
  require './Pessoa.php';
  require './Estudante.php';
  require './Professor.php';
  $conexao = new Connection();
  ?>

  <h2>Estudante</h2>
  <?php

  $estudantes = $conexao->listarEstudantes();
  foreach ($estudantes as $key => $value) {
    echo $value['nome'] . " - <a href='editarEstudante.php?email={$value['email']}'>Editar</a><br>";
  }

  ?>
  <br>
  <a href="cadastroEstudante.php"><button type="button">Novo Estudante</button></a>

  <br>
  <hr>
  <h2>Professor</h2>
  <?php  

  $professores = $conexao->listarProfessores();

  foreach ($professores as $key => $value) {
    echo $value['nome'] . " <br>";
  }
  ?>

  <br>
  <a href="cadastroProfessor.php"><button type="button">Novo Professor</button></a>

</body>

</html>