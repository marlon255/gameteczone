<?php
	include('../insert/topo.php');
	include('../insert/menu.php');
	include('../insert/corpo.php');

	//Retirando intrusos da pagina
	if($fetch_usuario['nivel'] != 3){
		echo "<script>location.href='../painel/404.php';</script>";
	};
	// Recuperando informações
	if(isset($_POST['consultar_busca'])){
		$d_inicial = $_POST['data_inicial'];
		$d_final = $_POST['data_final'];
	}else{
		$d_inicial = $_SESSION['d_inicial'];
		$d_final = $_SESSION['d_final'];
	}
?>
<div class="lista_dados">
	<div class="cabecalho_info"><span>Consulta de Receitas Lançadas</span></div>
	<form method="post">
		<div class="consultar">
			<div class="formar_input">
				<label>Data Inicial</label>
				<input type="date" name="data_inicial" value="<?php echo $d_inicial; ?>">
			</div>
			<div class="formar_input">
				<label>Data Final</label>
				<input type="date" name="data_final" value="<?php echo $d_final; ?>">
			</div>
		</div>
		<div class="lancamento_button">
			<div class="formar_button">
				<input type="submit" name="consultar_busca" value="Consultar" class="button">
			</div>
		</div>
	</form>
<table class="table_dados">
	<thead>
		<tr>
			<th class="dados_date">Date</th>
			<th>Descrição</th>
			<th class="dados_valor">Valor</th>
			<th>Observação</th>
			<th class="dados_acao">Opções</th>
		</tr>
	</thead>
	<tbody>
<?php
 
// Selecionando mais três frases, a partir da última
$query = "SELECT * FROM receitas WHERE `date` BETWEEN '".$d_inicial."' AND '".$d_final."' AND `status` = '1' ORDER BY id asc";
$busca = $PDO->prepare($query);
$busca->execute();
$fetch_busca = $busca->fetch(PDO::FETCH_ASSOC);

if($fetch_busca > 0){
	do{
		if(isset($_POST['obsoleto'.$fetch_busca['id']])):
			$new_status = "2";
			$data_modifica = date('Y-m-d');
			$hora_modifica = date('H:i:s');

			$sql_obsoleto = "UPDATE `receitas` SET `status` = :nova_situacao, `d_modificacao` = :modifica, `h_modificacao` = :hmodifica WHERE `id` = '".$_POST['obsoleto_id']."'";
			$obsoleto = $PDO->prepare($sql_obsoleto);
			$obsoleto->bindValue(":nova_situacao", $new_status);
			$obsoleto->bindValue(":modifica", $data_modifica);
			$obsoleto->bindValue(":hmodifica", $hora_modifica);
			$obsoleto->execute();
			echo "<script>alert('Alteração de dados concluída!');</script>";
			echo "<script>location.href='busca_receita.php';</script>";
		endif;
?>
	<tr>
		<th class="dados_date"><?php echo date('d/m/Y', strtotime($fetch_busca['date']))?></th>
		<th><?php echo $fetch_busca['descricao']?></th>
		<th class='dados_valor'><?php echo "R$ ".number_format($fetch_busca['valor'],2,',','.')?></th>
		<th><?php echo $fetch_busca['obs']?></th>
		<th class="dados_acao">
			<div class="action">
				<div class="menu_action_baixo"></div>
				<span>Ações</span>
			</div>
			<div class="acao_menu">
				<form method="post">
					<input type="hidden" name="obsoleto_id" value="<?=$fetch_busca['id'];?>">
					<input type="submit" name="obsoleto<?=$fetch_busca['id'];?>" value="Obsoleto">
				</form>
			</div>
		</th>
	</tr>
<?php
	}while ($fetch_busca = $busca->fetch(PDO::FETCH_ASSOC));
}else{
	echo "<tr><th colspan='5' style='text-align: center;'>Não há nenhuma informação cadastrada nestes parâmetros!</td></tr>";
}
?>
	</tbody>
</table>
</div>
<?php
	include('../insert/rodape.php');
?>