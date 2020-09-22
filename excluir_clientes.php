<?php

	require_once('conexao.php');
	
	$idCliente = $_GET['idCliente'];
	
	if($idCliente != ""){
		
		$sql = "delete from clientes where idCliente = ".$idCliente;
		$resultado = mysqli_query($conexao, $sql);
		if($resultado){
			$msg = "Dados excluidos com sucesso!";
		}
		echo "<script>window.location.href='table_clientes.php?msg=$msg';</script>";
		
	}
	
?>