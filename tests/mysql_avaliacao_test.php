<?php
    require_once '../includes/funcoes.php';
    require_once '../core/conexao_mysql.php';
    require_once '../core/sql.php';
    require_once '../core/mysql.php';

    insert_teste('10', 'Muito bem, Ronaldo!', '1', '1');
    buscar_teste();
    update_teste(2, 'VAGABUNDO');
    buscar_teste();
    delete_teste(1);

     //Teste inserção banco de dados
     function insert_teste($nota, $comentario, $usuario_id, $post_id): void
     {
         $dados = ['nota' => $nota, 'comentario' => $comentario, 'usuario_id' => $usuario_id, 'post_id' => $post_id]; 
         insere('avaliacao', $dados);
     }

     function delete_teste($id): void
     {
        $criterio = [['id', '=', $id]];
        deleta('avaliacao', $criterio);
     }

    //Teste select banco de dados
    function buscar_teste(): void
    {
        $avaliacao = buscar('avaliacao', [ 'id','nota','comentario'], [], '');
        print_r($avaliacao);
    }

    function update_teste($id, $comentario): void{

        $dados = ['comentario' => $comentario];
        $criterio = [['id', '=', $id]];
        atualiza ('avaliacao', $dados, $criterio);
    }
?>