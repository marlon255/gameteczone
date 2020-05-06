<?php
	include('../insert/topo.php');
	include('../insert/menu.php');
	include('../insert/corpo.php');
?>
<div class="lista_dados">
	<div class="top_lista_dados">
		<span>Clientes</span>
		<div id="cadastro_dados">Cadastrar</div>
	</div>
	<table class="table_dados">
		<thead>
			<tr>
				<th class="dados_matricula">Matrícula</th>
				<th>Nome</th>
				<th class="dados_telefone">Telefone</th>
				<th class="dados_situacao">Situação</th>
				<th class="dados_acao">Opções</th>
			</tr>
		</thead>
		<tbody>
			<?php 
			if($fetch_cliente > 0){
			do{
				if(isset($_POST['reset_senha_cliente_'.$fetch_cliente['id']])):
				$nova_senha = "1234";

				$sql_reset_pass = "UPDATE `users` SET `password`=:new_senha WHERE id='".$fetch_cliente['id']."'";
				$reset_pass = $PDO->prepare($sql_reset_pass);
				$reset_pass->bindValue(":new_senha", $nova_senha);
				$reset_pass->execute();
				echo "<script>alert('Sua senha foi resetada!')</script>";
				echo "<script>location.href='cliente.php';</script>";
				endif;

				if(isset($_POST['inativar_cliente_'.$fetch_cliente['id']])):
					if($_POST['inativar_cliente_'.$fetch_cliente['id']]=="Inativar"){
						$situacao = "2";
					}else{
						$situacao = "1";
					};
				$sql_situacao = "UPDATE `users` SET `situacao`=:situacao_user WHERE id='".$fetch_cliente['id']."'";
				$situacao_cliente = $PDO->prepare($sql_situacao);
				$situacao_cliente->bindValue(":situacao_user", $situacao);
				$situacao_cliente->execute();
				echo "<script>alert('Usuário alterado com sucesso!')</script>";
				echo "<script>location.href='cliente.php';</script>";
				endif;
			?>
			<tr>
				<th class="dados_matricula"><?php echo $fetch_cliente['id'];?></th>
				<th><?php echo $fetch_cliente['name'];?></th>
				<th class="dados_telefone"><?php echo $fetch_cliente['telefone'];?></th>
				<th class="dados_situacao"><?php if($fetch_cliente['situacao']=="1"){echo "Ativo";}else{echo "Inativo";};?></th>
				<th class="dados_acao">
					<div class="action">
						<div class="menu_action_baixo"></div>
						<span>Ações</span>
					</div>
					<div class="acao_menu">
						<form method="post">
							<input type="submit" name="reset_senha_cliente_<?=$fetch_cliente['id'];?>" value="Resetar senha">
							<input type="submit" name="inativar_cliente_<?=$fetch_cliente['id'];?>" value="<?php if($fetch_cliente['situacao']=='1'){echo 'Inativar';}else{echo 'Ativar';};?>">
						</form>
					</div>
				</th>
			</tr>
			<?php
			}while($fetch_cliente = $exibir_cliente->fetch(PDO::FETCH_ASSOC));
			}else{
				echo "<tr><th colspan='5' style='text-align: center;'>Não há nenhum cliente cadastrado, cadestre o primeiro!</td></tr>";
			};
			?>
		</tbody>
	</table>
</div>
	<div class="modal">
		<div class="title_modal">
			<span>Cadastro de cliente</span>
			<div class="fechar_modal">X</div>
		</div>
		<form method="post" class="cadastro_modal">
			<input type="text" name="cad_cliente_login" placeholder="Usuário">
			<input type="password" name="cad_cliente_senha" placeholder="Senha">
			<input type="text" name="cad_cliente_name" placeholder="Nome">
			<input type="tel" id="telefone" name="cad_cliente_tel" placeholder="Telefone" maxlength="15">
			<select name="cad_cliente_act">
				<option value="1">Ativo</option>
				<option value="2">Inativo</option>
			</select>
			<input type="submit" name="cad_cliente_button" value="Cadastrar">
		</form>
	</div>
<?php
	include('../insert/rodape.php');
?>