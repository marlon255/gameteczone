<?php 
	include('../insert/topo.php');
	include('../insert/menu.php');
	include('../insert/corpo.php');
?>
<table class="table_dados">
	<thead>
		<tr>
			<th class="dados_date">Data</th>
			<th class="dados_pagamento">Número da OS</th>
			<th class="dados_valor">Cliente</th>
			<th class="dados_pagamento">Equipamento</th>
			<th class="dados_pagamento">Avaria</th>
			<th>Observação</th>
			<th class="dados_valor">Estado</th>
			<th class="dados_acao">Opções</th>
		</tr>
	</thead>
	<tbody>
<?php

$query = "SELECT * FROM ordemservico ORDER BY id asc";
$busca = $PDO->prepare($query);
$busca->execute();
$fetch_busca = $busca->fetch(PDO::FETCH_ASSOC);



if($fetch_busca > 0){
	do{
		$query_status = "SELECT * FROM `os_atual` WHERE `n_os` = '".$fetch_busca['numero_os']."' ORDER BY `status` DESC LIMIT 1";
		$busca_status = $PDO->prepare($query_status);
		$busca_status->execute();
		$fetch_status = $busca_status->fetch(PDO::FETCH_ASSOC);

		/*if(isset($_POST['obsoleto'.$fetch_busca['id']])):
			$new_status = "2";
			$data_modifica = date('Y-m-d');
			$hora_modifica = date('H:i:s');

			$sql_obsoleto = "UPDATE `despesas` SET `status` = :nova_situacao, `d_modifica` = :modifica, `h_modifica` = :hmodifica WHERE `id` = '".$_POST['obsoleto_id']."'";
			$obsoleto = $PDO->prepare($sql_obsoleto);
			$obsoleto->bindValue(":nova_situacao", $new_status);
			$obsoleto->bindValue(":modifica", $data_modifica);
			$obsoleto->bindValue(":hmodifica", $hora_modifica);
			$obsoleto->execute();
			echo "<script>alert('Alteração de dados concluída!');</script>";
			echo "<script>location.href='busca_despesa.php';</script>";
		endif;
		if(isset($_POST['pago'.$fetch_busca['id']])):
			$novo_pagamento = "2";
			$data_modifica = date('Y-m-d');
			$hora_modifica = date('H:i:s');

			$sql_pagamento = "UPDATE `despesas` SET `pago` = :novo_pagamento, `d_modifica` = :modifica, `h_modifica` = :hmodifica WHERE `id` = '".$_POST['obsoleto_id']."'";
			$pagamento = $PDO->prepare($sql_pagamento);
			$pagamento->bindValue(":novo_pagamento", $novo_pagamento);
			$pagamento->bindValue(":modifica", $data_modifica);
			$pagamento->bindValue(":hmodifica", $hora_modifica);
			$pagamento->execute();
			echo "<script>alert('Você realizou o pagamento da despesa ".$fetch_busca['descricao']."!');</script>";
			echo "<script>location.href='busca_despesa.php';</script>";
		endif;*/
?>
	<tr>
		<th class="dados_date"><?php echo date('d/m/Y', strtotime($fetch_busca['date_created']));?></th>
		<th class="dados_pagamento"><?php echo $fetch_busca['numero_os'];?></th>
		<th class='dados_valor'><?php echo $fetch_busca['cliente'];?></th>
		<th class="dados_pagamento"><?php echo $fetch_busca['equipamento'];?></th>
		<th class="dados_pagamento"><?php echo $fetch_busca['avaria'];?></th>
		<th><?php echo $fetch_busca['observacao'];?></th>
		<th class='dados_valor'><?php if($fetch_status['status'] == 1){echo "Aberto";}elseif($fetch_status['status'] == 2){echo "Em analise";}elseif($fetch_status['status'] == 3){echo "Orçamento enviado";}elseif($fetch_status['status'] == 4){echo "Em manutenção";}elseif($fetch_status['status'] == 5){echo "Fechado";}else{echo "ERROR!!!";} ;?></th>
		<th class="dados_acao">
			<div class="action">
				<div class="menu_action_baixo"></div>
				<span>Ações</span>
			</div>
			<div class="acao_menu">
				<form action="verifica_os.php" method="get">
					<input type="hidden" name="OS_id" value="<?=$fetch_busca['numero_os'];?>">
					<input type="submit" name="OS<?=$fetch_busca['id'];?>" value="Verificar OS">
				</form>
			</div>
		</th>
	</tr>
<?php
	}while ($fetch_busca = $busca->fetch(PDO::FETCH_ASSOC));
}else{
	echo "<tr><th colspan='7' style='text-align: center;'>Não há nenhuma informação cadastrada nestes parâmetros!</td></tr>";
}
?>
	</tbody>
</table>
<?php
	include('../insert/rodape.php');
?>