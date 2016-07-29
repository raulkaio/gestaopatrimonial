<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Sistema patrimonial 2.0</title>

<link href="css/bootstrap.css" rel="stylesheet" type="text/css" />
<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
</head>

<body cz-shortcut-listen="true">

    <div class="container well" style="width:280px; margin-top:150px; padding:30px;">

      <form class="form-signin text-center" action="controle/login.php" method="post">
        <h3 class="form-signin-heading text-center">ÁREA RESTRITA</h3>
        			<div class='row-fluid '>
                        <div class='input-prepend'>
                          <span class='add-on' ><i class="icon-user"></i> </span>
                          <input type='text' name='login' id='login' required>
                        </div>
                    </div>
                    
                    <div class='row-fluid'>
                        <div class='input-prepend'>
                          <span class='add-on' ><i class="icon-lock"></i> </span>
                          <input type='password' name='senha' id='senha' required>
                        </div>
                    </div>
            <button class="btn btn-primary" type="submit">Entrar</button>
            <button class="btn" type="reset">Limpar</button>
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
    
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap-transition.js"></script>
    <script src="js/bootstrap-alert.js"></script>
    <script src="js/bootstrap-modal.js"></script>
    <script src="js/bootstrap-dropdown.js"></script>
    <script src="js/bootstrap-scrollspy.js"></script>
    <script src="js/bootstrap-tab.js"></script>
    <script src="js/bootstrap-tooltip.js"></script>
    <script src="js/bootstrap-popover.js"></script>
    <script src="js/bootstrap-button.js"></script>
    <script src="js/bootstrap-collapse.js"></script>
    <script src="js/bootstrap-carousel.js"></script>
    <script src="js/bootstrap-typeahead.js"></script>

  

</body>
</html>