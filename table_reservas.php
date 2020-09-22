<?php

require_once('conexao.php');

if (isset($_POST['idQuarto']) && $_POST['idQuarto'] != "") {
	$idQuarto = $_POST['idQuarto'];
	$sql = " select valor from quartos where idQuarto = " . $idQuarto .  "";
	$resultado = mysqli_query($conexao, $sql);
	$dados = mysqli_fetch_array($resultado);
	$valor = $dados['valor'];
}

if (isset($_POST['idCli']) && $_POST['idCli'] != "") {
	$id = $_POST['id'];
	$idCli = $_POST['idCli'];
	$dtEntrada = $_POST['dtEntrada'];
	$dtSaida = $_POST['dtSaida'];
	$diferenca = strtotime($dtSaida) - strtotime($dtEntrada);
	$dias = floor($diferenca / (60 * 60 * 24));

	$valorReserva = $dias * $valor;
	$statusReserva = $_POST['statusReserva'];
	$datahora_status = date('Y/m/d H:i');

	if ($id == "") {
		$sql = "insert into reservas (idQuarto, idCli, dtEntrada, dtSaida, valorReserva, statusReserva, dtStatus )
				values ('$idQuarto', '$idCli', '$dtEntrada', '$dtSaida', '$valorReserva', '$statusReserva', '$dtStatus')
			";
	} else {
		$sql = "update reservas set idQuarto = '$idQuarto', idCli = '$idCli', dtEntrada = '$dtEntrada', dtSaida = '$dtSaida', valorReserva = '$valorReserva', statusReserva = '$statusReserva', dtStatus = '$dtStatus'
					where id = " . $id;
	}

	$resultado = mysqli_query($conexao, $sql);

	if ($resultado && $id == "") {
		$_GET['msg'] = 'Dados adicionados com sucesso';
		$_POST = null;
	} elseif ($resultado && $id != "") {
		$_GET['msg'] = 'Dados alterados com sucesso';
		$_POST = null;
	} elseif (!$resultado) {
		$_GET['msg'] = 'Falha ao inserir os dados';
	}
}

if (isset($_GET['msg']) && $_GET['msg'] != "") {
	echo $_GET['msg'];
}

?>


<!DOCTYPE html>
<html lang="pt-br">

<head>
	<title>Pousada</title>
	<meta charset="utf-8" />
	<link href="style.css" rel="stylesheet">
</head>

<body>
	<?php include_once("index.php"); ?>
	

	<table>
		<tr>
			<td><label for="num">Número do quarto:</label></td>
			<td><label for="nome">Nome do cliente:</label></td>
			<td><label for="dtEntrada">Data de Entrada:</label></td>
			<td><label for="dtSaida">Data de Saída:</label></td>
			<td><label for="valorReserva">Valor da Reserva:</label></td>
			<td><label for="statusReserva">Status da Reserva:</label></td>
			<td><label for="dtStatus">Data/Hora Status da Reserva:</label></td>
			<td><label for="acoes">Ações</label></td>
		</tr>

		<?php
		$sql = "select r.*, q.num, c.nome from reservas as r left join quartos as q on r.idQuarto = q.id left join clientes as c on r.idCli = c.idCliente";
		$resultado = mysqli_query($conexao, $sql);

		while ($dados = mysqli_fetch_array($resultado)) {
			echo '<tr><td>' . $dados['num'] . '</td>
				  <td>' . $dados['nome'] . '</td>
				  <td>' . $dados['dtEntrada'] . '</td>        
					<td>' . $dados['dtSaida'] . '</td>
					<td>' . $dados['valor'] . '</td>
					<td>' . $dados['statusReserva'] . '</td>
					<td>' . $dados['dtStatus'] . '</td>
				  <td>
					<a href="reservas.php?id=' . $dados['id'] . '">Alterar</a>
				  </td></tr>';
		}

		mysqli_close($conexao);

		?>

	</table>
</body>

</html>