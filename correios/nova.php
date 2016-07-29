<?php 
session_start();
require 'controle/controle.php';

if(empty($_GET['destino_local']) && empty($_GET['destino_cep']) && empty($_GET['data_envio']) && empty($_GET['transportadora']) && empty($_GET['rastreador']) && empty($_GET['peso_real']) && empty($_GET['valor']) && empty($_GET['itens'])){
	$destino_local = "";
	$destino_cep = "";
	$data_envio = "";
	$transportadora = "";
	$rastreador = "";
	$peso_real = "";
	$valor = "";
	$itens = "";
}

else{
	$destino_local = utf8_decode($_GET['destino_local']);
	$destino_cep = utf8_decode($_GET['destino_cep']);
	$data_envio = $_GET['data_envio'];
	$transportadora = utf8_decode($_GET['transportadora']);
	$rastreador = utf8_decode($_GET['rastreador']);
	$peso_real = str_replace(",", ".", $_GET['peso_real']);
	$valor = str_replace(",", ".", $_GET['valor']);
	$itens = $_GET[''];
}
?>

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
                    <li><a href="../index.php">Voltar ao Sistema Patrimonial</a></li>
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
    <h1>Insira os dados da nota</h1>
      <form class="form-horizontal" action="controle/nova.php">
        <div class="well">
          <div class="row-fluid" style="margin-bottom:10px">
              <div class="span12">
                  <div class="span2"><label for="destino_local">Local destino: </label></div> 
                  <div class="span10"> <input type="text" class="input-block-level" name="destino_local" id="destino_local" value="<?php echo $destino_local ?>"> </div>
              </div>
          </div>
          <div class="row-fluid" style="margin-bottom:10px">
              <div class="span6">
			      <div class="span4"><label for="destino_cep">CEP do destino: </label></div> 
                  <div class="span8"> <input type="text" class="input-block-level" name="destino_cep" id="destino_cep" value="<?php echo $destino_cep ?>"> </div>
              </div>
              <div class="span6">
                  <div class="span3"><label for="data_envio">Data de envio: </label></div> 
                  <div class="span9"> <input type="text" class="input-block-level" name="data_envio" id="data_envio" value="<?php echo $data_envio ?>"> </div>
              </div>
          </div>
          <div class="row-fluid" style="margin-bottom:10px">
              <div class="span6">
			      <div class="span4"><label for="transportadora">Transportadora: </label></div> 
                  <div class="span8"> <input type="text" class="input-block-level" name="transportadora" id="transportadora" value="<?php echo $transportadora ?>"> </div>
              </div>
              <div class="span6">
                  <div class="span3"><label for="rastreador">Rastreador: </label></div> 
                  <div class="span9"> <input type="text" class="input-block-level" name="rastreador" id="rastreador" value="<?php echo $rastreador ?>"> </div>
              </div>
          </div>
          <div class="row-fluid" style="margin-bottom:10px">
              <div class="span6">
			      <div class="span4"><label for="peso_real">Peso real: </label></div> 
                  <div class="span8"> <input type="text" class="input-block-level" name="peso_real" id="peso_real" value="<?php echo $peso_real ?>"> </div>
              </div>
              <div class="span6">
                  <div class="span3"><label for="valor">Valor: </label></div> 
                  <div class="span9"> <input type="text" class="input-block-level" name="valor" id="valor" value="<?php echo $valor ?>"> </div>
              </div>
          </div>
          <div class="row-fluid" style="margin-bottom:10px">
         	  <div class="span12">
                  <div class="span3"><label for="itens">Quais itens foram enviados? </label></div> 
                  <div class="span9"> <input type="text" class="input-block-level" name="itens" id="itens" value="<?php echo $itens ?>"> </div>
              </div>
          </div>
        </div>
        
        
        <div class="row-fluid">
        <center>
            <button class="btn btn-primary" type="submit">Salvar</button>
  		    <button class="btn" type="reset">Limpar</button>
        </center>
        </div>
        
        <div class="row-fluid" style="margin-bottom:10px">
              <div class="span6">
              </div>
        	  <div class="span6">
				<?php
            
                if(isset($_GET['titulo'])||isset($_GET['mensagem'])||isset($_GET['class'])){
                    echo '<div class="container" style="width:340px">
                        <div class="alert '.$_GET['class'].'">
                        <h4>'.$_GET['titulo'].'</h4>
                        '.$_GET['mensagem'].'
                        </div>
                    </div>';
                }
                ?>
              </div>
              <div class="span6">
              </div>
        </div>
        
      </form>
    </div>

<?php 
include 'footer.php';
?>