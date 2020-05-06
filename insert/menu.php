<div class="menu">
	<div class="topo_menu">
		<a href="../painel/index.php"><div class="logo_menu"></div></a>
	</div>
	<?php if($fetch_usuario['nivel'] == 3):
	?>
	<div class="menu_button" tabindex="-1"><span>Cadastro</span>
		<div class="menu_dropdown">
			<a href="../pags/user_privi.php"><div><span>Usúario</span></div></a>
		</div>
	</div>
	<?php
	endif;
	?>
	<div class="menu_button" tabindex="-1"><span>Lançamento</span>
		<div class="menu_dropdown">
			<a href="../pags/despesa.php"><div><span>Despesas</span></div></a>
			<?php
				if($fetch_usuario['nivel'] == 3):
			?>
			<a href="../pags/receita.php"><div><span>Receita</span></div></a>
			<?php
				endif;
			?>
			<?php
				if($fetch_usuario['nivel'] == 2 or $fetch_usuario['nivel'] == 3):
			?>
			<a href="../pags/ordem.php"><div><span>Ordem de Serviço</span></div></a>
			<?php
				endif;
			?>
		</div>
	</div>
	<div class="menu_button" tabindex="-1"><span>Consulta</span>
		<div class="menu_dropdown">
			<a href="../pags/consulta_despesa.php"><div><span>Despesas</span></div></a>
			<?php
				if($fetch_usuario['nivel'] == 3):
			?>
			<a href="../pags/consulta_receita.php"><div><span>Receita</span></div></a>
			<?php
				endif;
			?>
			<?php
				if($fetch_usuario['nivel'] == 2 or $fetch_usuario['nivel'] == 3):
			?>
			<a href="../pags/cons_ordem.php"><div><span>Ordem de Serviço</span></div></a>
			<?php
				endif;
			?>
		</div>
	</div>
	<div class="menu_button" tabindex="-1"><span>Relatórios</span>
		<div class="menu_dropdown">
			<?php
				if($fetch_usuario['nivel'] == 3 OR $fetch_usuario['nivel'] == 2):
			?>
			<a href="../pags/contas_pagar.php"><div><span>Contas a Pagar</span></div></a>
			<?php
				endif;
			?>
			<a href="../pags/contas_pagas.php"><div><span>Contas Pagas</span></div></a>
		</div>
	</div>
</div>
