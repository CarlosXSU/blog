<!DOCTYPE html>
<html>
    <head>
        <title>Página inicial | Projeto</title>
        <link rel="stylesheet" href="lib/bootstrap-4.2.1-dist/css/bootstrap.min.css">
    </head>
    <body>
    <div class="container"> <!-- Chamando o container limitador -->
        <div class="row"> <!-- "Elemento essencial no sistema de grade de bootstrap para manter a classe da coluna." -->
            <div class="col-md-12"> <!-- Tamanho que a div irá ocupar -->
                <!-- TOPO -->
                <?php 
                    include 'includes/topo.php'; //Chamando o topo da pasta includes
                ?>
            </div>
        </div>
        <div class="row" style="min-height : 500px;"> <!-- min-height define a altura mínima de um elemento. -->
            <div class="col-md-12"> <!-- Novamente define o tamanho que a div irá ocupar -->
                <!-- MENU -->
                <?php include 'includes/menu.php';?> <!-- Chamando o menu da pasta includes -->
            </div>
            <div class="col-md-12" style="padding-top: 50px;"> <!-- Definindo o o espaço entre o "conteúdo" dessa div e sua borda. -->
                <!-- CONTEÚDO -->
                <h2>Pagina Inicial</h2>  
                <?php include 'includes/busca.php'; ?> <!-- Chamando o campo de busca. -->

                <?php //Chamando funções do SQL e configurando o campo de busca
                require_once 'includes/funcoes.php';
                require_once 'core/conexao_mysql.php';
                require_once 'core/sql.php';
                require_once 'core/mysql.php';

                foreach($_GET as $indice => $dado){
                    $$indice = limparDados($dado); //Limpar dados faz parte da função funções, localizada nos includes
                }

                $data_atual = date('Y-m-d H:i:s');

                $criterio = [
                    ['data_postagem', '<=', $data_atual] //Basicamente só aparecera no site web os posts que foram enviados antes ou na data especificada 2022-09-21 00:00:00
                ];

                if(!empty($busca)) {
                    $criterio[] = [
                        'AND',
                        'titulo', //Elemento que será buscado quando clicado em buscar. usuario_id, por exemplo
                        'like',
                        "%{$busca}%"
                    ];
                }

                $posts = buscar( //função buscar do mysql.php
                    'post', //entidade
                    [
                        'titulo', //campos
                        'data_postagem',
                        'id',
                        '(select nome from usuario where usuario.id = post.usuario_id) as nome' //instrução?
                    ],
                    $criterio,
                    'data_postagem DESC'
                );
                ?>

                <div>
                    <div class="list-group"> <!-- Grupos de listas, exibi a série de posts maneirões em formato de lista com css feito -->
                        <?php
                            foreach($posts as $post) :
                                $data = date_create($post['data_postagem']);
                                $data = date_format($data, 'd/m/Y H:i:s');
                        ?>
                        <a class="list-group-item list-group-item-action" 
                            href="post_detalhe.php?post=<?php echo $post['id']?>"> <!-- linkando com o post_detalhe, para assim podermos ver o conteúdo -->
                            <strong><?php echo $post['titulo']?></strong> <!-- Basicamente o design dos posts -->
                            [<?php echo $post['nome']?>]
                            <span class="badge badge-dark"><?php echo $data ?></span> <!-- Basicamente o css para deixar a data bonitinha -->
                        </a>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12"> <!-- Chamando o rodapé da pasta includes -->
                <!-- RODAPÉ -->
                <?php 
                    include 'includes/rodape.php';
                ?>
            </div>
        </div>
    </div>
    <script src="lib/bootstrap-4.2.1-dist/js/bootstrap.min.js"></script>
    </body>
</html>