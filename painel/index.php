<?php
	include('../insert/topo.php');
	include('../insert/menu.php');
	include('../insert/corpo.php');
?>
<div class="iframe">
	<h3>Bem Vindo.</h3>
	<div>Bem vindo Senhor(a) <span><?=$fetch_usuario['name'];?></span> ao sistema de organização financeira da empresa GameTecZone.<br>
		Aqui você terá as ferramentas necessarias para o controle do seu gosto.<br><br>
		Atenciosamente.<br>
		Administração.
	</div>
</div>
<?php
	include('../insert/rodape.php');
?>