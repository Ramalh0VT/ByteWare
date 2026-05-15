<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Controle de estoque</title>
    <link rel="stylesheet" href=".css/estoque.css">
</head>
<body>
            <section class="box-tabela">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nome</th>
                            <th>PN</th>
                            <th>Estoque</th>
                            <th>Status</th>
                            <th>Ativo</th>
                            <th>Categoria</th>
                            <th>Custo</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        require_once 'crud.php';
                        $produtos = readAll($pdo, 'produtos');
                        $conteudo_tabela = null;
                        foreach($produtos as $produto){
                            if ($produto['estoque'] <= 50 && $produto['estoque'] > 10){
                                $status = 'Estoque baixo';
                            }
                            elseif ($produto['estoque'] <= 10){
                                $status = 'Estoque baíxissimo';
                            }
                            elseif($produto['estoque'] <= 0){
                                $dados_atualizados = [
                                'ativo' => 'Inativo',
                                'estoque' => 0
                                ];
                                $status_db = update($pdo, 'produtos', $dados_atualizados, "id=".$produto['id_produto']."");
                            }
                            $conteudo_tabela .= "<tr><td>".$produto['id_produto']."</td><td>".$produto['nome_produto']."</td<td>".$produto['pn']."</td><td>".$produto['estoque']."</td><td>".$status."</td><td>".$produto['ativo']."</td><td>".$produto['categoria']."</td><td>".$produto['custo']."</td>";
                        } 
                        echo $conteudo_tabela;
                    ?>
                    </tbody>
                </table>
            </section>
    </body>
</html>
