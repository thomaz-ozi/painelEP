<?PHP 
// Função para transformar strings em Maiúscula ou Minúscula com acentos
// $palavra = a string propriamente dita
// $tp = tipo da conversão: 1 para maiúsculas e 0 para minúsculas
function convertem($term, $tp) {
    if ($tp == "1") $palavra = strtr(strtoupper($term),"àáâãäåæçèéêëìíîïðñòóôõö÷øùüúþÿ","ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÜÚÞß");
    elseif ($tp == "0") $palavra = strtr(strtolower($term),"ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÜÚÞß","àáâãäåæçèéêëìíîïðñòóôõö÷øùüúþÿ");
    return $palavra;
}
?>
<?php 
//CONVERTEM PARA MAIUSCOLA
// echo $nome_produto= convertem($_GET['pesquisar'], 1); ?>
<?php 
//CONVERTEM PARA MINUSCOLA
// echo $nome_produto= convertem($_GET['pesquisar'], 0); ?>