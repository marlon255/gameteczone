<?php 
	include('../insert/topo.php');
	include('../insert/menu.php');
	include('../insert/corpo.php');
?>
<div class="title_modal">
	<span>Alterar Senha</span>
</div>
<form method="post" class="cadastro_modal">
	<label>Digite a Senha Antiga:</label>
	<input type="password" name="antigoPassword" placeholder="Antiga senha">
	<label>Digite a Senha Nova:</label>
	<input type="password" name="novoPassword" placeholder="Nova senha">
	<label>Confirme a Senha Nova:</label>
	<input type="password" name="confirmaPassword" placeholder="Confirmar a nova senha">
	<input type="submit" name="changePassword" class="button">
</form>
<div class="title_modal">
	<span>Alterar Imagem do Perfil</span>
</div>
<form method="post" class="form_imagem" enctype="multipart/form-data">
	<input type="file" name="imgUser" class="input_file">
	<input type="submit" name="alt_image" class="button">
</form>
<?php 
	include('../insert/rodape.php');
?>