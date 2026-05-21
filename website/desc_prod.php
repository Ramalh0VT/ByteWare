<!DOCTYPE HTML>
<html lang="pt-br">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Descrição de produto</title>
</head>
<body>
	<main>
		<?php
		
	require_once 'crud.php';
	if (isset($_GET['p_editar'])){
		$id = $_GET['p_editar'];
	}
	else{
		header('Location: estoque.php?erro=erro_linkinvalido');
		die();
	}
	$produto = read($pdo, 'produtos', 'id_produto ='.$id.'');

	if(isset($produto['descricao'])){
		$desc = $produto['descricao'];
	}
	else{
		$desc = 'Este produto não possuí descrição.';
	}
		$main = '<div>
				<h1>Descrição de '.$produto['nome_produto'].'</h1>
				<p>'.$desc.'</p>
				<a href="form_update.php">Editar produto</a>	
			</div>';
		echo $main;
		?>
	</main>
</body>
