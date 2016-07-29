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
</head>

<body>
<div class="container-fluid">
      <div class="row-fluid">
        <div class="span12">
          <div class="navbar">
            <div class="navbar-inner">
              <div class="container-fluid">
                
                
                <a href="index.php" class="brand">Sistema de Notas</a>
                <div class="nav-collapse collapse navbar-responsive-collapse">
                  <ul class="nav pull-right">
                    <li class="dropdown"><a><i class="icon-user"></i> <?php echo $_SESSION['usuario']['usuario']?></a></li>
                    <li class="divider-vertical"></li>
                    <li><a href="index.php">Sistema de notas</a></li>
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

<?php
	include 'controle/conexao.php';
	$nota_pk = $_GET['nota_pk'];
	$query = mysql_query("select * from notas where nota_pk = ".$nota_pk);
    if (mysql_num_rows($query) > 0) {
        while($dados = mysql_fetch_array($query)){
                $destino_local = utf8_encode($dados['destino_local']);
                $destino_cep = utf8_encode($dados['destino_cep']);
                
                $data = explode("-", $dados['data_envio']);
                $data1 = array_reverse($data);
                $data_envio = implode("/", $data1);
                
				$transportadora = utf8_encode($dados['transportadora']);                
                $rastreador = utf8_encode($dados['rastreador']);                
				$peso_real = utf8_encode($dados['peso_real']);                
				$valor = str_replace(".", ",", $dados['valor']);
				$itens = utf8_encode($dados['itens']);                
				
				
            }
    }
    
    else{
        header("location: inicio.php?msg=Nenhum item encontrado com o ID informado.&class=alert alert-error&type=Erro!");
    }
?>
    <div class="container">
    <h1>Edição de nota</h1>
      <form class="form-horizontal" action="controle/edita.php">
        <div class="well">
          <h5>Identificação</h5>
          <div class="row-fluid" >
              <div class="span6">
                  <div class="span2"><label for="destino_local">Destino: </label></div> 
                  <div class="span8"> <input type="text" class="input-block-level" name="destino_local" id="destino_local" value="<?php echo $destino_local?>" > </div>
              </div>
              <div class="span6">
			      <div class="span2"><label for="numero_serie">Cep: </label></div> 
                  <div class="span8"> <input type="text" class="input-block-level" name="destino_cep" id="destino_cep" value="<?php echo $destino_cep?>"> </div>
              </div>
          </div>
          <div class="row-fluid">
              <div class="span6">
                    <div class="span2"><label for="data_envio">Data de envio: </label></div> 
                  <div class="span8"> <input type="text" class="input-block-level" name="data_envio" id="data_envio" maxlength="10" value="<?php echo $data_envio?>" onkeyUp="formato_data(this)"> </div>
           </div>		   
              <div class="span6">
			      <div class="span2"><label for="transportadora">Transportadora: </label></div> 
                  <div class="span8"> <input type="text" class="input-block-level" name="transportadora" id="transportadora" value="<?php echo $transportadora?>"> </div>
              </div>
			</div> 
			<div class="row-fluid">
				<div class="span6">
			      <div class="span2"><label for="rastreador">Rastreador: </label></div> 
                  <div class="span8"> <input type="text" class="input-block-level" name="rastreador" id="rastreador" value="<?php echo $rastreador?>"> </div>
              </div>
			 
			  <div class="span6">
			      <div class="span2"><label for="peso_real">Peso real: </label></div> 
                  <div class="span8"> <input type="text" class="input-block-level" name="peso_real" id="peso_real" value="<?php echo $peso_real?>"> </div>
              </div>
			</div>
			<div class="row-fluid">
			  <div class="span6">
			      <div class="span2"><label for="valor">Valor: </label></div> 
                  <div class="span6"> <input type="text" class="input-block-level" name="valor" id="valor" value="<?php echo $valor?>"> </div>
              </div>
			  <div class="span6">
			      <div class="span2"><label for="itens">Itens: </label></div> 
                  <div class="span6"> <input type="text" class="input-block-level" name="itens" id="itens" value="<?php echo $itens?>"> </div>
              </div>
			 </div>
          </div>
        </div>
        
        
        <input type="hidden" name="nota_pk" value="<?php echo $nota_pk ?>" />
        
        <div class="row-fluid">
        <center>
            <button class="btn btn-primary" type="submit">Salvar</button>
  		    <button class="btn" type="reset">Limpar</button>
        </center>
        </div>
        
      </form>
    </div>
<?php include 'footer.php' ?>