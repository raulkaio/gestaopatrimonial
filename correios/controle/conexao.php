<?php
	$conexao=mysql_connect("localhost","root","");

        if(!$conexao){
                echo "Erro ao se conectar ao BD.";
                exit;
                }

        $banco=mysql_select_db("sgcorreios");

        if(!$banco){
        echo "O Banco de dados não foi encontrado";
        exit;
        }
		
?>
