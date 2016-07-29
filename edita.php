<?php 
session_start();
require 'controle/controle.php';
include 'header.php';
;?>

<?php
	include 'controle/conexao.php';
	$item_pk = $_GET['item_pk'];
	$query = mysql_query("select * from item where item_pk = ".$item_pk);
    if (mysql_num_rows($query) > 0) {
        while($dados = mysql_fetch_array($query)){
                $numero_serie = utf8_encode($dados['numero_serie']);
                $localidade = utf8_encode($dados['localidade']);
                $responsavel = utf8_encode($dados['responsavel']);
                
                $data = explode("-", $dados['data_compra']);
                $data1 = array_reverse($data);
                $data_compra = implode("/", $data1);
                
                $valor = str_replace(".", ",", $dados['valor']);
                $fornecedor = utf8_encode($dados['fornecedor']);
                $categoria_fk = (int)$dados['categoria_fk'];
                $nf = $dados['nf'];
                $usuario_fk = (int)$_SESSION['usuario']['pk'];
                $localizacao_fk = (int)$dados['localizacao_fk'];
                $disponibilidade_fk = (int)$dados['disponibilidade_fk'];
                $descricao = utf8_encode($dados['descricao']);
                $nome = utf8_encode($dados['nome']);
            }
    }
    
    else{
        header("location: inicio.php?msg=Nenhum item encontrado com o ID informado.&class=alert alert-error&type=Erro!");
    }
?>
    <div class="container">
		<h1>Edição de item</h1>
      <form class="form-horizontal" action="controle/edita.php">
        <div class="well">
          <h5>Identificação</h5>
          <div class="row">
			  <div class="col-md-6">
			      <label class="col-sm-2 control-label" for="item_pk">Patrimônio: </label> 
                  <div class="col-sm-10"> <input type="number" class="form-control" name="item_pk" id="item_pk" value="<?php echo $item_pk?>" disabled> </div>
              </div>
              <div class="col-md-6">
                  <label class="col-sm-2 control-label" for="disponibilidade">Status: </label> 
                  <div class="col-sm-10"><?php
                                            echo "<select class='form-control'
											id='disponibilidade' name='disponibilidade' title='disponibilidade'>";
                                            include 'controle/conexao.php';
                                            $query = mysql_query("select * from disponibilidade");
                                            if (mysql_num_rows($query) > 0) {
                                                $i=1;
                                                $selected="";
                                                while($dados = mysql_fetch_array($query)){
                                                    if($i==$disponibilidade_fk){$selected="selected";}
                                                    else{$selected="";}
                                                    echo "<option value='".$dados['disponibilidade_pk']."' $selected>".utf8_encode($dados['estado'])."</option>";
                                                    $i++;
                                                }
                                            }
                                        echo "</select>";
                                    ?></div>
              </div>
			</div>
			<div class="row">
			  <div class="col-md-6">
                  <label class="col-sm-2 control-label" for="nome">Descrição: </label>
                  <div class="col-sm-10"><input type="text" class="form-control" name="nome" id="nome" value="<?php echo $nome?>"> </div>
              </div>
			  <div class="col-md-6">
                  <label class="col-sm-2 control-label" for="categoria">Tipo: </label>
                  <div class="col-sm-10"><?php 
                                        echo "<select class='form-control' id='categoria' name='categoria' title='categoria' >";
                                            include 'controle/conexao.php';
                                            $query = mysql_query("select * from categoria");
                                            if (mysql_num_rows($query) > 0) {
                                                $i=1;
                                                $selected="";
                                                while($dados = mysql_fetch_array($query)){
                                                    if($i==$categoria_fk){$selected="selected";}
                                                    else{$selected="";}
                                                    echo "<option value='".$dados['categoria_pk']."' $selected>".utf8_encode($dados['categoria'])."</option>";
                                                     $i++;
                                                }
                                            }
                                        echo "</select>";
                                    ?>  </div>
              </div>
			</div>
			<div class="row">
				<div class="col-md-7">
					<label class="col-sm-3 control-label" for="responsavel">Responsável: </label>
					<div class="col-sm-9"><input type="text" class="form-control" name="responsavel" id="responsavel" value="<?php echo $responsavel?>" > </div>
				</div>
				<div class="col-md-5	">
               	  <label class="col-sm-4 control-label" for="lugar">Departamento: </label>
                  <div class="col-sm-8"><?php 
                                        echo "<select class='form-control'  id='lugar' name='lugar' title='lugar' style='width: 100%' >";
                                            include 'controle/conexao.php';
                                            $query = mysql_query("select * from localizacao");
                                            if (mysql_num_rows($query) > 0) {
                                                $i=1;
                                                $selected="";
                                                while($dados = mysql_fetch_array($query)){
                                                    if($i==$localizacao_fk){$selected="selected";}
                                                    else{$selected="";}
                                                    echo "<option value='".$dados['localizacao_pk']."' $selected >".utf8_encode($dados['lugar'])."</option>";
                                                    $i++;
                                                }
                                            }
                                        echo "</select>";
                                    ?></div>
                </div>
			</div>
		</div>
        
        <input type="hidden" name="item_pk" value="<?php echo $item_pk ?>" />
        
        <div class="row-fluid">
        <center>
            <button class="btn btn-primary" type="submit">Salvar</button>
  		    <button class="btn" type="reset">Limpar</button>
        </center>
        </div>
		
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
        
      </form>
    </div>
<?php include 'footer.php' ?>