    <div class="container">
    <h1>Insira os dados do item</h1>
      <form class="form-horizontal">
        <div class="well">
          <h5>Identificação</h5>
          <div class="row-fluid">
              <div class="span6">
                  <div class="span1"><label for="nome">Nome: </label></div> 
                  <div class="span11"> <input type="text" class="input-block-level" name="nome" id="nome" > </div>
              </div>
              <div class="span6">
			      <div class="span2"><label for="numero_serie">Nº de série: </label></div> 
                  <div class="span10"> <input type="text" class="input-block-level" name="numero_serie" id="numero_serie" > </div>
              </div>
          </div>
          <div class="row-fluid">
              <div class="span6">
                  <div class="span2"><label for="fornecedor">Fornecedor: </label></div> 
                  <div class="span10"> <input type="text" class="input-block-level" name="fornecedor" id="fornecedor" > </div>
              </div>
              <div class="span6">
			      <div class="span2"><label for="nf">Nº da NF: </label></div> 
                  <div class="span10"> <input type="text" class="input-block-level" name="nf" id="nf" > </div>
              </div>
          </div>
        </div>
        
        <div class="well">
          <h5>Localização</h5>
          <div class="row-fluid">
              <div class="span4">
                  <div class="span3"><label for="responsavel">Responsável: </label></div>
                  <div class="span9"> <input type="text" class="input-block-level" name="responsavel" id="responsavel" ></div>
              </div>
              <div class="span4">
               	  <div class="span2"><label for="lugar">Lugar: </label></div> 
                  <div class="span10"><?php 
                                        echo "<select id='lugar' name='lugar' title='lugar' >";
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
                
                <div class="span4">
               	  <div class="span3"><label for="localidade">Localidade: </label></div> 
                  <div class="span9"><input type="text" class="input-block-level" name="localidade" id="localidade"> </div>
                </div>
                
                
              </div>
              <div class="row-fluid">
              	<div class="row-fluid">
					<div class="span12"><label for="descricao">Descrição: </label></div>
                </div>
                <div class="row-fluid">
	                <div class="span12"><textarea class="input-block-level pull-left" rows="4" name="descricao" style="resize:none"></textarea></div> 
                </div>
              </div>
          </div>
        
        <div class="well">
          <h5>Dados do item</h5>
          <div class="row-fluid">
              <div class="span3">
                  <div class="span7"><label for="data">Data de compra: </label></div> 
                  <div class="span5"> <input type="text" class="input-block-level" name="data" id="data" maxlength="10" > </div>
              </div>
              <div class="span2">
			      <div class="span4"><label for="valor">Valor: </label></div> 
                  <div class="span6"> <input type="text" class="input-block-level" name="valor" id="valor" > </div>
              </div>
              <div class="span3">
			      <div class="span4"><label for="categoria">Categoria: </label></div> 
                  <div class="span6"><?php 
                                        echo "<select id='categoria' name='categoria' title='categoria' style='width: 120px;' >";
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
              
              <div class="span3">
			      <div class="span6"><label for="disponibilidade">Disponibilidade: </label></div> 
                  <div class="span6"><?php 
                                        echo "<select id='disponibilidade' name='disponibilidade' title='disponibilidade' style='width: 120px;'>";
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
        </div>
        
        <div class="row-fluid">
        <center>
            <button class="btn btn-primary" type="submit">Salvar</button>
  		    <button class="btn" type="reset">Limpar</button>
        </center>
        </div>
        
      </form>
    </div>