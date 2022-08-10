<?php
    require_once '../includes/funcoes.php';
    require_once '../core/conexao_mysql.php';
    require_once '../core/sql.php';
    require_once '../core/mysql.php';

    insert_teste('Ronaldo', 'O ronaldo é o ronaldo', '1');
    buscar_teste();
    update_teste(2, 'Ele não é não');
    buscar_teste();

    //Teste inserção banco de dados
    function insert_teste($titulo, $texto, $usuario_id): void
    {
        $dados = ['titulo' => $titulo, 'texto' => $texto, 'usuario_id' => $usuario_id]; 
        insere('post', $dados);
    }

    //Teste select banco de dados
    function buscar_teste(): void
    {
        $post = buscar('post', [ 'id','titulo','texto'], [], '');
        print_r($post);
    }
    //Teste update banco de dados

    function update_teste($id, $texto): void{

        $dados = ['texto' => $texto];
        $criterio = [['id', '=', $id]];
        atualiza ('post', $dados, $criterio);
    }
?>