jQuery(document).ready(function () {

	//Deixando o Login da tela inicial em Focus
	jQuery("#login").focus();

	//Dinamica do Menu do usuario
	var uls = jQuery('.menu_user');

	jQuery('#menu_user_drop').click(function( e ){
		e.stopPropagation();
		jQuery( this ).siblings(uls).slideToggle("slow");
	});
	jQuery('body').click(function(){
		uls.slideUp("slow");
	});
	//Dinamica do Menu global
	var dropdown_menu = function(){
		var $this = jQuery(this);
		$this.find(".menu_dropdown").slideToggle("slow");
		$this.siblings("div").find(".menu_dropdown").hide("slow");
	};
	jQuery(".menu_button").click(dropdown_menu);
	//Modal
	var modal = function(){
		jQuery(".fundo_modal").slideToggle("slow");
		jQuery(".modal").slideToggle("slow");
	};
	jQuery("#cadastro_dados").click(modal);
	jQuery(".fechar_modal").click(modal);

	//Clickando no Action
	jQuery(".action").click(function(e){
		e.stopPropagation();
		jQuery(this).siblings().slideToggle("slow");
	});
	jQuery('body').click(function(){
		jQuery('.acao_menu').slideUp("slow");
	});

	//Mascara para telefone
	jQuery('input[type=tel]').mask("(99) 99999-9999");

	//Mascara para dinheiro
	$("#money1").maskMoney({prefix:'R$', decimal:",", thousands:"."});

	//Consultando via ajax itens do banco de dados para mostrar em tela nas consultas.
	/*$("#consultar").click(function(){
		var data_inicial = $("#date_start").val();
		var data_final = $("#date_end").val();
		$("#dados_consultados").css("display","block");
		$("#carregando").html("<img src='../assets/img/loader.gif' alt='Enviando' />");
		$.post("buscar.php" , {data_inicial: data_inicial, data_final: data_final}, function(resposta){
			// Limpa a mensagem de carregamento
			$("#carregando").empty();
			// Coloca as frases na DIV
			$("#dados_consultados").html(resposta);
		});
	});*/
});