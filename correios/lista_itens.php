<link href="css/bootstrap.css" rel="stylesheet" type="text/css" />
    <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
	<link href="css/bootstrap-responsive.min.css" rel="stylesheet">
	<link href="css/style.css" rel="stylesheet">
    <script type="text/javascript" src="js/validacao.js"></script>
    <script type="text/javascript" src="js/funcoes.js"></script>
<?php
			  
			  	include '../controle/conexao.php';
			  	$query = mysql_query("select * from item, disponibilidade, categoria, localizacao where disponibilidade_fk=disponibilidade_pk and categoria_fk = categoria_pk and localizacao_pk = localizacao_fk and visibilidade=1");
				
				echo "<table class='table table-condensed table-bordered table-hover' style='font-size: 13px;'>
			  <thead>
				  <tr>
				  	  <th></th>
					  <th>#</th>
					  <th>Nome</th>
					  <th>Localidade</th>
					  <th>Disponibilidade</th>
					  <th>Nota Fiscal</th>
					  <th>Data da compra</th>
				  </tr>
			  </thead>
			  <tbody>";
			  
				if(mysql_num_rows($query) > 0) {
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
											<td><input type='checkbox' name='itens' value='$item_pk'></td>
											<td>".$item_pk."</td>
											<td>".$nome."</td>
											<td>".$localidade."</td>
											<td>".$estado."</td>
											<td>".$nf."</td>
											<td>".$data_compra."</td>
										   </tr>";
					}
				}
				echo "</tbody>
				</table>";
			  ?>