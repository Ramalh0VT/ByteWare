<?php

    $pagina = 'estoque';

    $titulo = 'Byteware';
    $css = './css/estoque.css';
    require_once 'crud.php';
    require_once 'partials/sidebar.php';  
    
    if (isset($_GET['erro'])){
        $erro = $_GET['erro'];
        if ($erro === 'erro_linkinvalido'){	
        echo '<h1 class="msg_erro">Erro: Esse link que você tentou acessar é invalido.</h1>' ;
        }
        else{
        echo '<h1 class="msg_erro"> Um erro desconhecido ocorreu</h1>';
        }	
    }	
?>

    <body>

<div class="container">
    
 <div class="card-box produtos-box">
    <i class="bi bi-boxes"></i>
    <h4>Total</h4>
 </div>

 
 <div class="card-box produtosbaixos-box">
    <i class="bi bi-exclamation-circle"></i>
     <h4>Perto do mínimo</h4>
 </div>


 
<div class="card-box produtosabaixo-box">
       <i class="bi bi-exclamation-triangle"></i>
     <h4>Abaixo do Mínimo</h4>
 </div>


 
 <div class="card-box valor-box">
    <i class="bi bi-currency-dollar"></i>
     <h4>Valor total</h4>
 </div>

  <div class="card-box produtos-inativos">
    <i class="bi bi-ban"></i>
     <h4>Inativos</h4>
 </div>
 
 
</div>


<h1>Produtos geral</h1>
            <main class="box-tabela">
                <table>
                    <thead>
                        <tr>
                            
                            <th>Produto</th>
                            <th>PN</th>
                            <th>Estoque</th>
                            <th>Status</th>
                            <th>Categoria</th>
			                <th>Custo</th>   
			                <th>Descrição</th>
                        </tr>
                    </thead>


                  <tbody>  
                    <?php
                        require_once 'crud.php';
                        $produtos = readAll($pdo, 'produtos');
                        $conteudo_tabela = null; 
                        $conteudo_tabela_zerada = null;                      
                        foreach($produtos as $produto){
                            $zerado = false;
                            if ($produto['estoque'] > 50 ){
                                $status = 'estoque_padrao';
                            }
                            elseif ($produto['estoque'] <= 50 && $produto['estoque'] > 10){
                                $status = 'estoque_baixo';
                            }
                            elseif ($produto['estoque'] <= 10 && $produto['estoque'] > 0){
                                $status = 'estoque_mtbaixo';
                            }
                            elseif($produto['estoque'] <= 0){
                                $dados_atualizados = [
                                'estoque' => 0,
                                'status' => 0
				                ];
                                $status_db = update($pdo, 'produtos', $dados_atualizados, 'id_produto='.$produto['id_produto'].''); 
                                $status = 'estoque_zerado';
                                
			                }

			              if ($produto['preco'] < 0){
				            $dados_atualizados = 
                                    [
                                    'preco' => 0
                                    ];	
                                $status_db = update($pdo, 'produtos', $dados_atualizados, 'id_produto='.$produto['id_produto'].''); 
			                }
                            $atividade = null;
                            if ($produto['status'] == TRUE){
                                $atividade = 'Ativo';                            
                                }
                            else{
                                $atividade = 'Inativo';
                            }
                            if ($zerado == false){
                                $conteudo_tabela .= '<tr class='.$status.'><td><img src="'.$produto['imagem'].'" width="80" alt="Imagem""></td><td>'.$produto['nome_produto'].'</td><td>'.$produto['pn'].'</td><td>'.$produto['estoque'].'</td><td>'.$atividade.'</td><td>'.$produto['categoria'].'</td><td>'.$produto['preco'].'</td><td><form action="descricaoPro.php" method="GET"><button value='.$produto['id_produto'].' name="p_editar"><i class="bi bi-eye"></i></button></form></td>';
                            }
                            else{
                                $conteudo_tabela_zerada .= '<tr class='.$status.'><td><img src="'.$produto['imagem'].'" width="80" alt="Imagem""></td><td>'.$produto['nome_produto'].'</td><td>'.$produto['pn'].'</td><td>'.$produto['estoque'].'</td><td>'.$atividade.'</td><td>'.$produto['categoria'].'</td><td>'.$produto['preco'].'</td><td><form action="descricaoPro.php" method="GET"><button value='.$produto['id_produto'].' name="p_editar"><i class="bi bi-eye"></i></button></form></td>'; 
                            }
                        }
                        echo $conteudo_tabela;
                ?>
                    </tbody>
                </table>
</main>


<h1>Produtos sem estoque</h1>
        <section class="box-produtos-abaixo">
           <table>
                    <thead>
                        <tr>
                            <th>Produto</th>
                            <th>PN</th>
                            <th>Estoque</th>
                            <th>Status</th>
                            <th>Categoria</th>
			                <th>Custo</th>   
			                <th>Descrição</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?=$conteudo_tabela_zerada?>
                    </tbody>
                    </table>
</section>
    </body>
</html>
