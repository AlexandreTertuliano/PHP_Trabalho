<?php

  require_once('conexao.php');

  $nome = '';
  $documentos = '';
  $dt = '';
  $cidade = '';
  $estado = '';
  $idCliente = '';

  if (isset($_GET['idCliente']) && $_GET['idCliente'] != "") {
    $sql = "select * from clientes where idCliente = " . $_GET['idCliente'];
    $resultado = mysqli_query($conexao, $sql);
    if ($resultado) {
      $dados = mysqli_fetch_array($resultado);
      $nome = $dados['nome'];
      $documentos = $dados['documentos'];
      $dt = $dados['dt'];
      $cidade = $dados['cidade'];
      $estado = $dados['estado'];
      $idCliente = $dados['idCliente'];
    }
  }

  ?>





<!DOCTYPE html>
<html>
  <head>
    <title>CLIENTES</title>
    <link href="style.css" rel="stylesheet">
  </head>
  <body>
  <?php include_once("index.php"); ?>
    <div class="testbox">
      <form class="formulario" method="post" action="table_clientes.php">
        <h1>Cadastro de Clientes</h1>
        <h5>Dados Pessoais</h5>
        <input type="hidden" name="idCliente" id='idCliente' value="<?php echo $idCliente; ?>">

        <div class="item">
          <p>Nome :</p>
          <div class="name-item">
            <input type="text" id="nome" placeholder="Nome" value="<?php echo $nome; ?>" required/>
          </div>
        </div>
        <div class="item">
          <p>Documento(CPF OU RG)</p>
          <input type="text" id="documentos" name="documentos" value="<?php echo $documentos; ?>"required/>
        </div>
        <div class="item">
          <p>Endereço</p>

          <div class="city-item">
            <input type="text" id="cidade" name="cidade" placeholder="Cidade" value="<?php echo $cidade; ?>" required/>
            <input type="text" id="estado" name="estado" placeholder="Estado" value="<?php echo $estado; ?>" required/>
          </div>
        </div>
        <div class="item">
          <p>Data de nascimento</p>
          <input type="date" id="dt" name="dt" value="<?php echo $dt; ?>"/>
        </div>
        
        </div>
        <div class="btn-block">
          <button type="submit" name="clientes">SALVAR</button>
        </div>
      </form>
    </div>
  </body>
</html>