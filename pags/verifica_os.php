<?php 
	include('../insert/topo.php');
	include('../insert/menu.php');
	include('../insert/corpo.php');

	$numero_os = $_GET['OS_id'];

	$query = "SELECT * FROM ordemservico WHERE `numero_os` = $numero_os ORDER BY id asc";
	$busca = $PDO->prepare($query);
	$busca->execute();
	$fetch_busca = $busca->fetch(PDO::FETCH_ASSOC);

	//Buscando as mensagens
	$query_msg = "SELECT * FROM resposta_os WHERE `os_id` = $numero_os";
	$busca_msg = $PDO->prepare($query_msg);
	$busca_msg->execute();
	$fetch_msg = $busca_msg->fetch(PDO::FETCH_ASSOC);

	//Respondendo OS
	if(isset($_POST['button_os'])){
		$os_id = $numero_os;
		$status = $_POST['os_estado'];
		$data_atual = $_POST['data_os'];
		$valor_os = str_replace(".", "", str_replace("R$", "", $_POST['valor_os']));
		$valor_final = str_replace(",", ".", $valor_os);
		$msg_os = $_POST['resposta_os'];
		$usuario = $_SESSION['login'];
		$data = date('Y-m-d');
		$hora = date('H:i:s');

		if(empty($msg_os)){
			echo "<script>alert('Faltou preencher o campo MENSAGEM!');</script>";
		}else{
			$sql = "INSERT INTO `resposta_os`(`os_id`, `msg_os`, `data_prev`, `valor`, `user_atual`, `data_atual`, `hora_atual`) VALUES (:a, :b, :c, :d, :e, :f, :g); INSERT INTO `os_atual` (`n_os`, `status`, `user_atual`, `date_atual`, `hour_atual`) VALUES (:a, :h, :e, :f, :g)";
			$cadastro = $PDO->prepare($sql);
			$cadastro->bindValue(":a", $os_id);
			$cadastro->bindValue(":b", $msg_os);
			$cadastro->bindValue(":c", $data_atual);
			$cadastro->bindValue(":d", $valor_final);
			$cadastro->bindValue(":e", $usuario);
			$cadastro->bindValue(":f", $data);
			$cadastro->bindValue(":g", $hora);
			$cadastro->bindValue(":h", $status);
			$cadastro->execute();

			echo "<script>alert('Mensagem enviada!');</script>";
			//echo "<script>location.href='verifica_os.php?OS_id=".$numero_os."';</script>";
		};
	};
?>
	<div class="lista_dados">
		<div class="cabecalho_info"><span>OS: <?php echo $numero_os;?></span></div>
		<div class="texto_trelatorio">Aberto por: <b><?php echo $fetch_busca['cliente'];?></b> no dia <b><?php echo date('d/m/Y', strtotime($fetch_busca['date_created']));?></b></div>
		<div class="conteudo_os">
			<div class="title_os">Informações da OS</div>
			<div class="info_os">Equipamento: <span><?php echo $fetch_busca['equipamento'];?></span><br>
				 Avaria: <span><?php echo $fetch_busca['avaria']."</span><br> Observação: <span>".$fetch_busca['observacao']."</span>";?>
			</div>
			<div class="info_os">
				Mensagem: <span><?php echo $fetch_msg['msg_os']."</span><br> Data prevista para entrega: <span>".date('d/m/Y', strtotime($fetch_msg['data_prev']))."</span><br>Valor: <span>".$fetch_msg['valor']."</span><br>Enviada por: <span>".$fetch_msg['user_atual']."</span>";?>
			</div>
		</div>
		<div></div>
		<div class="lancamento">
			<form method="post">
				<div class="formar_input">
				<label>Estado</label>
				<select name="os_estado">
					<option value="2">Em analise</option>
					<option value="3">Orçamento enviado</option>
					<option value="4">Em manutenção</option>
					<option value="5">Fechado</option>
				</select>
				</div>
				<div class="formar_input">
					<label>Data da Entrega</label>
					<input type="date" name="data_os" value="<?php echo date('Y-m-d'); ?>">
				</div>
				<div class="formar_input">
					<label>Valor</label>
					<input type="text" name="valor_os" id="money1" value="R$0,00">
				</div>
				<div class="formar_textarea">
				<label>Mensagem</label>
				<textarea class="textarea_os" name="resposta_os" rows="5" cols="5" placeholder="Máximo de 150 caracteres"></textarea>
				</div>
				<div class="button_align">
					<div class="formar_button">
						<input type="submit" name="button_os" value="Atualizar OS" class="button">
					</div>
				</div>
			</form>
		</div>
	</div>
<?php
	include('../insert/rodape.php');
?>