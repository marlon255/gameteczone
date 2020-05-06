<?php
	include('../insert/topo.php');
	include('../insert/menu.php');
	include('../insert/corpo.php');

	//Retirando intrusos da pagina
	if($fetch_usuario['nivel'] != 3){
		echo "<script>location.href='../painel/404.php';</script>";
	};
?>
<div class="lista_dados">
	<div class="cabecalho_info"><span>Consulta de Receitas Lançadas</span></div>
	<form method="post">
		<div class="consultar">
			<div class="formar_input">
				<label>Data Inicial</label>
				<input type="date" name="data_inicial" value="<?php echo date('Y-m-d'); ?>">
			</div>
			<div class="formar_input">
				<label>Data Final</label>
				<input type="date" name="data_final" value="<?php echo date('Y-m-d'); ?>">
			</div>
		</div>
		<div class="lancamento_button">
			<div class="formar_button">
				<input type="submit" name="consultar_receita" value="Consultar" class="button">
			</div>
		</div>
	</form>
</div>
<?php
	include('../insert/rodape.php');
?>