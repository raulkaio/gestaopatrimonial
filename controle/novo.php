<?php

session_start();
include('conexao.php');
$item_pk = utf8_decode($_GET['item_pk']); // PATRIMÔNIO
$disponibilidade_fk = (int)$_GET['disponibilidade']; //STATUS
$nome = utf8_decode($_GET['nome']); // NOME
$categoria_fk = utf8_decode((int)$_GET['categoria']); // TIPO
$responsavel = utf8_decode($_GET['responsavel']); // RESPONSAVEL
$localizacao_fk = utf8_decode((int)$_GET['localizacao']); // DEPARTAMENTO
$usuario_fk = (int)$_SESSION['usuario']['pk'];

$query = mysql_query("select * from item where item_pk = $item_pk");


    if (mysql_num_rows($query) > 0) {
		 header("location: ../novo.php?item_pk=$item_pk&titulo=Não foi possível concluir o cadastro.&mensagem=Já existe um produto cadastrado com esse mesmo número de patrimônio.&class=alert alert-warning&type=Erro!");
	}
	else{
	$query = mysql_query("INSERT INTO item (item_pk, disponibilidade_fk, nome, categoria_fk, responsavel, localizacao_fk, usuario_fk, visibilidade) values ($item_pk, $disponibilidade_fk, '$nome', $categoria_fk, '$responsavel', $localizacao_fk, $usuario_fk, 1)");
	echo "categoria: ". $_GET['categoria'];

		if (!$query) {
			header("location: ../novo.php?item_pk=$item_pk&titulo=Não foi possível concluir o cadastro.mensagem=Ocorreu algum erro na inserção dos dados no banco.&class=alert alert-danger&type=Erro!");
		}
		
		else{
			header("location: ../novo.php?item_pk=$item_pk&titulo=Tudo certo.&mensagem=Item cadastrado com sucesso!&class=alert alert-success&type=Tudo certo.");
		}
	}
?>
