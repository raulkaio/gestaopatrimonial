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
          <div class="row-fluid" style="margin-bottom: 10px;">
              <div class="span6">
                  <div class="span1"><label for="nome">Nome: </label></div> 
                  <div class="span11"> <input type="text" class="input-block-level" name="nome" id="nome" value="<?php echo $nome?>" > </div>
              </div>
              <div class="span6">
			      <div class="span2"><label for="numero_serie">Nº de série: </label></div> 
                  <div class="span10"> <input type="text" class="input-block-level" name="numero_serie" id="numero_serie" value="<?php echo $numero_serie?>"> </div>
              </div>
          </div>
          <div class="row-fluid">
              <div class="span6">
                  <div class="span2"><label for="fornecedor">Fornecedor: </label></div> 
                  <div class="span10"> <input type="text" class="input-block-level" name="fornecedor" id="fornecedor" value="<?php echo $fornecedor?>"> </div>
              </div>
              <div class="span6">
			      <div class="span2"><label for="nf">Nº da NF: </label></div> 
                  <div class="span10"> <input type="text" class="input-block-level" name="nf" id="nf" value="<?php echo $nf?>"> </div>
              </div>
          </div>
        </div>
        
        <div class="well">
          <h5>Localização</h5>
          <div class="row-fluid">
              <div class="span4">
                  <div class="span3"><label for="responsavel">Responsável: </label></div>
                  <div class="span9"> <input type="text" class="input-block-level" name="responsavel" id="responsavel" value="<?php echo $responsavel?>" onkeyUp="formato_letras_numeros(this)"></div>
              </div>
              <div class="span4">
               	  <div class="span2"><label for="lugar">Lugar: </label></div> 
                  <div class="span10"><?php 
                                        echo "<select id='lugar' name='lugar' title='lugar' style='width: 100%' >";
                                            include 'controle/conexao.php';
                                            $query = mysql_query("select * from localizacao");
                                            if (mysql_num_rows($query) > 0) {
                                                $i=1;
                                                $selected="";
                                                while($dados = mysql_fetch_array($query)){
                                                    if($i==$localizacao_fk){$selected="selected";}
                                                    else{$selected="";}
                                                    echo "<option value='".$dados['localizacao_pk']."' $selected >".$dados['lugar']."</option>";
                                                    $i++;
                                                }
                                            }
                                        echo "</select>";
                                    ?></div>
                </div>
                
                <div class="span4">
               	  <div class="span3"><label for="localidade">Localidade: </label></div> 
                  <div class="span9"><input type="text" class="input-block-level" name="localidade" id="localidade" value="<?php echo $localidade?>"> </div>
                </div>
                
                
              </div>
              <div class="row-fluid">
              	<div class="row-fluid">
					<div class="span12"><label for="descricao">Descrição: </label></div>
                </div>
                <div class="row-fluid">
	                <div class="span12"><textarea class="input-block-level pull-left" rows="4" name="descricao" style="resize:none"><?php echo $descricao?></textarea></div> 
                </div>
              </div>
          </div>
        
        
        <div class="well">
          <h5>Dados do item</h5>
          <div class="row-fluid">
              <div class="span3">
                  <div class="span7"><label for="data_compra">Data de compra: </label></div> 
                  <div class="span5"> <input type="text" class="input-block-level" name="data_compra" id="data_compra" maxlength="10" value="<?php echo $data_compra?>" onkeyUp="formato_data(this)"> </div>
              </div>
              <div class="span2">
			      <div class="span4"><label for="valor">Valor: </label></div> 
                  <div class="span6">
                  		<div class='input-prepend span12'>
                          <span class='add-on' >R$</span>
                          <input type="text" class="input-block-level" name="valor" id="valor" value="<?php echo $valor?>" onkeyUp="formato_valor(this)"> 
                        </div>
                   </div>
              </div>
              <div class="span3">
			      <div class="span4"><label for="categoria">Categoria: </label></div> 
                  <div class="span6"><?php 
                                        echo "<select id='categoria' name='categoria' title='categoria' style='width: 120px;' >";
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
                                    ?> </div>
              </div>
              
              <div class="span3">
			      <div class="span6"><label for="disponibilidade">Disponibilidade: </label></div> 
                  <div class="span6"><?php
                                            echo "<select id='disponibilidade' name='disponibilidade' title='disponibilidade' style='width: 120px;'>";
                                            include 'controle/conexao.php';
                                            $query = mysql_query("select * from disponibilidade");
                                            if (mysql_num_rows($query) > 0) {
                                                $i=1;
                                                $selected="";
                                                while($dados = mysql_fetch_array($query)){
                                                    if($i==$disponibilidade_fk){$selected="selected";}
                                                    else{$selected="";}
                                                    echo "<option value='".$dados['disponibilidade_pk']."' $selected>".$dados['estado']."</option>";
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
        
      </form>
    </div>
<?php include 'footer.php' ?>