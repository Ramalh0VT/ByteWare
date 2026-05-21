re_once 'crud.php';
	if (isset($_GET['p_editar'])){
		$id = $_GET['p_editar'];
	}
	else{
		header('Location: estoque.php?erro=erro_linkinvalido');
		die();
	}
$produto = read($pdo, 'produtos', 'id_produto ='.$id.'');
?>
<!DOCTYPE HTML>
<html lang="pt-br">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0"
	<title>Edição de produto</title>
</head>
<body>
	<main>
		<?php
		$main = '<div>
				<h1>Descrição de '.$produto['nome_produto'].'</h1>
				<p>'.$produto['descricao'].'</p>

				
			
			</div>';
		echo $main;
		?>
	</main>
</body>

