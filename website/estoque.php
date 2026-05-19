<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Controle de estoque</title>
    <link rel="stylesheet" href="./css/estoque.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"/>
</head>
<body>

<div class="container">
 <div class="produtos-box">
    <h4>Total</h4>

 </div>

 
 <div class="produtosbaixos-box">
     <h4>Perto do mínimo</h4>
 </div>


 
<div class="produtosabaixo-box">
     <h4>Abaixo do Mínimo</h4>
 </div>


 
 <div class="valor-box">
     <h4>Valor total</h4>
 </div>
 
 
</div>

            <section class="box-tabela">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nome</th>
                            <th>PN</th>
                            <th>Estoque</th>
                            <th>Status</th>
                            <th>Categoria</th>
                            <th>Custo</th>   <th>Ajustes</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        require_once 'crud.php';
                        $produtos = readAll($pdo, 'produtos');
                        $conteudo_tabela = null;
                        foreach($produtos as $produto){
                            if ($produto['estoque'] > 50 ){
                                $status = '';
                            }
                            elseif ($produto['estoque'] <= 50 && $produto['estoque'] > 10){
                                $status = 'estoque_baixo';
                            }
                            elseif ($produto['estoque'] <= 10){
                                $status = 'estoque_mtbaixo';
                            }
                            elseif($produto['estoque'] <= 0){
                                $dados_atualizados = [
                                'ativo' => FALSE,
                                'estoque' => 0
                                ];
                                $status_db = update($pdo, 'produtos', $dados_atualizados, "id=".$produto['id_produto']."");
                                $status = 'estoque_zerado';
                            }
                            $atividade = null;
                            if ($produto['ativo'] == TRUE){
                                $atividade = 'Ativo';                            
                                }
                            else{
                                $atividade = 'Inativo';
                            }
                            $conteudo_tabela .= '<tr class='.$status.'><td>'.$produto['id_produto'].'</td><td>'.$produto['nome_produto'].'</td><td>'.$produto['pn'].'</td><td>'.$produto['estoque'].'</td><td>'.$atividade.'</td><td>'.$produto['categoria'].'</td><td>'.$produto['custo'].'</td><td><a href=descricaoPro.php><i class="bi bi-eye"></i></a></td>';
                        } 
                        echo $conteudo_tabela;
                    ?>
                    </tbody>
                </table>
            </section>
    </body>
</html>
