<?php

	//Procurando o usuario logado pelo Login
	session_start();
	$login = $_SESSION['login'];

	//Verificando se há login e senha, caso não tenha volta para a tela de login
	if((!isset($_SESSION['login']) == true)):
		unset($_SESSION['login']);
		unset($_SESSION['senha']);
		header('location: ../index.php');
	endif;

	//Dinamica do botão para desligar.
	if(isset($_POST['logout'])){
		unset($_SESSION['login']);
		header('location: ../index.php');
	};


	$sql_selecionar_usuario = "SELECT * FROM `users` WHERE `login` = '".$login."'";
	$exibir_usuario = $PDO->prepare($sql_selecionar_usuario);
	$exibir_usuario->execute();
	$fetch_usuario = $exibir_usuario->fetch(PDO::FETCH_ASSOC);

	//Procurando todos os Clientes cadastrados.
	$sql_selecionar_user = "SELECT * FROM `users` ORDER BY `status` ASC, `id` ASC";
	$exibir_user = $PDO->prepare($sql_selecionar_user);
	$exibir_user->execute();
	$fetch_user = $exibir_user->fetch(PDO::FETCH_ASSOC);

	//Criando botão dinamico para busca de despesas
	if(isset($_POST['consultar'])){
		$_SESSION['d_inicial'] = $_POST['data_inicial'];
		$_SESSION['d_final'] = $_POST['data_final'];
		header('location: busca_despesa.php');
	};
	//Criando botão dinamico para busca de receitas
	if(isset($_POST['consultar_receita'])){
		$_SESSION['d_inicial'] = $_POST['data_inicial'];
		$_SESSION['d_final'] = $_POST['data_final'];
		header('location: busca_receita.php');
	};
	//Criando botão dinamico para relatório de contas a pagar
	if(isset($_POST['contas_pagar'])){
		$_SESSION['d_inicial'] = $_POST['data_inicial'];
		$_SESSION['d_final'] = $_POST['data_final'];
		header('location: relatorio_pagar.php');
	};
	//Criando botão dinamico para relatório de contas pagas
	if(isset($_POST['contas_pagas'])){
		$_SESSION['d_inicial'] = $_POST['data_inicial'];
		$_SESSION['d_final'] = $_POST['data_final'];
		header('location: relatorio_pagos.php');
	};
	//Criando botão dinamico para alteração de dados dos usuarios
	if(isset($_POST['alt_dados'])){
		header('location: ../pags/alterar_dados.php');
	};

	//Função para Cadastrar Usuário sendo ele Administrador ou Atendente
	if(isset($_POST['cad_user_button'])){
		$login = $_POST['cad_user_login'];
		$senha = $_POST['cad_user_senha'];
		$name = $_POST['cad_user_name'];
		$telefone = $_POST['cad_user_tel'];
		$nivel = $_POST['cad_user_nivel'];
		$imagemuser = "padrao.png";
		$data_criacao = date('Y-m-d');
		$usuario_online = $_SESSION['login'];
		$situacao = $_POST['cad_user_act'];

		if(empty($login) || empty($senha) || empty($name) || empty($telefone)){
			echo "<script>alert('Faltou digitar um campo!')</script>";
		}else{
			$sql_cadastro = "INSERT INTO `users`(`login`, `password`, `name`, `telefone`, `nivel`, `userImg`, `status`, `date_creator`, `user_creator`) VALUES (:login, :senha, :nome, :telefone, :nivel, :imguser, :situacao, :data, :usuario_creador)";
			$cadastro = $PDO->prepare($sql_cadastro);
			$cadastro->bindValue(":login", $login);
			$cadastro->bindValue(":senha", $senha);
			$cadastro->bindValue(":nome", $name);
			$cadastro->bindValue(":telefone", $telefone);
			$cadastro->bindValue(":nivel", $nivel);
			$cadastro->bindValue(":imguser", $imagemuser);
			$cadastro->bindValue(":situacao", $situacao);
			$cadastro->bindValue(":data", $data_criacao);
			$cadastro->bindValue(":usuario_creador", $usuario_online);

			//Validando se há usuário repetido
			$validar = $PDO->prepare("SELECT * FROM users WHERE login = ?");
			$validar->execute(array($login));
			if($validar->rowCount() == 0){
				$cadastro->execute();
				echo "<script>alert('Cadastro realizado com sucesso!');</script>";
				echo "<script>location.href='user_privi.php';</script>";
			}else{
				echo "<script>alert('Cadastro duplicado, tente novamente com outro usuário.');</script>";
			};
		};
	};

	//Função para cadastro do lançamento de despesas
	if(isset($_POST['button_lancamento'])){
		$data = $_POST['date_lancamento'];
		$descricao = $_POST['description_lancamento'];
		$valor = str_replace(".", "", str_replace("R$", "", $_POST['value_lancamento']));
		$valor_final = str_replace(",", ".", $valor);
		$d_vencimento = $_POST['d_vencimento'];
		$f_pagamento = $_POST['f_pagamento'];
		$pago = "1";
		$observacao = $_POST['observation_lancamento'];
		$data_criacao = date('Y-m-d');
		$hora_criacao = date('H:i:s');
		$usuario_online = $_SESSION['login'];
		$situacao = "1";
		//$data_modificacao = date('Y-m-d');
		//$hora_modificacao = date('H:i:s');

		if(empty($data) || empty($descricao) || empty($valor)){
			echo "<script>alert('Faltou digitar um campo!')</script>";
		}else{
			$sql_cadastro = "INSERT INTO `despesas`(`date`, `descricao`, `valor`, `d_vencimento`, `obs`, `f_pagamento`, `pago`, `data_creater`, `hora_creator`, `user_creater`, `status`, `d_modifica`, `h_modifica`) VALUES (:data, :descricao, :valor, :d_vencimento, :obs, :f_pagamento, :pago, :data_creador, :hora_creador, :usuario_creador, :situacao, :data_modifica, :hora_modifica)";
			$cadastro = $PDO->prepare($sql_cadastro);
			$cadastro->bindValue(":data", $data);
			$cadastro->bindValue(":descricao", $descricao);
			$cadastro->bindValue(":valor", $valor_final);
			$cadastro->bindValue(":d_vencimento", $d_vencimento);
			$cadastro->bindValue(":obs", $observacao);
			$cadastro->bindValue(":f_pagamento", $f_pagamento);
			$cadastro->bindValue(":pago", $pago);
			$cadastro->bindValue(":data_creador", $data_criacao);
			$cadastro->bindValue(":hora_creador", $hora_criacao);
			$cadastro->bindValue(":usuario_creador", $usuario_online);
			$cadastro->bindValue(":situacao", $situacao);
			$cadastro->bindValue(":data_modifica", $data_criacao);
			$cadastro->bindValue(":hora_modifica", $hora_criacao);

			//Validando se há usuário repetido
			$cadastro->execute();
			//echo $valor." ".$valor_final;
			echo "<script>alert('Cadastro realizado com sucesso!');</script>";
			echo "<script>location.href='despesa.php';</script>";
		};
	};

	//Função para cadastro do lançamento de RECEITAS
	if(isset($_POST['button_receita'])){
		$data = $_POST['date_lancamento'];
		$descricao = $_POST['description_lancamento'];
		$valor = str_replace(".", "", str_replace("R$", "", $_POST['value_lancamento']));
		$valor_final = str_replace(",", ".", $valor);
		$observacao = $_POST['observation_lancamento'];
		$data_criacao = date('Y-m-d');
		$hora_criacao = date('H:i:s');
		$usuario_online = $_SESSION['login'];
		$situacao = "1";

		if(empty($data) || empty($descricao) || empty($valor)){
			echo "<script>alert('Faltou digitar um campo!')</script>";
		}else{
			$sql_cadastro = "INSERT INTO `receitas`(`date`, `descricao`, `valor`, `obs`, `data_creater`, `hora_creator`, `user_creater`, `status`, `d_modificacao`, `h_modificacao`) VALUES (:data, :descricao, :valor, :obs, :data_creador, :hora_creador, :usuario_creador, :situacao, :data_modificacao, :hora_modificacao)";
			$cadastro = $PDO->prepare($sql_cadastro);
			$cadastro->bindValue(":data", $data);
			$cadastro->bindValue(":descricao", $descricao);
			$cadastro->bindValue(":valor", $valor_final);
			$cadastro->bindValue(":obs", $observacao);
			$cadastro->bindValue(":data_creador", $data_criacao);
			$cadastro->bindValue(":hora_creador", $hora_criacao);
			$cadastro->bindValue(":usuario_creador", $usuario_online);
			$cadastro->bindValue(":situacao", $situacao);
			$cadastro->bindValue(":data_modificacao", $data_criacao);
			$cadastro->bindValue(":hora_modificacao", $hora_criacao);

			//Validando se há usuário repetido
			$cadastro->execute();
			echo "<script>alert('Cadastro realizado com sucesso!');</script>";
			echo "<script>location.href='receita.php';</script>";
		};
	};

	//Alterando imagem do perfil dos funcionarios
	if(isset($_POST['alt_image'])){
	
	// Recupera os dados dos campos
	$foto = $_FILES["imgUser"];
	
	// Se a foto estiver sido selecionada
	if (!empty($foto["name"])) {
    	// Verifica se o arquivo é uma imagem
    	if(!preg_match("/^image\/(pjpeg|jpeg|png|gif|bmp)$/", $foto["type"])){
     		echo "<script>alert('Isso não é uma imagem!');</script>";
			echo "<script>location.href='alterar_dados.php';</script>";
   	 	}else{
		
			// Pega extensão da imagem
			preg_match("/\.(gif|bmp|png|jpg|jpeg){1}$/i", $foto["name"], $ext);

        	// Gera um nome único para a imagem
        	$nome_imagem = $fetch_usuario['login']."_".date("dmYHis").".".$ext[1];

        	// Caminho de onde ficará a imagem
        	$caminho_imagem = "../assets/perfil/".$nome_imagem;

			// Faz o upload da imagem para seu respectivo caminho
			move_uploaded_file($foto["tmp_name"], $caminho_imagem);
		
			// Insere os dados no banco
			$sql = "UPDATE `users` SET `userImg`= :user_imagem WHERE `id`='".$fetch_usuario['id']."'";
			$alterar_image = $PDO->prepare($sql);
			$alterar_image->bindValue(":user_imagem", $nome_imagem);
			$alterar_image->execute();

			echo "<script>alert('Imagem alterada com sucesso!');</script>";
			echo "<script>location.href='alterar_dados.php';</script>";
		}
	}
	};

	//Modificando senha de usuario logado.
	if(isset($_POST['changePassword'])){
	$password_db = $fetch_usuario['password'];
	$old_password = $_POST['antigoPassword'];
	$new_password = $_POST['novoPassword'];
	$confirm_password = $_POST['confirmaPassword'];

	if($password_db === $old_password){
		if($new_password === $confirm_password){
			$sql = "UPDATE `users` SET `password`= :novo_password WHERE `id`='".$fetch_usuario['id']."'";
			$change = $PDO->prepare($sql);
			$change->bindValue(":novo_password", $new_password);
			$change->execute();

			echo "<script>alert('Senha alterada com sucesso, será solicitado um novo login!');</script>";
			unset($_SESSION['login']);
			unset($_SESSION['senha']);
			echo "<script>location.href='alterar_dados.php';</script>";
		}else{
			echo "<script>alert('Confirmação de senha divergente!');</script>";
			echo "<script>location.href='alterar_dados.php';</script>";
		}
	}else{
		echo "<script>alert('Senha antiga incorreta!');</script>";
		echo "<script>location.href='alterar_dados.php';</script>";
	}
	};

	//Cadastrando ordem de serviço
	if(isset($_POST['button_ordem'])){
		$n_os = date('YmdHis');
		$cliente = $_SESSION['login'];
		$equip = $_POST['equip_avaria'];
		$avaria = $_POST['problema'];
		$obs = $_POST['observacao_avaria'];
		$user = $_SESSION['login'];
		$data_criacao = date('Y-m-d');
		$hora_criacao = date('H:i:s');
		$status = "1";

		if(empty($equip)){
			echo "<script>alert('Você não digitou o campo EQUIPAMENTO!')</script>";
		}elseif(empty($avaria)){
			echo "<script>alert('Você não digitou o campo AVARIA!')</script>";
		}else{
			$sql = "INSERT INTO `ordemservico`(`numero_os`, `cliente`, `equipamento`, `avaria`, `observacao`, `user_created`, `date_created`, `hour_created`) VALUES (:n, :cl, :eq, :av, :obs, :user, :dc, :hc); INSERT INTO `os_atual`(`n_os`, `status`, `user_atual`, `date_atual`, `hour_atual`) VALUES (:n, :st, :user, :dc, :hc)";
			$cadastro = $PDO->prepare($sql);
			$cadastro->bindValue(":n", $n_os);
			$cadastro->bindValue(":cl", $cliente);
			$cadastro->bindValue(":eq", $equip);
			$cadastro->bindValue(":av", $avaria);
			$cadastro->bindValue(":obs", $obs);
			$cadastro->bindValue(":user", $user);
			$cadastro->bindValue(":dc", $data_criacao);
			$cadastro->bindValue(":hc", $hora_criacao);
			$cadastro->bindValue(":st", $status);
			
			//Verificando OS duplicada
			$validar = $PDO->prepare("SELECT * FROM ordemservico WHERE numero_os = ?");
			$validar->execute(array($n_os));
			if($validar->rowCount() == 0){
				$cadastro->execute();
				echo "<script>alert('Cadastro realizado com sucesso!');</script>";
				//echo "<script>location.href='ordem.php';</script>";
			}else{
				echo "<script>alert('Ordem de Serviço duplicada, por favor tente novamente!');</script>";
			};
		};
	};
?>