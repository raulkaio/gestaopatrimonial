﻿<?php
session_start();
require 'controle/controle.php';
include 'header.php';
;?>


      <div class="container">
	<h1>Itens cadastrados</h1>
					<?php
	include('/controle/conexao.php');

		if(empty($_GET['pagina'])){$pagina = "1";}
		else{$pagina = $_GET['pagina'];}

		if(empty($_GET['quantidade'])){$quantidade = "15";}
		else{$quantidade = anti_injection($_GET['quantidade']);}

		if(empty($_GET['inicio'])){$inicio = "0";}
		else{$inicio = $_GET['inicio'];}

		$fim = $inicio + $quantidade;

		if(empty($_GET['coluna'])){
			$coluna = "item_pk";
			$mensagem = "Ordenando pelo número do patrimônio";
			}
		else{
			$coluna = $_GET['coluna'];
			if($coluna=="item_pk"){$mensagem = "Ordenando pelo número do patrimônio";}
			if($coluna=="nome"){$mensagem = "Ordenando por nome";}
			if($coluna=="localidade"){$mensagem = "Ordenando por localidade";}
			if($coluna=="estado"){$mensagem = "Ordenando por disponibilidade";}
			if($coluna=="nf"){$mensagem = "Ordenando por número da NF";}
			elseif($coluna=="data_compra"){$mensagem = "Ordenando por data da compra";}
		}

		if(empty($_GET['ordem'])){
			$ordem1 = "desc";
			$mensagem .= " em ordem decrescente";}
		else{$ordem1 = $_GET['ordem'];
			if($_GET['ordem']=="desc"){$mensagem .= " em ordem decrescente";}
			elseif($_GET['ordem']=="asc"){$mensagem .= " em ordem crescente";}
			}

		if($ordem1 == "desc"){$ordem2 = "asc";}
		elseif($ordem1 == "asc"){$ordem2 = "desc";}

		if(empty($_GET['pesquisa'])){$pesquisa = "";
									 $pesquisa_data = "";}
		else{
			 	if ( substr_count($_GET['pesquisa'], '/') == 2 && substr_count($_GET['pesquisa'], '/') == 2 &&  strlen($_GET['pesquisa'])==10){
				 		$pesquisa_data = converteData($_GET['pesquisa'],'/','-');
						$pesquisa = anti_injection($_GET['pesquisa']);
			 		}
			 	else{	$pesquisa = anti_injection($_GET['pesquisa']);
						$pesquisa_data = "xx";}
		}



	$query1 = mysql_query("select * from item, disponibilidade, categoria, localizacao where disponibilidade_fk=disponibilidade_pk and categoria_fk = categoria_pk and localizacao_pk = localizacao_fk and (nome like '%".$pesquisa."%' or descricao like '%".$pesquisa."%' or item_pk = '".$pesquisa."' or nf = '".$pesquisa."' or data_compra like '%".$pesquisa_data."%') and visibilidade = 1 order by ".$coluna." ".$ordem1);

	$total_resultados = mysql_num_rows($query1);

	$qtd_paginas = ceil($total_resultados/$quantidade);

	$query = mysql_query("select * from item, disponibilidade, categoria, localizacao where disponibilidade_fk=disponibilidade_pk and categoria_fk = categoria_pk and localizacao_pk = localizacao_fk and (nome like '%".$pesquisa."%' or descricao like '%".$pesquisa."%' or item_pk = '".$pesquisa."' or nf like '%".$pesquisa."%' or data_compra like '%".$pesquisa_data."%' or numero_serie like '%".$pesquisa."%') and visibilidade = 1 order by ".$coluna." ".$ordem1." limit ".$inicio.",".$quantidade);

	echo '<div class="row-fluid">';
		echo "<div class='span6'>
			<form class='form-horizontal'>
				<div class='row-fluid' style='margin-top: 10px'>
					<div class='form-group row-fluid' style='margin-top: 10px; width: 100px;'>
					<div class='input-group'>
					  <div class='input-group-addon'>Mostrando</div>
					  <input class='span2 form-control' type='text' name='quantidade' id='quantidade' value=".$quantidade." maxlength='3' style='width: 50px' onKeyUp='formato_int(this)' maxlenght='3' >
					  <div class='input-group-addon'>resultados</div>
					</div>
				  </div>
				</div>
				<div class='form-group'>
				<div class='input-group'>
				  <div class='input-group-addon'>Contendo:</div>
				  <input class='form-control' type='text' name='pesquisa' id='pesquisa' value='".$pesquisa."' style='width: 250px' onKeyUp='formato_letras_numeros(this)' >
				  <button class='btn btn-primary' type='submit' >Pesquisar</button>
				</div>
				</div>
				<input type='hidden' name='coluna' value='".$coluna."'/>
				<input type='hidden' name='ordem' value='".$ordem1."'/>
			  </form>
			  </div>";

		echo '<div >
					<small>
                    <span>Legenda de disponibilidade:</span><br />
                    <span>Disponíveis: <span class="badge badge-success">&nbsp;</span></span>&nbsp;&nbsp;&nbsp;
                    <span>Instalado: <span class="badge badge-warning">&nbsp;</span></span>&nbsp;&nbsp;&nbsp;
                    <span>Em uso: <span class="badge badge-important">&nbsp;</span></span>&nbsp;&nbsp;&nbsp;
                    <span>Em manutenção: <span class="badge badge-stand">&nbsp;</span></span>&nbsp;&nbsp;&nbsp;
                    <span>Indefinido: <span class="badge badge-info">&nbsp;</span></span><br /><br />
					</small>
                 </div>
                 </div>';

	if(mysql_num_rows($query) > 0) {

		echo "<b>". $mensagem ."</b>, exibindo ".$total_resultados." resultados.";

		echo "<table class='table table-condensed table-bordered table-hover' style='font-size: 13px;'>
			  <thead>
				  <tr>
					  <th><a href='inicio.php?coluna=item_pk&ordem=".$ordem2."&inicio=0&fim=".$fim."&pesquisa=".$pesquisa."&quantidade=".$quantidade."'>Patrimônio</a></th>
					  <th><a href='inicio.php?coluna=nome&ordem=".$ordem2."&inicio=0&fim=".$fim."&pesquisa=".$pesquisa."&quantidade=".$quantidade."'>Descrição</a></th>
					  <th><a href='inicio.php?coluna=categoria&ordem=".$ordem2."&inicio=0&fim=".$fim."&pesquisa=".$pesquisa."&quantidade=".$quantidade."'>Tipo</a></th>
					  <th><a href='inicio.php?coluna=fornecedor&ordem=".$ordem2."&inicio=0&fim=".$fim."&pesquisa=".$pesquisa."&quantidade=".$quantidade."'>Colaborador</a></th>
					  <th><a href='inicio.php?coluna=localidade&ordem=".$ordem2."&inicio=0&fim=".$fim."&pesquisa=".$pesquisa."&quantidade=".$quantidade."'>Departamento</a></th>
					  <th><a href='inicio.php?coluna=estado&ordem=".$ordem2."&inicio=0&fim=".$fim."&pesquisa=".$pesquisa."&quantidade=".$quantidade."'>Status</a></th>
					  <th>Ações</th>
				  </tr>
			  </thead>
			  <tbody>";

		$array_itens = array();
		while($dados = mysql_fetch_array($query)){
			$item_pk = $dados['item_pk'];
			$nome = utf8_encode($dados['nome']);
			$numero_serie = $dados['numero_serie'];
				if(empty($numero_serie) || $numero_serie == "-"){$numero_serie = "não possui";}
			$fornecedor = $dados['fornecedor'];
				if(empty($fornecedor) || $fornecedor == "-" || $fornecedor == "?"){$fornecedor = "não possui";}
			$localidade = utf8_encode($dados['localidade']);
			$lugar = utf8_encode($dados['lugar']);
			$estado = utf8_encode($dados['estado']);
			$nf = utf8_encode($dados['nf']);
				if(empty($nf) || $nf == "-" || $nf == "?"){$nf = "não possui";}
			$responsavel = utf8_encode($dados['responsavel']);
			$data = $dados['data_compra'];
				if(empty($data) || $data == "0000-00-00" || $data == "?"){$data_compra = "não possui";}
                else{$data_compra = date("d/m/Y", strtotime($dados['data_compra']));}
			$descricao = utf8_encode($dados['descricao']);
			$valor = "R$ ".str_ireplace(".", ",", $dados['valor']);
			$categoria = utf8_encode($dados['categoria']);
			$disponibilidade = "";
			$disponibilidade_pk = $dados['disponibilidade_pk'];
				if($disponibilidade_pk == 1){$disponibilidade = "success";} 	// Disponível
				if($disponibilidade_pk == 2){$disponibilidade = "warning";} 	// Instalado
				if($disponibilidade_pk == 3){$disponibilidade = "danger";} 		// Em uso
				if($disponibilidade_pk == 4){$disponibilidade = "info";} 		// Indefinido
				if($disponibilidade_pk == 5){$disponibilidade = "active";} 	 	// Manutenção
					echo "<tr class='".$disponibilidade."'>
							<td>".$item_pk."</td>
							<td>".$nome."</td>
							<td>".$categoria."</td>
							<td>".$responsavel."</td>
							<td>".$lugar."</td>
							<td>".$estado."</td>
							<td style='width: 50px'>
								<div class='btn-group btn-group-xs' role='group' aria-label='...'>
								  <a class='btn btn-default' href='edita.php?item_pk=".$item_pk."'><span class='glyphicon glyphicon-wrench' aria-hidden='true'></span></a>
								  <a class='btn btn-default' onclick=\"confirmaExclusao($item_pk, '$nome')\"><span class='glyphicon glyphicon-erase' aria-hidden='true'></span></a>
								</div>
							</td>
						   </tr>";
		}
		echo "</tbody></table>";

		echo "<center><div class='btn-group btn-group-xs' role='group' aria-label='...'>
				  <ul>";
		for ($i=0; $i<$qtd_paginas; $i++) {
			$class="";
			if(($i+1) == $pagina){$class="active";}
			echo "<li class='btn btn-default ".$class."'><a href='inicio.php?coluna=".$coluna."&ordem=".$ordem1."&pesquisa=".$pesquisa."&inicio=".($i*$quantidade)."&quantidade=".$quantidade."&pagina=".($i+1)."'>".($i+1)."</a></li>";
		};
		echo "</ul>
		
				</div></center>";

		for($i=0; $i<sizeof($array_itens); $i++){
			echo $array_itens[$i];
		}
	}

	else{echo "<h1>Nenhum item cadastrado.</h1>";}

	function anti_injection($sql){
        $sql = preg_replace("/(from|select|insert|delete|where|drop table|show tables|#|\*|--|\\\\)/","",$sql);
        $sql = trim($sql);
        $sql = strip_tags($sql);
        $sql = addslashes($sql);
        return $sql;
        }

	function converteData($data, $se, $ss){
    	return implode($ss, array_reverse(explode($se, $data)));
	}

?>

<?php
	
	if(isset($_GET['titulo'])||isset($_GET['mensagem'])||isset($_GET['class'])){
		echo '<br><div class="container" style="width:500px">
			<div class="alert '.$_GET['class'].' alert-dismissible" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<strong>'.$_GET['titulo'].'</strong><br>
			'.$_GET['mensagem'].'
			</div>
		</div>';
	}
	?>

<?php include 'footer.php';?>