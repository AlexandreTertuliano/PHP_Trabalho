<?php

require_once('conexao.php');

if (isset($_POST['nome']) && $_POST['nome'] != "") {

	$idCliente = $_POST['idCliente'];
	$nome = $_POST['nome'];
	$documentos = $_POST['documentos'];
	$dt = $_POST['dt'];
	$cidade = $_POST['cidade'];
	$estado = $_POST['estado'];

	if ($idCliente == "") {
		$sql = "insert into clientes (nome, documentos, dt, cidade, estado)
				values ('$nome', '$documentos', '$dt', '$cidade', '$estado')
			";
	} else {
		$sql = "update clientes set nome = '$nome', documentos = '$documentos', dt = '$dt', cidade = '$cidade', estado = '$estado' 
					where idCliente = " . $idCliente;
	}

	$resultado = mysqli_query($conexao, $sql);

	if ($resultado && $idCliente == "") {
		$_GET['msg'] = 'Dados adicionados com sucesso';
		$_POST = null;
	} elseif ($resultado && $idCliente != "") {
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
			<td><label for="nome">Nome do Cliente:</label></td>
			<td><label for="documentos">Documento:</label></td>
			<td><label for="dt">Data de Nascimento:</label></td>
			<td><label for="cidade">Cidade:</label></td>
			<td><label for="estado">Estado:</label></td>
			<td><label for="acoes">Ações</label></td>
		</tr>


		<?php
		$sql = "select idCliente, nome, documentos, dt, cidade, estado from clientes ";
		$resultado = mysqli_query($conexao, $sql);

		while ($dados = mysqli_fetch_array($resultado)) {
			echo '<tr><td>' . $dados['nome'] . '</td>
				  		<td>' . $dados['documentos'] . '</td>
				  		<td>' . $dados['dt'] . '</td>        
         				<td>' . $dados['cidade'] . '</td>
          				<td>' . $dados['estado'] . '</td>
				  <td>
					<a href="excluir_clientes.php?id='.$dados['idCliente'] . '">Excluir</a>
					<a href="clientes.php?id='.$dados['idCliente'] . '">Alterar</a>
				  </td></tr>';
		}

		mysqli_close($conexao);

		?>

	</table>
</body>

</html>