<?php

  require_once('conexao.php');

  $idQuarto = '';
  $idCli = '';
  $dtEntrada = '';
  $dtSaida = '';
  $valorReserva = '';
  $statusReserva = '';
  $dtStatus= '';
  $idReserva = '';

  if (isset($_GET['idReserva']) && $_GET['idReserva'] != "") {
    $sql = "select * from reservas where idReserva = " . $_GET['idReserva'];
    $resultado = mysqli_query($conexao, $sql);
    if ($resultado) {
      $dados = mysqli_fetch_array($resultado);
      $idQuarto = $dados['idQuarto'];
      $idCli = $dados['idCli'];
      $dtEntrada = $dados['dtEntrada'];
      $dtSaida = $dados['dtSaida'];
      $valorReserva = $dados['valorReserva'];
      $statusReserva = $dados['statusReserva'];
      $idReserva = $dados['idReserva'];
    }
  }

  ?>

<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <title>RESERVAS</title>
    <link href="style.css" rel="stylesheet">
  </head>
  <body>
  <?php include_once("index.php"); ?>
    <div class="testbox">
      <form class="formulario" method="post" action="table_reservas.php" align=left>
        <h1>Cadastro de Reservas</h1>
       
        <div class="item">
          <p>Reserva :</p>
          <input type="hidden" name="idReserva" id="idReserva" value="<?= $id; ?>">
        </div>
        <div class="item">
        <label for="idQuarto">Número do Quarto:</label>
          <select name="idQuarto" id="idQuarto">
            <?php
            $sql = "select id, num, valor, status from quartos ";
            $resultado = mysqli_query($conexao, $sql);
            while ($dados = mysqli_fetch_array($resultado)) {
              if ($dados['status'] == 'livre' || $dados['status'] == 'Livre') {
                $num = $dados['num'];
                echo "<option value=" . $dados['id'] . ">" . $num . "</option>";
            ?>

            <?php
              }
            }
            ?>
          </select>
        </div>
        <div class="item">
        <label for="idCli">Nome do Cliente:</label>
          <select name="idCli" id="idCli">
            <?php
            $sql = "select idCliente, nome from clientes ";
            $resultado = mysqli_query($conexao, $sql);
            while ($dados = mysqli_fetch_array($resultado)) {
              $nome = $dados['nome'];
              echo "<option value=" . $dados['idCliente'] . ">" . $nome . "</option>";
            }
            ?>
          </select>
        </div>
        <div class="item">
          <p>Data de Entrada :</p>
          <input type="date" name="dtEntrada" id="dtEntrada" value="<?= $dtEntrada; ?>" required/>
        </div>
        <div class="item">
          <p>Data de Saida :</p>
          <input type="date" name="dtSaida" id="dtSaida" value="<?= $dtSaida; ?>" required/>
        </div>
        <div class="item">
          <p>Valor da Reserva</p>
          <input type="text" name="valorReserva" id="valorReserva" value="<?= $valorReserva; ?>" required/>
        </div>
        <div class="item">
          <p>Status da Reserva (reservado, checkin, checkout ou cancelada)</p>
          <input type="text" name="statusReserva" id="statusReserva" value="<?= $statusReserva; ?>" required/>
        </div>
        
        </div>

        
        <div class="btn-block">
          <button type="submit" name="reservas">SALVAR</button>
        </div>
      </form>
    </div>
  </body>
</html>