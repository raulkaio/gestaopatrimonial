<?php 
session_start();
require 'controle/controle.php';?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Sistema patrimonial</title>
    <link href="css/bootstrap.css" rel="stylesheet" type="text/css" />
    <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
	<link href="css/bootstrap-responsive.min.css" rel="stylesheet">
	<link href="css/style.css" rel="stylesheet">
    <script type="text/javascript" src="js/validacao.js"></script>
    <script type="text/javascript" src="js/funcoes.js"></script>
</head>

<body>
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
      </button>
      <a class="navbar-brand" href="#">Gestão Patrimonial</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				  <p class="navbar-text navbar-right">Logado como  <?php echo $_SESSION['usuario']['usuario']?>  /  <a class="btn btn-primary btn-xs" href="controle/logout.php">Logout</a></p>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>

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
			$mensagem = "Ordenando por ID";
			}
		else{
			$coluna = $_GET['coluna'];
			if($coluna=="item_pk"){$mensagem = "Ordenando por ID";}
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
			elseif($_GET['ordem']=="asc"){$mensagem .= " em ordem ascendente";}
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
		
				 
		
	$query1 = mysql_query("select * from item, disponibilidade, categoria, localizacao where disponibilidade_fk=disponibilidade_pk and categoria_fk = categoria_pk and localizacao_pk = localizacao_fk and (nome like '%".$pesquisa."%' or descricao like '%".$pesquisa."%' or localidade like '%".$pesquisa."%' or item_pk = '".$pesquisa."' or nf = '".$pesquisa."' or data_compra like '%".$pesquisa_data."%') and visibilidade = 1 order by ".$coluna." ".$ordem1);
	
	$total_resultados = mysql_num_rows($query1);
	
	$qtd_paginas = ceil($total_resultados/$quantidade);

	$query = mysql_query("select * from item, disponibilidade, categoria, localizacao where disponibilidade_fk=disponibilidade_pk and categoria_fk = categoria_pk and localizacao_pk = localizacao_fk and (nome like '%".$pesquisa."%' or descricao like '%".$pesquisa."%' or localidade like '%".$pesquisa."%' or item_pk = '".$pesquisa."' or nf like '%".$pesquisa."%' or data_compra like '%".$pesquisa_data."%' or numero_serie like '%".$pesquisa."%') and visibilidade = 1 order by ".$coluna." ".$ordem1." limit ".$inicio.",".$quantidade);
	
	echo '<div class="row-fluid">';
		echo "<div class='span6'>
			<form class='form-horizontal'>
				<div class='row-fluid' style='margin-top: 10px'>
					<div class='form-group row-fluid' style='margin-top: 10px; width: 100px;'>
					<div class='input-group'>
					  <div class='input-group-addon'>Mostrando</div>
					  <input class='span2 form-control' type='text' name='quantidade' id='quantidade' value=".$quantidade." maxlength='3' style='width: 40px' onKeyUp='formato_int(this)' maxlenght='3' >
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
		
		echo '<div class="span6">
                    <span>Legenda de disponibilidade:</span><br />
                    <span>Disponíveis: <span class="badge badge-success">&nbsp;</span></span>&nbsp;&nbsp;&nbsp;
                    <span>Instalado: <span class="badge badge-warning">&nbsp;</span></span>&nbsp;&nbsp;&nbsp;
                    <span>Em uso: <span class="badge badge-important">&nbsp;</span></span>&nbsp;&nbsp;&nbsp;
                    <span>Indefinido: <span class="badge badge-info">&nbsp;</span></span>&nbsp;&nbsp;&nbsp;
                    <span>Manutenção: <span class="badge badge-stand">&nbsp;</span></span><br /><br />
                 </div>
                 </div>';
				 
	if(mysql_num_rows($query) > 0) {

		echo "<b>". $mensagem ."</b>, exibindo ".$total_resultados." resultados.";
		
		echo "<table class='table table-condensed table-bordered table-hover' style='font-size: 13px;'>
			  <thead>
				  <tr>
					  <th><a href='inicio.php?coluna=item_pk&ordem=".$ordem2."&inicio=0&fim=".$fim."&pesquisa=".$pesquisa."&quantidade=".$quantidade."'>#</a></th>
					  <th><a href='inicio.php?coluna=nome&ordem=".$ordem2."&inicio=0&fim=".$fim."&pesquisa=".$pesquisa."&quantidade=".$quantidade."'>Nome</a></th>
					  <th><a href='inicio.php?coluna=localidade&ordem=".$ordem2."&inicio=0&fim=".$fim."&pesquisa=".$pesquisa."&quantidade=".$quantidade."'>Localidade</a></th>
					  <th><a href='inicio.php?coluna=estado&ordem=".$ordem2."&inicio=0&fim=".$fim."&pesquisa=".$pesquisa."&quantidade=".$quantidade."'>Disponibilidade</a></th>
					  <th><a href='inicio.php?coluna=nf&ordem=".$ordem2."&inicio=0&fim=".$fim."&pesquisa=".$pesquisa."&quantidade=".$quantidade."'>Nota Fiscal</a></th>
					  <th><a href='inicio.php?coluna=data_compra&ordem=".$ordem2."&inicio=0&fim=".$fim."&pesquisa=".$pesquisa."&quantidade=".$quantidade."'>Data da compra</a></th>
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
				if($disponibilidade_pk == 1){$disponibilidade = "info";}
				if($disponibilidade_pk == 2){$disponibilidade = "";}
				if($disponibilidade_pk == 3){$disponibilidade = "error";}
				if($disponibilidade_pk == 4){$disponibilidade = "success";}
				if($disponibilidade_pk == 5){$disponibilidade = "warning";}
					echo "<tr class='".$disponibilidade."'>
							<td>".$item_pk."</td>
							<td>".$nome."</td>
							<td>".$localidade."</td>
							<td>".$estado."</td>
							<td>".$nf."</td>
							<td>".$data_compra."</td>
							<td style='width: 90px'>
								<div class='btn-group btn-group-xs' role='group' aria-label='...'>
								  <a class='btn btn-default' href='#item".$item_pk."'><span class='glyphicon glyphicon-zoom-in' aria-hidden='true'></span></a>
								  <a class='btn btn-default' href='edita.php?item_pk=".$item_pk."'><span class='glyphicon glyphicon-wrench' aria-hidden='true'></span></a>
								  <a class='btn btn-default' onclick=\"confirmaExclusao($item_pk, '$nome')\"><span class='glyphicon glyphicon-erase' aria-hidden='true'></span></a>
								</div>
							</td>
						   </tr>";
						   
			 $array_itens[] = "<div id='item".$item_pk."' class='modal hide fade' style='display: none; '>
			 
								<div class='modal-header'>  
								<a class='close' data-dismiss='modal'>×</a>
								<h3>#".$item_pk." - ".$nome."</h3>  
								</div>
									<div>
										<a class='btn btn-small text-center' href='edita_item.php?item_pk=".$item_pk."'>Editar</a>
									</div>
								
									<div class='well'>
									  <h4>Identificação</h4>
									  <div class='row-fluid'>
												<b>Número de série:</b> ".$numero_serie."
									  </div>
									  <div class='row-fluid'>
												<b>Fornecedor:</b> ".$fornecedor."
									  </div>
									  <div class='row-fluid'>
												<b>NF:</b> ".$nf."
									  </div>
									</div>

									<div class='well'>
									  <h4>Localização</h4>
									  <div class='row-fluid'>
												<b>Responsável:</b> ".$responsavel."
									  </div>
									  <div class='row-fluid'>
												<b>Lugar:</b> ".$lugar."
									  </div>
									  <div class='row-fluid'>
												<b>Localidade:</b> ".$localidade."
									  </div>
									  <div class='row-fluid'>
												<b>Descrição:</b>  ".$descricao."
									  </div>
									</div>
									
								  
								  <div class='well'>
									  <h4>Dados do item</h4>
									  <div class='row-fluid'>
												<b>Data de compra:</b> ".$data_compra."
									  </div>
									  <div class='row-fluid'>
												<b>Valor:</b> ".$valor."
									  </div>
									  <div class='row-fluid'>
												<b>Categoria:</b> ".$categoria."
									  </div>
									  <div class='row-fluid'>
												<b>Disponibilidade:</b>  ".$estado."
									  </div>
									</div>
									

								</div>";
		}
		echo "</tbody></table>";
		
		echo "<div class='btn-group btn-group-xs' role='group' aria-label='...'>
				  <ul>";
		for ($i=0; $i<$qtd_paginas; $i++) { 
			$class="";
			if(($i+1) == $pagina){$class="active";}
			echo "<li class='btn btn-default ".$class."'><a href='inicio.php?coluna=".$coluna."&ordem=".$ordem1."&pesquisa=".$pesquisa."&inicio=".($i*$quantidade)."&quantidade=".$quantidade."&pagina=".($i+1)."'>".($i+1)."</a></li>";
		};
		echo "</ul>
				</div>";
		
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
<div id="insere_item" class="modal hide fade in" style="display: none; ">  
	<div class="modal-header">  
	<a class="close" data-dismiss="modal">×</a>  
	<h3>Insira os dados do item</h3>  
	</div>
    <?php include 'novo.php' ?>
</div>  

<?php include 'footer.php';?>