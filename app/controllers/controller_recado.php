<?php
  $caminho = '/var/www/livroVisitas/app/';
  require_once $caminho . 'models/recado.php';
  require_once $caminho . 'models/usuario.php';
  require_once $caminho . 'models/database.php';

  // funcao que recupera todos os recados cadastrados no banco de dados
  function recuperarRecados(){
    $db = new Database;
    $db->conectar();
    $db->selecionarDB();
    $db->set('sql', "SELECT user_id, mensagem, nome FROM Recado INNER JOIN Usuario ON Recado.user_id = Usuario.id ORDER BY publicado DESC");
    $result = $db->query();
    for($i = 0; $i < mysql_num_rows($result); $i++){
      mysql_data_seek($result, $i);
      $row[$i] = mysql_fetch_assoc($result);
    }
    return $row;
  }

  // funcao que insere o recado no banco de dados
  function insereRecado($recado){
    $db = new Database;
    $db->conectar();
    $db->selecionarDB();
    $user = $recado->get('usuario');
    $user_id = $user->get('id');
    $mensagem = $recado->get('mensagem');
    $db->set('sql', "INSERT INTO `livroVisitas`.`Recado`(`user_id`, `mensagem`) VALUES(
               '$user_id', '$mensagem')");
    $result = $db->query();
    return $result;
  }
?>
