<?php

require_once('conexao.php');

if (isset($_POST['num']) && $_POST['num'] != "") {

	$id = $_POST['id'];
	$num = $_POST['num'];
	$tipo = $_POST['tipo'];
	$valor = $_POST['valor'];
	$status = $_POST['status'];

	if ($id == "") {
		$sql = "insert into quartos (num, tipo, valor, status)
				values ('$num', '$tipo', '$valor', '$status')
			";
	} else {
		$sql = "update quartos set num = '$num', tipo = '$tipo', valor = '$valor', status = '$status'
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
			<td><label for="num">Numero do Quarto:</label></td>
			<td><label for="tipo">Tipo do Quarto:</label></td>
			<td><label for="valor">Valor da Diária:</label></td>
			<td><label for="status">Status:</label></td>
			<td><label for="acoes">Ações</label></td>
		</tr>


		<?php
		$sql = "select id, num, tipo, valor, status from quartos ";
		$resultado = mysqli_query($conexao, $sql);

		while ($dados = mysqli_fetch_array($resultado)) {
			echo '<tr><td>' . $dados['num'] . '</td>
				  <td>' . $dados['tipo'] . '</td>
				  <td>' . $dados['valor'] . '</td>        
				  <td>' . $dados['status'] . '</td>
				  <td>
					<a href="excluir.php?id=' . $dados['id'] . '">Excluir</a>
					<a href="quartos.php?id=' . $dados['id'] . '">Alterar</a>
				  </td></tr>';
		}

		mysqli_close($conexao);

		?>

	</table>
</body>

</html>