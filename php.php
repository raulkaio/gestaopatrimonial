<?php
	include ('controle/conexao.php');
	
	echo "<html>
		<header>
			<link href='css/bootstrap.css' rel='stylesheet' type='text/css'>
		</header>
		<body>
		<div class='hero-unit'>";
		
	
	
	//$query = mysql_query("SELECT * FROM item WHERE nf = '000256019'");
	$query = mysql_query("SELECT localidade,numero_serie FROM `item` WHERE localidade like '%Sicredi Holambra - SP%' group by localidade DESC");
	while($result = mysql_fetch_array($query)){
		$query2 = mysql_query("SELECT item_pk,nome, numero_serie, localidade,nf,disponibilidade_fk FROM `item` WHERE localidade like '".$result['localidade']."' order by nome,item_pk");
		//$query2 = mysql_query("SELECT * FROM item WHERE nf = '000256019'");
		$local = $result['localidade'];
		echo "<h2>".$local."</h2>";
		echo "			
			<table class='table table-bordered table-hover'>
			
					<tr>
						<th>ID</th>
						<th>nome</th>
						<th>serial</th>
						<th>NF</th>
					</tr>
					";
			$cont = 0;
		while($dados = mysql_fetch_array($query2)){
			$cont++;
			$nome = $dados['nome'];
			$item_pk = $dados['item_pk'];
			$numero_serie = $dados['numero_serie'];  
			$nota = $dados['nf'];  
			echo "<tr><td>$item_pk</td><td>$nome</td><td>$numero_serie</td><td>$nota</td></tr>";	
		}
		//echo "<tr><td>".$cont."</td></tr>";
		echo "</table>";
		
	}
	//echo "<h2>GILMAR, INSTALAR ESSES EQUIPAMENTOS! 16/08/2014 </h2>";
		//echo "<h2>FAVOR TESTAR EQUIPAMENTOS</h2>";

	
				
		
		
	
	
	
	
	echo "</div>
	</body>
		</html>";
?>