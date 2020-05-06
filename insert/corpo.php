<div class="corpo">
	<div class="header">
		<div class="user_info" id="menu_user_drop" tabindex="-1">
			<div class="img_user"><img src="../assets/perfil/<?=$fetch_usuario['userImg'];?>"></div>
			<div class="name_user"><?php echo $fetch_usuario['name'];?></div>
			<div class="menu_user_baixo"></div>
		</div>
			<div class="menu_user">
				<form method="post">
					<div><input type="submit" name="alt_dados" value="Alterar Dados"></div>
					<div><input type="submit" name="logout" value="Sair"></div>
				</form>
			</div>
	</div>
	<div class="container">