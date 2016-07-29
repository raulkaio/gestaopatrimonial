<?php

session_start();
include('conexao.php');
$numero_serie = utf8_decode($_GET['numero_serie']);
$localidade = utf8_decode($_GET['localidade']);
$responsavel = utf8_decode($_GET['responsavel']);

$data = explode("/", $_GET['data_compra']);
$data1 = array_reverse($data);
$data_compra = implode("-", $data1);

$valor = str_replace(",", ".", $_GET['valor']);

$fornecedor = utf8_decode($_GET['fornecedor']);
$categoria = utf8_decode((int)$_GET['categoria']);
$nf = $_GET['nf'];
$usuario_fk = (int)$_SESSION['usuario']['pk'];
$localizacao_fk = (int)$_GET['lugar'];
$disponibilidade_fk = (int)$_GET['disponibilidade'];
$descricao = utf8_decode($_GET['descricao']);
$nome = utf8_decode($_GET['nome']);

$query = mysql_query("INSERT INTO item (nome, descricao, nf, localizacao_fk, disponibilidade_fk, usuario_fk, numero_serie, localidade,
    responsavel, data_compra, valor, fornecedor, categoria_fk, visibilidade) values ('$nome', '$descricao', '$nf', $localizacao_fk, $disponibilidade_fk, $usuario_fk, '$numero_serie', '$localidade', '$responsavel', '$data_compra', $valor, '$fornecedor', $categoria, 1)");


    if (!$query) {
        header("location: ../inicio.php?item_pk=$item_pk&msg=Erro na inserção dos dados.&class=alert alert-error&type=Erro!");
    }
    
    else{
        header("location: ../inicio.php?item_pk=$item_pk&msg=Item inserido com sucesso!&class=alert alert-success&type=Tudo certo.");
    }
?>
