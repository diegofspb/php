<?php

echo '<pre>';

// file_get_contents() é usada para ler o conteúdo de um arquivo e retorná-lo como uma string, se o arquivo estiver no mesmo diretório do arquivo php não precisa colocar o path

$dadosJson = file_get_contents('db.json');

$dadosJsonDecodificados = json_decode($dadosJson);

//A função json_decode() em PHP é usada para decodificar uma string JSON e convertê-la em uma estrutura de dados PHP, ou seja em um objeto

// print_r($dadosJsonDecodificados);

// a variável $dadosJsonDecodificados já está com todo o json tranformado em objeto, agora basta apontar ele para a chave principal que neste caso é 'livros'
// e tudo que estiver dentro desta chave 'livros' será transformado em um objeto individual

foreach($dadosJsonDecodificados->livros as $livro){
    // print_r($livro);
    // echo $livro->titulo . PHP_EOL;
}