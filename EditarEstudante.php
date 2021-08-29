<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>EditarEstudante</title>
</head>

<body>
  <h1>Editar cadastro de Estudante</h1>
  <?php
  require './Pessoa.php';
  require './Estudante.php';

  $estudante = new Estudante($_GET['email']);
  $estudanteDados = $estudante->verEstudante();

  if (isset($_POST['editarEstudante'])) {
    $formData = filter_input_array(INPUT_POST, FILTER_DEFAULT);

    $estudante = new Estudante($formData['email']);
    $estudanteDados = $estudante->editarEstudante($formData);

    if ($estudanteDados) {
      echo "Estudante editado com sucesso.<br>";
      echo "<a href='index.php'>Voltar</a>";
      exit;
    } else {
      echo "Erro ao editar estudante";
    }
  }
  ?>

  <form action="" method="post" name="EdicaoEstudante">
    <input hidden name="id" type="text" value="<?= $estudanteDados->id ?>">
    <p>
      <label>Nome</label>
      <input name="nome" type="text" placeholder="Digite o nome" value="<?= $estudanteDados->nome ?>" required>
    </p>
    <p>
      <label>Telefone</label>
      <input name="telefone" type="text" placeholder="Digite o telefone" value="<?= $estudanteDados->telefone ?>">
    </p>
    <p>
      <label>E-mail</label>
      <input name="email" type="text" placeholder="Digite o e-mail" value="<?= $estudanteDados->email ?>">
    </p>
    <p>
      <label>Data de Nascimento</label>
      <input name="data_nascimento" type="text" placeholder="Digite a data de nascimento" value="<?= $estudanteDados->data_nascimento ?>">
    </p>
    <p>
      <label>Matrícula</label>
      <input name="matricula" type="text" placeholder="Digite a matrícula" value="<?= $estudanteDados->matricula ?>">
    </p>
    <input type="submit" value="Salvar" name="editarEstudante">
  </form>
</body>

</html>