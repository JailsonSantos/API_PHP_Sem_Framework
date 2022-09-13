<?php

class Urls
{
  public function listarTodos()
  {
    $db = DB::connect();
    $response = $db->prepare("SELECT * from urls ORDER BY url_short");
    $response->execute();
    $object = $response->fetchAll(PDO::FETCH_ASSOC);

    if ($object) {
      echo json_encode(["Dados" => $object]);
    } else {
      echo json_encode(["Dados" => "Nenhum dado encontrado!"]);
    }
  }
  public function listarUnico($param)
  {
    $db = DB::connect();
    $response = $db->prepare("SELECT * from urls WHERE id={$param}");
    $response->execute();
    $object = $response->fetchObject();

    if ($object) {
      echo json_encode(["Dados" => $object]);
    } else {
      echo json_encode(["Dados" => "Nenhum dado encontrado!"]);
    }
  }
  public function adicionar()
  {
    $sql = "INSERT INTO urls (";

    $contador = 1;
    foreach (array_keys($_POST) as $indice) {
      if (count($_POST) > $contador) {
        $sql .= "{$indice},";
      } else {
        $sql .= "{$indice}";
      }
      $contador++;
    }

    $sql .= ") VALUES (";

    $contador = 1;
    foreach (array_values($_POST) as $valor) {
      if (count($_POST) > $contador) {
        $sql .= "'{$valor}',";
      } else {
        $sql .= "'{$valor}'";
      }
      $contador++;
    }

    $sql .= ")";

    $db = DB::connect();
    $response = $db->prepare($sql);
    $result = $response->execute();

    if ($result) {
      echo json_encode(["Dados" => "Dados inseridos com Sucesso!"]);
    } else {
      echo json_encode(["Dados" => "Erro ao inserir os dados!"]);
    }
  }

  public function atualizar($param)
  {
    array_shift($_POST);

    $sql = "UPDATE urls SET ";

    $contador = 1;
    foreach (array_keys($_POST) as $indice) {
      if (count($_POST) > $contador) {
        $sql .= "{$indice} = '{$_POST[$indice]}', ";
      } else {
        $sql .= "{$indice} = '{$_POST[$indice]}' ";
      }
      $contador++;
    }

    $sql .= "WHERE id={$param}";

    $db = DB::connect();
    $response = $db->prepare($sql);
    $result = $response->execute();

    if ($result) {
      echo json_encode(["Dados" => "Dados atualizados com sucesso!"]);
    } else {
      echo json_encode(["Dados" => "Erro ao atualizar os dados!"]);
    }
  }

  public function deletar($param)
  {
    $db = DB::connect();
    $response = $db->prepare("DELETE FROM urls WHERE id={$param}");
    $result = $response->execute();

    if ($result) {
      echo json_encode(["Dados" => "URL excluida com sucesso!"]);
    } else {
      echo json_encode(["Dados" => "Erro ao excluir a url!"]);
    }
  }
}
