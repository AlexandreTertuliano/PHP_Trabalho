<?php

  require_once('conexao.php');

  $num = '';
  $tipo = '';
  $valor = '';
  $status = '';
  $id = '';

  if (isset($_GET['id']) && $_GET['id'] != "") {
    $sql = "select * from quartos where id = " . $_GET['id'];
    $resultado = mysqli_query($conexao, $sql);
    if ($resultado) {
      $dados = mysqli_fetch_array($resultado);
      $num = $dados['num'];
      $tipo = $dados['tipo'];
      $valor = $dados['valor'];
      $status = $dados['status'];
      $id = $dados['id'];
    }
  }
  

  ?>

<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <title>Quartos</title>
    <link href="style.css" rel="stylesheet">
</head>
  <body>
  <?php include_once("index.php"); ?>
    <div class="testbox">
      <form class="formulario" method="post" action="table_quartos.php">
        <h1>Quartos</h1>
        <div class="item">
         <input type="hidden" name="id" id="id" value="<?php echo $id; ?> " required>
        </div>
        <div class="item">
          <p>Numero da porta :</p>
          <input type="text" id="num" name="num" value="<?php echo $num; ?>" required/>
        </div>
        <div class="item">
          <p>Tipo :</p>
          <input type="text" id="tipo" name="tipo" value="<?php echo $tipo; ?>" required/>
        </div>
        <div class="item">
          <p>Valor da Diária :</p>
          <input type="text" id="valor" name="valor" value="<?php echo $valor; ?>" required/>
        </div>
        <div class="item">
          <p>Status (livre, ocupado ou bloqueado) :</p>
          <input type="text" id="status" name="status" value="<?php echo $status; ?>" required/>
        </div>
        </div>
        <div class="btn-block">
          <button type="submit" name="quartos">SALVAR</button>
        </div>
      </form>                                                         
    </div>
  </body>
</html>