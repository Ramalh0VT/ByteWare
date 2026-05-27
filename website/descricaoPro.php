<?php
$titulo = 'Descrição de produto';
$css = './css/estoque2.css';
require_once 'partials/sidebar.php';
?>
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
		$main = '<div class="box">
				<h1 class="margem_baixo">'.$produto['nome_produto'].'</h1>
				<p>'.$desc.'</p>
				
				<div class="box2">
				<form class="box3" action="form_update.php"><button name="id" value="'.$id.'">Editar produto</a>
				<button><a href="estoque.php">Voltar ao estoque</a></button>
				</form>
				</div>
					
			</div>';
		echo $main;
		?>
	</main>
</body>
