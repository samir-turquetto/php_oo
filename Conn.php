<?php
class Connection
{
  public $username = 'root';
  public $password = 'root';
  public $dsn = 'mysql:dbname=php_oo; host=localhost';
  public $connect = null;

  public function connect()
  {
    try {
      $this->connect = new PDO(
        $this->dsn,
        $this->username,
        $this->password,
        array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'")
      );

      return $this->connect;
      
    } catch (\Throwable $th) {
      throw $th;
    }
  }

  public function listarProfessores(): array
  {
    $sql = "SELECT nome, telefone, email, especialidade, salario, data_nascimento
    FROM professor as pr
    LEFT JOIN pessoa as pe ON (pr.pessoa_id = pe.id)";
    $conectar = $this->connect();
    $result = $conectar->prepare($sql);
    $result->execute();
    return $result->fetchAll();
  }

  public function listarEstudantes(): array
  {
    $sql = "SELECT nome, telefone, email, matricula, ira, data_nascimento
    FROM estudante as es
    LEFT JOIN pessoa as pe ON (es.pessoa_id = pe.id)";
    $conectar = $this->connect();
    $result = $conectar->prepare($sql);
    $result->execute();
    return $result->fetchAll();
  }
}