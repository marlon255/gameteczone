<?php require_once('pags/connect.php'); require_once('pags/login.php'); ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>AL Refeição - Sistema Financeiro</title>
  <link rel="stylesheet" type="text/css" href="assets/css/estilo.css">
  <link rel="shortcut icon" href="assets/img/logo.ico">
  <script type="text/javascript" src="assets/js/jquery.min.js"></script>
  <script type="text/javascript" src="assets/js/jquery.maskMoney.js"></script>
  <script type="text/javascript" src="assets/js/funcoes.js"></script>
  <style>@import url('https://fonts.googleapis.com/css?family=Ubuntu');</style>
</head>
<body>
<div class="corpo_inicial">
	<div class="login_inicial">
		<div class="logo_inicial"></div>
		<form method="post">
			<input type="text" name="login" id="login" placeholder="Login:">
			<input type="password" name="senha" placeholder="Senha:">
			<input type="submit" class="buton_submit" name="logar" value="Logar">
		</form>
	</div>
	<div class="rodape_inicial"></div>
</div>
</body>
</html>