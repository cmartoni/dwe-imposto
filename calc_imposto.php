<?php
	$salInicial = $_POST['salInput'];
	if($salInicial == NULL){
		$salInicial = 0;
	}

	 //Calc INSS
	//Faixa A
	if (($salInicial >= 0) && ($salInicial <= 1556.94)) {
		$aliqINSS=8;
		$teto=$salInicial;
	}
	//Faixa B	
	elseif (($salInicial>1556.94) && ($salInicial<=2594.92)) {
		$aliqINSS=9;
		$teto=$salInicial;
	}
	//Faixa C
	elseif ($salInicial>2594.92 && $salInicial<=5189.82) {
		$aliqINSS=11;
		$teto=$salInicial;
	}
	//"Faixa D"
	elseif ($salInicial>5189.82) {
		$aliqINSS=11;
		$teto=5189.82;
	}


	$valINSS = ($teto * $aliqINSS)/100;
	$sal = $salInicial - $valINSS;


	  //--------------------------
	 //Calc Imposto de renda
	//Faixa A
	if (($sal >= 0) && ($sal <= 1903.98)) {
		$aliqRenda=0;
		$deducao=0;
	}
	//Faixa B
	elseif (($sal > 1903.98) && ($sal <= 2826.65)) {
		$aliqRenda=7.5;
		$deducao=142.80;

	}
	//Faixa C
	elseif (($sal > 2826.65)  && ($sal <= 3751.05)) {
		$aliqRenda=15;
		$deducao=354.80;

	}
	//Faixa D
	elseif (($sal > 3751.05) && ($sal <= 4664.68)) {
		$aliqRenda=22.5;
		$deducao=636.13;

	}
	//Faixa E
	elseif ($sal> 4664.68) {
		$aliqRenda=27.5;
		$deducao=869.36;

	}

	$valImpRenda = (($sal*$aliqRenda)/100) - $deducao;
	$sal = $sal - $valImpRenda;

 ?>
 <html>
 <head>
	<title>Calculadora de Salário Líquido</title>
	<meta charset="utf-8">
	<link rel="stylesheet" href="css/reset.css">
	<link rel="stylesheet" href="css/styles.css">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<script href="js/jquery.min.js"></script>
	<script href="js/bootstrap.min.js"></script>
 <body>
 	<div class="container">
 		<div class="panel-group space-top">
	    	<div class="panel panel-default">
	      		<div class="panel-heading">Calculadora de Salário Líquido</div>
	    		<div class="panel-body">
					<form action="calc_imposto.php" method="post">
						<div class="input-group">
							<span class="input-group-addon">R$</span>
			  				<input type="number" class="form-control text-right" name="salInput" step="0.01">
			  			</div>

						<input type="submit" class="btn btn-info pull-right" value="Calcular" />
					</form>
				</div>
			</div>
		</div>
		<div class="panel-group">
	    	<div class="panel panel-default">
	      		<div class="panel-heading">Salário Líquido</div>
	    		<div class="panel-body">
	    			<table class="table table-striped">
	    				<thead>
							<tr>
								<th>Nome</th>
								<th></th>
								<th>Valor(em Reais)</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>Salário Inical</td>
								<td></td>
								<td>R$ <?php echo number_format($salInicial, 2, ",", "."); ?></td>
							</tr>
							<tr>

								<td>INSS</td>
								<td><?php echo $aliqINSS; ?>%</td>
								<td>R$ <?php echo number_format($valINSS, 2, ",", "."); ?></td>
							</tr>
							<tr>
								<td>Imposto de Renda</td>
								<td><?php echo $aliqRenda; ?>%</td>
								<td>R$ <?php echo number_format($valImpRenda, 2, ",", "."); ?></td>
							</tr>
							<tr class="success">
								<td>Salário Líquido</td>
								<td></td>
								<td>R$ <?php echo number_format($sal, 2, ",", "."); ?></td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
 
 </body>
 </html>