<?php
require_once 'crud.php';
$titulo = 'Editar de produtos';
$css = './css/form_edit.css';
// require_once './partials/sidebar.php';
//
// if(isset($_GET['id'])){
//     $id = $_GET['id'];
//     }
//     else{
//         header('Location: estoque.php?erro=errolink_invalido');
//             die();
//             }
//             $produto = read($pdo, 'produtos', 'id_produto='.$id.'');
//
//
//             ?>
//             <body>
//                 <div class="centralizar">
//                         <form action="update.php?id=<?=$id?>'" method="post" class="form-cadastro" enctype="multipart/form-data">
//                             
//                                         <h1 class="titulo-centralizado">Edição</h1>
//
//                                                     <label class="label_form">Nome</label>
//                                                                 <input type="text" value="<?php echo $produto['nome_produto'];?>" name="nome">
//
//                                                                             <label class="label_form">PN:</label>
//                                                                                         <input type="text" value="<?php echo $produto['pn'];?>" name="pn">
//
//                                                                                                     <label class="label_form">Estoque:</label>
//                                                                                                                 <input type="number" value=" <?php echo $produto['estoque'];?>" name="estoque">
//
//                                                                                                                             <label class="label_form">Categoria:</label>
//                                                                                                                                         <input type="text" value=" <?php echo $produto['categoria'];?>" name="categoria">
//
//                                                                                                                                                     <label class="label_form">Preço:</label>
//                                                                                                                                                                 <input type="text" value=" <?php echo $produto['preco']; ?>" name="preco">
//
//                                                                                                                                                                             <label class="label_form">Descrição:</label>
//                                                                                                                                                                                         <input type="text" value=" <?php echo $produto['descricao'];?>" name="descricao">
//
//                                                                                                                                                                                                     <label class="label_form">Ficha Técnica:</label>
//                                                                                                                                                                                                                 <input type="text" value=" <?php echo $produto[''];?>" name="ficha_tecnica">
//                                                                                                                                                                                                                             
//                                                                                                                                                                                                                                         <label class="label_form">Imagem:</label>
//                                                                                                                                                                                                                                                     <input type="file" value=" <?php echo $produto['imagem'];?>" name="imagem">
//
//                                                                                                                                                                                                                                                                 <button type="submit" class="botao_form"><a >Editar</button>
//                                                                                                                                                                                                                                                                     </div>
//
//
//
//                                                                                                                                                                                                                                                                         </form>
//                                                                                                                                                                                                                                                                             
//                                                                                                                                                                                                                                                                             </body>
//                                                                                                                                                                                                                                                                             </html>
