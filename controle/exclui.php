<?php

session_start();
include('conexao.php');
$item_pk = $_GET['item_pk'];

$query = mysql_query("update item set visibilidade=0 where item_pk=$item_pk");


    if (!$query) {
        header("location: ../inicio.php?item_pk=$item_pk&msg=Erro na exclusão do item.&class=alert alert-error&type=Erro!");
    }
    
    else{
        header("location: ../inicio.php?item_pk=$item_pk&msg=Item excluído!&class=alert alert-success&type=");
    }
?>
