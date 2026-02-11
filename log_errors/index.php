  
    /*
    Para criar um log, abriremos ,o arquivo em modo 'a' (escritura ao 
    final) e escreveremos o erro indicando a data, para simplificar o 
    trabalho podemos incluir tudo em uma função: 
    */
     <?php
    function error($numero,$texto){ 
    $ddf = fopen('error.txt','a'); 
    fwrite($ddf,"[".date("r")."] Error $numero: $textorn"); 
    fclose($ddf); 
    } 
    ?> 
    /*
    Uma vez declarada a função, teremos somente que chamá-la da 
    seguinte forma quando se produzir um erro para que se salve em 
    error.log: 
    */
    <?php 
    // Se nao existe a cookie sessao 
    if(!isset($_COOKIE['sessao'])){ 
    // Salvamos um erro 
    error('001','Nao existe a cookie de sessao'); 
    } 
    ?> 
    /*
    Desta maneira, cada vez que um usuário entra nesta página sem a 
    cookie sessao, armazena-se uma nova linha no arquivo, indicando: 
     
    [data] Erro 001: Nao existe a cookie de sessao 
     
    Vamos ver agora como podemos melhorar isto de forma que além de poder gravar os erros que nós definirmos em nosso site, que armazene também os erros produzidos durante a execução do script php. 
     
    Conseguiremos isto indicando ao intérprete Zend que chame à 
    função error() cada vez que o código PHP contenha um erro com a 
    função set_error_handler: 
    */
    <?php 
    set_error_handler('error'); 
    ?> 
     
    //Então, o código completo fica da seguinte forma: 
     
    <?php 
    function error($numero,$texto){ 
    $ddf = fopen('error.txt','a'); 
    fwrite($ddf,"[".date("r")."] Error $numero:$textorn"); 
    fclose($ddf); 
    } 
    set_error_handler('error'); 
    ?> 