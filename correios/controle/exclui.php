<?php

session_start();
include('conexao.php');
$nota_pk = $_GET['nota_pk'];


$query = mysql_query("delete from notas where nota_pk=$nota_pk");


    if (!$query) {
        header("location: ../index.php?nota_pk=$nota_pk&msg=Erro na exclusão do item.&cor=CC6868");
    }
    
    else{
        header("location: ../index.php?nota_pk=$nota_pk&msg=Item excluído!&cor=b4df5b");
    }
?>
