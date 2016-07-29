<?php 
session_start();
require 'controle/controle.php';?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Sistema de notas</title>
    <link href="css/bootstrap.css" rel="stylesheet" type="text/css" />
    <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
	<link href="css/bootstrap-responsive.min.css" rel="stylesheet">
	<link href="css/style.css" rel="stylesheet">
    <script type="text/javascript" src="js/validacao.js"></script>
    <script type="text/javascript" src="js/funcoes.js"></script>
</head>

<body>
<div class="container-fluid">
      <div class="row-fluid">
        <div class="span12">
          <div class="navbar">
            <div class="navbar-inner">
              <div class="container-fluid">
                
                
                <a href="index.php" class="brand">Sistema de notas</a>
                <div class="nav-collapse collapse navbar-responsive-collapse">
                  <ul class="nav pull-right">
                    <li class="dropdown"><a><i class="icon-user"></i> <?php echo $_SESSION['usuario']['usuario']?></a></li>
                    <li class="divider-vertical"></li>
                    <li><a href="../inicio.php">Voltar ao Sistema Patrimonial</a></li>
                    <li class="divider-vertical"></li>
                    <li><a href="controle/logout.php">Logout</a></li>
                  </ul>
                </div>
                <a class="btn btn-primary" href="nova.php">Cadastrar nova nota</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
      <div class="container">
	<h1>Itens cadastrados</h1>
					<?php
	include('/controle/conexao.php');
		if(isset($_GET['msg'])){
			$cor = 'FFFFFF';
			if(isset($_GET['cor'])){
				$cor = $_GET['cor'];
			}
			echo '<span style="border-radius: 5px;background-color: #'.$cor.'; padding: 5px;">'.$_GET['msg'].'</span>';
		}
	
	
		if(empty($_GET['pagina'])){$pagina = "1";}
		else{$pagina = $_GET['pagina'];}
	
		if(empty($_GET['quantidade'])){$quantidade = "15";}
		else{$quantidade = anti_injection($_GET['quantidade']);}
	
		if(empty($_GET['inicio'])){$inicio = "0";}
		else{$inicio = $_GET['inicio'];}
		
		$fim = $inicio + $quantidade;
	
		if(empty($_GET['coluna'])){
			$coluna = "nota_pk";
			$mensagem = "Ordenando por ID";
			}
		else{
			$coluna = $_GET['coluna'];
			if($coluna=="nota_pk"){$mensagem = "Ordenando por ID";}
			if($coluna=="destino_local"){$mensagem = "Ordenando por destino";}
			if($coluna=="destino_cep"){$mensagem = "Ordenando por cep";}
			if($coluna=="data_envio"){$mensagem = "Ordenando por data";}
			if($coluna=="transportadora"){$mensagem = "Ordenando por transportadora";}
			if($coluna=="rastreador"){$mensagem = "Ordenando por número do rastreador";}
			if($coluna=="peso"){$mensagem = "Ordenando por peso";}
			if($coluna=="valor"){$mensagem = "Ordenando por valor";}
			elseif($coluna=="itens"){$mensagem = "Ordenando por itens";}
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
						$pesquisa_data = $pesquisa;}
		}
				 
		
	$query1 = mysql_query("select * from notas where nota_pk = '".$pesquisa."' or destino_local like '%".$pesquisa."%' or destino_cep = '".$pesquisa."' or data_envio like '%".$pesquisa_data."%' or transportadora like '%".$pesquisa."%' or rastreador like '%".$pesquisa."%' or peso_real like '%".$pesquisa."%' or valor like '%".$pesquisa."%' or itens like '%".$pesquisa."%' order by ".$coluna." ".$ordem1);

	
	$total_resultados = mysql_num_rows($query1);
	
	$qtd_paginas = ceil($total_resultados/$quantidade);

	$query = mysql_query("select * from notas where nota_pk = '".$pesquisa."' or destino_local like '%".$pesquisa."%' or destino_cep = '".$pesquisa."' or data_envio like '%".$pesquisa_data."%' or transportadora like '%".$pesquisa."%' or rastreador like '%".$pesquisa."%' or peso_real like '%".$pesquisa."%' or valor like '%".$pesquisa."%' or itens like '%".$pesquisa."%' order by ".$coluna." ".$ordem1." limit ".$inicio.",".$quantidade);
	
	echo '<div class="row-fluid">';
		echo "<div class='span6'>
			<form class='form-horizontal'>
				<div class='row-fluid' style='margin-top: 10px'>
					<div class='input-prepend input-append'>
					  <span class='add-on' >Mostrando </span>
					  <input class='span2' type='text' name='quantidade' id='quantidade' value=".$quantidade." maxlength='3' style='width: 40px' onKeyUp='formato_int(this)' maxlenght='3' >
					  <span class='add-on' > resultados</span>
					</div>
				</div>
				<div class='row-fluid' style='margin-top: 10px'>
					<div class='input-prepend input-append'>
					  <span class='add-on' >Contendo: </span>
					  <input class='span2' type='text' name='pesquisa' id='pesquisa' value='".$pesquisa."' style='width: 250px' onKeyUp='formato_letras_numeros(this)' >
					  <button class='btn' type='submit' >Pesquisar</button>
					</div>
				</div>
				<input type='hidden' name='coluna' value='".$coluna."'/>
				<input type='hidden' name='ordem' value='".$ordem1."'/>
			  </form>
			  </div>";
			  
		echo '<div class="span6">

                 </div>
                 </div>';
				 
	if(mysql_num_rows($query) > 0) {

		echo "<b>". $mensagem ."</b>, exibindo ".$total_resultados." resultados.";
		
		echo "<table class='table table-condensed table-bordered table-hover' style='font-size: 13px;'>
			  <thead>
				  <tr>
					  <th><a href='index.php?coluna=nota_pk&ordem=".$ordem2."&inicio=0&fim=".$fim."&pesquisa=".$pesquisa."&quantidade=".$quantidade."'>#</a></th>
					  <th><a href='index.php?coluna=destino_local&ordem=".$ordem2."&inicio=0&fim=".$fim."&pesquisa=".$pesquisa."&quantidade=".$quantidade."'>Destino</a></th>
					  <th><a href='index.php?coluna=destino_cep&ordem=".$ordem2."&inicio=0&fim=".$fim."&pesquisa=".$pesquisa."&quantidade=".$quantidade."'>CEP</a></th>
					  <th><a href='index.php?coluna=data_envio&ordem=".$ordem2."&inicio=0&fim=".$fim."&pesquisa=".$pesquisa."&quantidade=".$quantidade."'>Data de envio</a></th>
					  <th><a href='index.php?coluna=transportadora&ordem=".$ordem2."&inicio=0&fim=".$fim."&pesquisa=".$pesquisa."&quantidade=".$quantidade."'>Transportadora</a></th>
					  <th><a href='index.php?coluna=rastreador&ordem=".$ordem2."&inicio=0&fim=".$fim."&pesquisa=".$pesquisa."&quantidade=".$quantidade."'>Rastreador</a></th>
					  <th><a href='index.php?coluna=peso_real&ordem=".$ordem2."&inicio=0&fim=".$fim."&pesquisa=".$pesquisa."&quantidade=".$quantidade."'>Peso real</a></th>
					  <th><a href='index.php?coluna=valor&ordem=".$ordem2."&inicio=0&fim=".$fim."&pesquisa=".$pesquisa."&quantidade=".$quantidade."'>Valor</a></th>
					  <th><a href='index.php?coluna=itens&ordem=".$ordem2."&inicio=0&fim=".$fim."&pesquisa=".$pesquisa."&quantidade=".$quantidade."'>Itens</a></th>
				  </tr>
			  </thead>
			  <tbody>";
			  
		$array_itens = array();				
		while($dados = mysql_fetch_array($query)){
			$nota_pk = $dados['nota_pk'];
			$destino_local = utf8_encode($dados['destino_local']);
			$destino_cep = $dados['destino_cep'];
				if(empty($destino_cep) || $destino_cep == "-"){$destino_cep = "não possui";}
			$data_envio = $dados['data_envio'];
				if(empty($data_envio) || $data_envio == "0000-00-00" || $data_envio == "?"){$data_envio = "não possui";}
                else{$data_envio = date("d/m/Y", strtotime($dados['data_envio']));}
			$transportadora = utf8_encode($dados['transportadora']);
			$rastreador = utf8_encode($dados['rastreador']);
			$peso_real = utf8_encode($dados['peso_real']);
			$valor = utf8_encode($dados['valor']);
				if(empty($valor) || $valor == "-" || $valor == "?"){$valor = "não possui";}
			$itens = $dados['itens'];
					echo "<tr>
							<td>".$nota_pk."</td>
							<td>".$destino_local."</td>
							<td>".$destino_cep."</td>
							<td>".$data_envio."</td>
							<td>".$transportadora."</td>
							<td>".$rastreador."</td>
							<td>".$peso_real."</td>
							<td>".$valor."</td>
							<td>".$itens."</td>
							<td style='width: 50px'>
								<div class='btn-group'>
								  <a class='btn btn-small' data-toggle='modal' href='#item".$nota_pk."'><i class='icon-search'></i></a>
								  <a class='btn btn-small' href='edita.php?nota_pk=".$nota_pk."'><i class='icon-wrench'></i></a>
								  <a class='btn btn-small' onclick=\"confirmaExclusao($nota_pk, '$destino_local')\" ><i class='icon-trash'></i></a>
								</div>
							</td>
						   </tr>";
		}
		echo "</tbody></table>";
		
		echo "<div class='pagination pagination-centered'>
				  <ul>";
		for ($i=0; $i<$qtd_paginas; $i++) { 
			$class="";
			if(($i+1) == $pagina){$class="active";}
			echo "<li class='".$class."'><a href='index.php?coluna=".$coluna."&ordem=".$ordem1."&pesquisa=".$pesquisa."&inicio=".($i*$quantidade)."&quantidade=".$quantidade."&pagina=".($i+1)."'>".($i+1)."</a></li>";
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