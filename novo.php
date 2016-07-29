<?php 
session_start();
include 'controle/controle.php';
include 'header.php' ?>
    <div class="container">
    <h1>Insira os dados do item</h1>
      <form class="form-horizontal" action="controle/novo.php">
        <div class="well">
          <h5>Identificação</h5>
          <div class="row">
			  <div class="col-md-6">
			      <label class="col-sm-2 control-label" for="item_pk">Patrimônio: </label> 
                  <div class="col-sm-10"> <input type="text" class="form-control" name="item_pk" id="item_pk" > </div>
              </div>
              <div class="col-md-6">
                  <label class="col-sm-2 control-label" for="disponibilidade">Status: </label> 
                  <div class="col-sm-10"><?php 
                                        echo "<select class='form-control' id='disponibilidade' name='disponibilidade' title='disponibilidade' >";
                                            include 'controle/conexao.php';
                                            $query = mysql_query("select * from disponibilidade");
                                            if (mysql_num_rows($query) > 0) {
                                                while($dados = mysql_fetch_array($query)){
                                                    echo "<option value='".$dados['disponibilidade_pk']."'>".$dados['estado']."</option>";
                                                }
                                            }
                                        echo "</select>"; 
                                    ?></div>
              </div>
			</div>
			<div class="row">
			  <div class="col-md-6">
                  <label class="col-sm-2 control-label" for="nome">Descrição: </label>
                  <div class="col-sm-10"><input type="text" class="form-control" name="nome" id="nome" > </div>
              </div>
			  <div class="col-md-6">
                  <label class="col-sm-2 control-label" for="categoria">Tipo: </label>
                  <div class="col-sm-10"><?php 
                                        echo "<select class='form-control' id='categoria' name='categoria' title='categoria' >";
                                            include 'controle/conexao.php';
                                            $query = mysql_query("select * from categoria");
                                            if (mysql_num_rows($query) > 0) {
                                                while($dados = mysql_fetch_array($query)){
                                                    echo "<option value='".$dados['categoria_pk']."'>".utf8_encode($dados['categoria'])."												</option>";
                                                }
                                            }
                                        echo "</select>"; 
                                    ?> </div>
              </div>
			</div>
			<div class="row">
				<div class="col-md-6">
					<label class="col-sm-2 control-label" for="responsavel">Responsável: </label>
					<div class="col-sm-10"><input type="text" class="form-control" name="responsavel" id="responsavel" > </div>
				</div>
				<div class="col-md-6">
               	  <label class="col-sm-4 control-label" for="lugar">Departamento: </label>
                  <div class="col-sm-8"><?php 
                                        echo "<select class='form-control' id='localizacao' name='localizacao' title='localizacao' >";
                                            include 'controle/conexao.php';
                                            $query = mysql_query("select * from localizacao");
                                            if (mysql_num_rows($query) > 0) {
                                                while($dados = mysql_fetch_array($query)){
                                                    echo "<option value='".$dados['localizacao_pk']."'>".$dados['lugar']."</option>";
                                                }
                                            }
                                        echo "</select>"; 
                                    ?></div>
                </div>
			</div>
		</div>
        
        <center>
            <button class="btn btn-primary" type="submit">Salvar</button>
  		    <button class="btn btn-default" type="reset">Limpar</button>
        </center>
        
      </form>
    </div>
	
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
	
<?php include 'footer.php' ?>