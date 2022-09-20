<?php

function limparDados(string $dado) :string
{
    $tags = '<p><strong><i><ul><ol><li><h1><h2><h3>';

    $retorno = htmlentities(strip_tags($dado, $tags)); //htmlenties converte todos os caracteres aplicáveis ​​em entidades HTML
                                                       // strip_tags tira tags HTML e PHP de uma string

    return $retorno;
}

?>