<?php
	include('../insert/topo.php');
	include('../insert/menu.php');
	include('../insert/corpo.php');

	if($fetch_usuario['nivel'] != 3){
		echo "<script>location.href='../painel/404.php';</script>";
	}
?>
<div class="lista_dados">
	<div class="cabecalho_info">
		<span>Usúarios</span>
		<div id="cadastro_dados">Cadastrar</div>
	</div>
	<table class="table_dados">
		<thead>
			<tr>
				<th class="dados_matricula">Matrícula</th>
				<th class="dados_telefone">Usúario</th>
				<th>Nome</th>
				<th class="dados_telefone">Telefone</th>
				<th class="dados_situacao">Situação</th>
				<th class="dados_situacao">Cargo</th>
				<th class="dados_acao">Opções</th>
			</tr>
		</thead>
		<tbody>
			<?php 
			if($fetch_user > 0){
			do{
				if(isset($_POST['reset_senha_'.$fetch_user['id']])):
				$nova_senha = "12345";

				$sql_reset_pass = "UPDATE `users` SET `password`=:new_senha WHERE id='".$fetch_user['id']."'";
				$reset_pass = $PDO->prepare($sql_reset_pass);
				$reset_pass->bindValue(":new_senha", $nova_senha);
				$reset_pass->execute();
				echo "<script>alert('Sua senha foi resetada!')</script>";
				echo "<script>location.href='user_privi.php';</script>";
				endif;

				if(isset($_POST['inativar_'.$fetch_user['id']])):
					if($_POST['inativar_'.$fetch_user['id']]=="Inativar"){
						$situacao = "2";
					}else{
						$situacao = "1";
					};
				$sql_situacao = "UPDATE `users` SET `status`=:situacao_user WHERE id='".$fetch_user['id']."'";
				$situacao_cliente = $PDO->prepare($sql_situacao);
				$situacao_cliente->bindValue(":situacao_user", $situacao);
				$situacao_cliente->execute();
				echo "<script>alert('Usuário alterado com sucesso!')</script>";
				echo "<script>location.href='user_privi.php';</script>";
				endif;
			?>
			<tr>
				<th class="dados_matricula"><?php echo $fetch_user['id'];?></th>
				<th class="dados_telefone"><?php echo $fetch_user['login'];?></th>
				<th><?php echo $fetch_user['name'];?></th>
				<th class="dados_telefone"><?php echo $fetch_user['telefone'];?></th>
				<th class="dados_situacao"><?php if($fetch_user['status']=="1"){echo "Ativo";}else{echo "Inativo";};?></th>
				<th class="dados_situacao"><?php if($fetch_user['nivel'] == 1){echo "Cliente";}elseif($fetch_user['nivel'] == 2){echo "Atendente";}elseif($fetch_user['nivel'] == 3){echo "Administrador";}else{echo "Não tem cargo!";};?></th>
				<th class="dados_acao">
					<div class="action">
						<div class="menu_action_baixo"></div>
						<span>Ações</span>
					</div>
					<div class="acao_menu">
						<form method="post">
							<input type="submit" name="reset_senha_<?=$fetch_user['id'];?>" value="Resetar senha">
							<input type="submit" name="inativar_<?=$fetch_user['id'];?>" value="<?php if($fetch_user['status']=='1'){echo 'Inativar';}else{echo 'Ativar';};?>">
						</form>
					</div>
				</th>
			</tr>
			<?php
			}while($fetch_user = $exibir_user->fetch(PDO::FETCH_ASSOC));
			}else{
				echo "<tr><th colspan='7' style='text-align: center;'>Não há nenhum Atendente/Administrador cadastrado, cadestre o primeiro!</td></tr>";
			};
			?>
		</tbody>
	</table>
</div>
	<div class="modal">
		<div class="title_modal">
			<span>Cadastro do Usuário</span>
			<div class="fechar_modal">X</div>
		</div>
		<form method="post" class="cadastro_modal">
			<input type="text" name="cad_user_login" placeholder="Usuário" maxlength="8">
			<input type="password" name="cad_user_senha" placeholder="Senha">
			<input type="text" name="cad_user_name" placeholder="Nome" maxlength="25">
			<input type="tel" id="telefone" name="cad_user_tel" placeholder="Telefone">
			<select name="cad_user_nivel">
				<option value="1">Nível 1</option>
				<option value="2">Nível 2</option>
				<option value="3">Nível 3</option>
			</select>
			<select name="cad_user_act">
				<option value="1">Ativo</option>
				<option value="2">Inativo</option>
			</select>
			<input class="button" type="submit" name="cad_user_button" value="Cadastrar">
		</form>
	</div>
<?php
	include('../insert/rodape.php');
?>