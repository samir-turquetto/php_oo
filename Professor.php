<?php
class Professor extends Pessoa
{
  public string $especialidade;
  public float $salario;

  public function verProfessor(): object
  {
    $conn = new Connection();
    $conectar = $conn->connect();

    $sql = "SELECT nome, telefone, email, especialidade, salario, data_nascimento
    FROM professor as pr
    LEFT JOIN pessoa as pe ON (pr.pessoa_id = pe.id)
    WHERE email = :email";

    $result = $conectar->prepare($sql);
    $result->execute(array(':email' => $this->email));

    return $result->fetchObject();
  }

  public function calculaAvaliacao()
  {
    $qtdDisciplinas = 100;
    $qtdAnos = 12;
    $resultado = $qtdDisciplinas * $qtdAnos;
    return $resultado;
  }

  public function criarProfessor(array $professor): bool
  {
    $conn = new Connection();
    $conectar = $conn->connect();

    $sql = "INSERT INTO pessoa (nome, telefone, email, data_nascimento)
            VALUES (:nome, :telefone, :email, :data_nascimento)";

    $result = $conectar->prepare($sql);
    $result->execute(array(
      ':nome' => $professor['nome'],
      ':telefone' => $professor['telefone'],
      ':email' => $professor['email'],
      ':data_nascimento' => $professor['data_nascimento']
    ));

    $idCriado = $conectar->lastInsertId();

    if ($idCriado) {
      $sql = "INSERT INTO professor (pessoa_id, especialidade, salario) VALUES (?, ?, ?)";
      $result = $conectar->prepare($sql);
      $result->execute(array($idCriado, $professor['especialidade'], $professor['salario']));
      if ($result->rowCount()) {
        return true;
      } else {
        return false;
      }
    } else {
      return false;
    }
  }

  public function editarProfessor(array $professor): bool
  {
    $conexao = new Connection();
    $conectar = $conexao->connect();

    $resultStatus = $sql = "UPDATE pessoa
            SET nome=:nome, email=:email, telefone=:telefone, data_nascimento=:data_nascimento
            WHERE id=:id";
    $result = $conectar->prepare($sql);
    $result->execute(array(
      ':nome' => $professor['nome'],
      ':email' => $professor['email'],
      ':telefone' => $professor['telefone'],
      ':data_nascimento' => $professor['data_nascimento'],
      ':id' => $professor['id']

    ));
    if ($resultStatus) {
      $sql = "UPDATE professor 
              SET especialidade=:especialidade, salario=:salario
              WHERE pessoa_id=:id";
      $result = $conectar->prepare($sql);
      $resultStatus = $result->execute(array(
        ':especialidade' => $professor['especialidade'],
        ':salario' => $professor['salario'],
        ':id' => $professor['id']
      ));
      if ($resultStatus) {
        return true;
      } else {
        return false;
      }
    } else {
      return false;
    }
  }
}