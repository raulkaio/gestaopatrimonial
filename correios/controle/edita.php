<?php

session_start();
include('conexao.php');
$nota_pk = $_GET['nota_pk'];
$destino_local = utf8_decode($_GET['destino_local']);
$destino_cep = utf8_decode($_GET['destino_cep']);
$data_envio = utf8_decode($_GET['data_envio']);
$transportadora = utf8_decode($_GET['transportadora']);                
$rastreador = utf8_decode($_GET['rastreador']);                
$peso_real = utf8_decode($_GET['peso_real']);                
$valor = utf8_decode($_GET['valor']);                
$itens = utf8_decode($_GET['itens']);

$query = mysql_query("update notas set destino_local='$destino_local', destino_cep='$destino_cep', data_envio='$data_envio', transportadora='$transportadora', rastreador='$rastreador', 
        peso_real='$peso_real', valor='$valor', itens='$itens' where nota_pk=$nota_pk");


    if (!$query) {
        header("location: ../index.php?nota_pk=$nota_pk&msg=Erro na alteração dos dados.&cor=CC6868");
    }
    
    else{
        header("location: ../index.php?nota_pk=$nota_pk&msg=Nota atualizada com sucesso!&cor=b4df5b");
    }
?>
