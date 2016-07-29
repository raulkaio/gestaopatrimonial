<?php

session_start();
include('../../controle/conexao.php');
$destino_local = utf8_decode($_GET['destino_local']);
$destino_cep = utf8_decode($_GET['destino_cep']);

$data = explode("/", $_GET['data_envio']);
$data1 = array_reverse($data);
$data_envio = implode("-", $data1);

$transportadora = utf8_decode($_GET['transportadora']);
$rastreador = utf8_decode($_GET['rastreador']);

$peso_real = str_replace(",", ".", $_GET['peso_real']);
$valor = str_replace(",", ".", $_GET['valor']);

$string_itens = utf8_decode($_GET['itens']);
$itens = explode(",", $string_itens);

$ok = true;
for($i=0 ; $i<sizeof($itens) ; $i++){
	$query = mysql_query("Select * from item where item_pk=".$itens[$i]);
	if(mysql_num_rows($query) == 0){break; $ok = false;}
}

if($ok == false){
		header("location: ../nova.php?destino_local=".$destino_local."&destino_cep=".$destino_cep."&data_envio=".$_GET['data_envio']."&transportadora=".$transportadora."&rastreador=".$rastreador."&peso_real=".$peso_real."&valor=".$valor."&itens=".$_GET['itens']."&titulo=Erro!&mensagem=Não existe um item com o ID ".$itens[$i].".&class=alert");
}

elseif($ok==true){	
		include('conexao.php');
		$query = mysql_query("INSERT INTO notas (destino_local, destino_cep, data_envio, transportadora, rastreador, peso_real, valor, itens) values ('$destino_local', '$destino_cep', '$data_envio', '$transportadora', '$rastreador', '$peso_real', '$valor', '".$_GET['itens']."')");	
		header("location: ../nova.php?titulo=Dados validados!&mensagem=Nota inserida com sucesso.&class=success");
}

?>
