<?php

session_start();
include('conexao.php');
$item_pk = $_GET['item_pk'];

$query = mysql_query("update item set visibilidade=0 where item_pk=$item_pk");


    if (!$query) {
        header("location: ../inicio.php?item_pk=$item_pk&titulo=Ops! Houve algum problema...&mensagem=Ocorreu algum erro na exclusão do item.&class=alert alert-danger");
    }
    
    else{
        header("location: ../inicio.php?item_pk=$item_pk&titulo=Tudo certo.&mensagem=Item excluído do banco de dados.&class=alert alert-success");
    }
?>
