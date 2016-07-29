<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Gestão Patrimonial</title>
    <link href="/gestaopatrimonial/css/bootstrap.css" rel="stylesheet" type="text/css" />
	<link href="/gestaopatrimonial/css/bootstrap-responsive.min.css" rel="stylesheet">
	<link href="/gestaopatrimonial/css/style.css" rel="stylesheet">
    <script type="text/javascript" src="/gestaopatrimonial/js/validacao.js"></script>
    <script type="text/javascript" src="/gestaopatrimonial/js/funcoes.js"></script>
	<link rel="icon" type="image/png" href="/gestaopatrimonial/img/favicon.png">
</head>
<body>
	<script src="js/jquery.js"></script>
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
	<link href="/gestaopatrimonial/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<nav class="navbar navbar-default" style="top:0px !important;">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <a class="navbar-brand" href="/gestaopatrimonial/inicio.php">
	  <!--<img alt="Brand" src="/gestaopatrimonial/img/favicon.png" width="20" height="20">-->
	  <strong>Gestão Patrimonial</strong>
	  </a>
    </div>
	<ul class="nav navbar-nav">
        <li class="active"><a href="novo.php">Cadastrar item <span class="sr-only">(current)</span></a></li>
        <!--<li><a href="#">Link</a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="#">Action</a></li>
            <li><a href="#">Another action</a></li>
            <li><a href="#">Something else here</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="#">Separated link</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="#">One more separated link</a></li>
          </ul>
        </li>-->
      </ul>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				  <p class="navbar-text navbar-right">Logado como  <?php echo $_SESSION['usuario']['usuario']?>  /  <a class="btn btn-primary btn-xs" href="controle/logout.php">Logout</a></p>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>