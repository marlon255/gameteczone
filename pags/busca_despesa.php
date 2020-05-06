<?php
	include('../insert/topo.php');
	include('../insert/menu.php');
	include('../insert/corpo.php');
	//Ativando PHPMailer
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;

	require '../assets/mailer/src/Exception.php';
	require '../assets/mailer/src/PHPMailer.php';
	require '../assets/mailer/src/SMTP.php';

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
	<div class="cabecalho_info"><span>Consulta de Despesas Lançadas</span></div>
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
			<th class="dados_date">Data de Vencimento</th>
			<th class="dados_pagamento">Forma de pagamento</th>
			<th>Observação</th>
			<th class="dados_acao">Opções</th>
		</tr>
	</thead>
	<tbody>
<?php

// Selecionando mais três frases, a partir da última
$query = "SELECT * FROM despesas WHERE `date` BETWEEN '".$d_inicial."' AND '".$d_final."' AND `status` = '1' AND `pago` = '1' ORDER BY id asc";
$busca = $PDO->prepare($query);
$busca->execute();
$fetch_busca = $busca->fetch(PDO::FETCH_ASSOC);

if($fetch_busca > 0){
	do{
		if(isset($_POST['obsoleto'.$fetch_busca['id']])):
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
			$valor_mail = number_format($fetch_busca['valor'],2,',','.');
			$data_mail = date('d/m/Y');

			$sql_pagamento = "UPDATE `despesas` SET `pago` = :novo_pagamento, `d_modifica` = :modifica, `h_modifica` = :hmodifica WHERE `id` = '".$_POST['obsoleto_id']."'";
			$pagamento = $PDO->prepare($sql_pagamento);
			$pagamento->bindValue(":novo_pagamento", $novo_pagamento);
			$pagamento->bindValue(":modifica", $data_modifica);
			$pagamento->bindValue(":hmodifica", $hora_modifica);
			//$pagamento->execute();
			echo "<script>alert('Você realizou o pagamento da despesa ".$fetch_busca['descricao']."!');</script>";
			//echo "<script>location.href='busca_despesa.php';</script>";

				// Instantiation and passing `true` enables exceptions
				$mail = new PHPMailer(true);

				try {
				    //Server settings
				    $mail->SMTPDebug = 2;                                       // Enable verbose debug output
				    $mail->isSMTP();                                            // Set mailer to use SMTP
                                    $mail->Mailer = 'smtp';
				    $mail->Host       = 'smtp.gmail.com';			// Specify main and backup SMTP servers
				    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
				    $mail->Username   = 'marlon.0255@gmail.com';                // SMTP username
				    $mail->Password   = 'mylenagera';                           // SMTP password
				    $mail->SMTPSecure = 'SSL';                                  // Enable TLS encryption, `ssl` also accepted
				    $mail->Port       = 465;                                    // TCP port to connect to
				    $mail->CharSet = "UTF-8"; 									//CHARSET DO EMAIL
				    $mail->Encoding = 'base64';
				    //Recipients
				    $mail->setFrom('marlon.0255@gmail.com', 'Marlon Breno Gera');
				    $mail->addAddress('marlon.0255@gmail.com', 'Marina Garteiro');     // Add a recipient
				    //$mail->addAddress('ellen@example.com');               // Name is optional
				    //$mail->addReplyTo('info@example.com', 'Information');
				    //$mail->addCC('cc@example.com');
				    //$mail->addBCC('bcc@example.com');

				    // Attachments
				    //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
				    //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

				    // Content
				    $mail->isHTML(true);                                  // Set email format to HTML
				    $mail->Subject = 'Confirmação de Pagamento do sistema da GameTecZone.';
				    $mail->Body    = 'Confirmação do pagamento da conta <b>'.$fetch_busca["descricao"].'</b><br>Na data de <b>'.$data_mail.'</b><br>No valor de R$ <b>'.$valor_mail.'</b>.';
				    $mail->AltBody = 'Confirmação do pagamento da conta.';

				    $mail->send();
				    //echo 'Message has been sent';
				} catch (Exception $e) {
				    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
				}
		endif;
?>
	<tr>
		<th class="dados_date"><?php echo date('d/m/Y', strtotime($fetch_busca['date']))?></th>
		<th><?php echo $fetch_busca['descricao']?></th>
		<th class='dados_valor'><?php echo "R$ ".number_format($fetch_busca['valor'],2,',','.')?></th>
		<th class="dados_date"><?php echo date('d/m/Y', strtotime($fetch_busca['d_vencimento']))?></th>
		<th class="dados_pagamento"><?php echo $fetch_busca['f_pagamento']?></th>
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
					<?php
						if($fetch_usuario['nivel'] == 2 OR $fetch_usuario['nivel'] == 3):
					?>
					<input type="submit" name="pago<?=$fetch_busca['id'];?>" value="Inf. Pagamento">
					<?php
						endif;
					?>
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
</div>
<?php
	include('../insert/rodape.php');
?>