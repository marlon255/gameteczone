<?php
	include('../insert/topo.php');
	include('../insert/menu.php');
	include('../insert/corpo.php');
?>
<div class="lista_dados">
	<div class="cabecalho_info"><span>Lançamento de Despesas</span></div>
	<form method="post">
		<div class="lancamento">
			<div class="formar_input">
				<label>Data</label>
				<input type="date" name="date_lancamento" value="<?php echo date('Y-m-d'); ?>">
			</div>
			<div class="formar_input">
				<label>Descrição</label>
				<input type="text" name="description_lancamento" maxlength="25">
			</div>
			<div class="formar_input">
				<label>Valor</label>
				<input type="text" name="value_lancamento" id="money1" value="R$0,00">
			</div>
			<div class="formar_input">
				<label>Data de Vencimento</label>
				<input type="date" name="d_vencimento" value="<?php echo date('Y-m-d'); ?>">
			</div>
			<div class="formar_input">
				<label>Forma de Pagamento</label>
				<select name="f_pagamento">
					<option>Dinheiro</option>
					<option>Boleto</option>
					<option>Transferência Bancaria</option>
					<option>Cheque</option>
				</select>
			</div>
			<div class="formar_input">
				<label>Observação</label>
				<textarea name="observation_lancamento" rows="5" cols="5"></textarea>
			</div>
		</div>
		<div class="lancamento_button">
			<div class="formar_button">
				<input type="submit" name="button_lancamento" value="Lançar" class="button">
			</div>
		</div>
	</form>
</div>
<?php
	include('../insert/rodape.php');
?>