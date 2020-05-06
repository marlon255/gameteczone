<?php 
	include('../insert/topo.php');
	include('../insert/menu.php');
	include('../insert/corpo.php');
?>
<div class="lista_dados">
	<div class="cabecalho_info"><span>Ordem de Serviço</span></div>
	<form method="post">
		<div class="lancamento">
			<div class="formar_input">
				<label>Equipamento</label>
				<input type="text" name="equip_avaria" maxlength="25">
			</div>
			<div class="formar_input">
				<label>Avaria</label>
				<input type="text" name="problema">
			</div>
			<div class="formar_input">
				<label>Observação</label>
				<textarea name="observacao_avaria" rows="5" cols="5" maxlength="150" placeholder="MAX: 150 Caracteres"></textarea>
			</div>
		</div>
		<div class="lancamento_button">
			<div class="formar_button">
				<input type="submit" name="button_ordem" value="Lançar" class="button">
			</div>
		</div>
	</form>
</div>
<?php
	include('../insert/rodape.php');
?>