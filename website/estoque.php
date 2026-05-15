
<!DOCTYPE html>
<html lang="en">
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
                            <th>Nome do Produto</th>
                            <th>Categoria</th>
                            <th>Estoque atual</th>
                            <th>Valor</th>
                            <th>Status</th>
                            <th>Ajustes</th>
                        </tr>
                    </thead>
                    <tbody>

                   
                        
    <tr>
        <td>Sensor Indutivo PNP</td>
        <td>Sensores</td>
        <td>25</td>
        <td>R$ 89,90</td>
        <td>Disponível</td>
    </tr>

    <tr>
        <td>CLP Siemens S7-1200</td>
        <td>CLPs</td>
        <td>7</td>
        <td>R$ 2.450,00</td>
        <td>Disponível</td>
    </tr>

    <tr>
        <td>IHM Weintek MT8071iE</td>
        <td>IHMs</td>
        <td>4</td>
        <td>R$ 1.350,00</td>
        <td>Baixo estoque</td>
    </tr>
                 

                    <?php
                          //  foreach ($_SESSION['produtos'] as $produto){
                                   // if ($categoria_get === '' || $produto['categoria'] === $categoria_get)
//                                     //   {
//                                            $total = (int)$produto['quantidade'] * (float)$produto['preco'];
//                                            print 
//                                            '
//                                                <tr>
//                                                    <td class="nome"><a href="./produto_especifico.php?id='.$produto['id'].'" class="info"><i class="bi bi-info-square"></i></a>'.$produto['produto'].'</td>
//                                                    <td class="geral">'.$produto['categoria'].'</td>
//                                                    <td class="geral">R$'.number_format((float)$produto['preco'], 2, ',', '.').'</td>
//                                                    <td class="qtda"><a href="./alterar.php?id='.$produto['id'].'" class="info"><i class="bi bi-pencil-square"></i></a>'.$produto['quantidade'].'</td>
//                                                    <td class="geral">R$345.234,45</td>
//                                                </tr>
//                                            ';
//                                        };
//                                };
                        ?>
                    </tbody>

                </table>
            </section>

    </body>
</html>
