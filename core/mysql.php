<?php

    function insere(string $entidade, array $dados) : bool
    {
        $retorno = false;

        foreach ($dados as $campos => $dado) {
            $coringa[$campo] = '?';
            $tipo[] = gettype($dado) [0];
            $$campo = $dado;
        }

        $instrucao = insert($entidade, $coringa);

        $conexao = conecta();

        $stmt = mysqli_prepare($conexao, $instrucao);

        eval('mysqli_stmt_bind_param(stmt, \'' . implode('',$tipo) . '\',$' . implode(', $', array_keys($dados)) . ');');

        mysqli_stmt_execute($stmt);

        desconecta($conexao);

        return $retorno;
    }

    function atualiza(string $entidade, array $dados, array $criterio = []) : bool
    {
        $retorno = false;

        foreach ($dados as $campo => $dado){
            $coringa_dados[$campo] = '?';
            $tipo[] = gettype($dado) [0];
            $$campo = $dado;
        }

        foreach ($criterio as $expressao) {
            $dado = $expressao[count($expressao) -1];

            $tipo[] = gettype($dado)[0];
            $expressao[count($expressao) - 1] = '?';
            $coringa_criterio[] = $expressao;

            $nome_campo = (count($expressao) < 4) ? $expressao[0] : $expressao[1];

            if(isset($nome_campo)){
                $nome_campo = $nome_campo . '_' . rand();
            }

            $campo_criterio[] = $nome_campo;

            $$nome_campo = $dado;
        }

        $instrucao = update($entidade, $coringa_dados, $coringa_criterio);

        $conexao = conecta();

        $stmt = mysqli_prepare($conexao, $instrucao);

        if(isset($tipo)){
           $comando = 'mysqli_stmt_bind_param(?stmt,'; 
        }
    }
?>