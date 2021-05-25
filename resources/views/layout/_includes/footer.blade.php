
<script type="text/javascript">
  $(document).ready(function() {
    M.updateTextFields();
    
    $('.sidenav').sidenav();
	$('.valor').maskMoney();
	$('.numeral').maskMoney({
		precision:3, 
		decimal:",", 
		thousands:""
	});

	$('.tel').mask('(99) 9999-9999');
	$('.cel').mask('(99) 99999-9999');
	$('.cep').mask('99.999-999');
	$('.cnpj').mask('99.999.999/9999-99');
	$('.cpf').mask('999.999.999-99');

	$('#categoria_id').val("<?=isset($registro->categoria_id) ? $registro->categoria_id : ''?>");

	$('#unidade_id').val("<?=isset($registro->unidade_id) ? $registro->unidade_id : ''?>");
	
	$('select').formSelect();

	$( "#atualizar_produto" ).click(function() {
		if ($('#categoria_id').val() === '') {
			M.toast({html: 'Informe a categoria do produto!'});
		}
		else if ($('#unidade_id').val() === '') {
			M.toast({html: 'Informe a unidade do produto!'});
		}
		else if ($('#nome_produto').val() === '') {
			M.toast({html: 'Informe o nome do produto!'});
		}
		else if($('#descricao_produto').val() === ''){
			M.toast({html: 'Informe a descrição do produto!'});
		}
		else if($('#estoque').val() === ''){
			M.toast({html: 'Informe a quantidade do estoque!'});
		}
		else if($('#valor_bruto').val() === ''){
			M.toast({html: 'Informe o valor bruto do produto!'});
		}
		else if($('#valor_promocional').val() === ''){
			M.toast({html: 'Informe o valor promocional do produto!'});
		}
		else{
			if (confirm("Deseja realmente atualizar?")) {
				$('#form').append($('#valor_bruto').detach());
				$('#form').append($('#valor_promocional').detach());
				$('#form').append($('#estoque').detach());
				$('#form').append($('#imagem').detach());
				$('#form').append($('#publicado').detach());
				$('#form').submit();
			}
		}
    });

    $( ".deletar_produto" ).click(function() {
		if (confirm("Deseja realmente excluir?")) {
			var idproduto = $(this).attr('idproduto');       

			$.ajax({
				url: "/admin/produtos/deletar/"+idproduto,
				dataType: 'html',
				type: 'GET',
				error: function() {
					alert("Houve falha ao excluir o produto. Gentileza informar o Suporte.");
					window.location.reload();
				},
				success: function(ajaxResposta) {
					//alert(ajaxResposta);
				},
			});
			return true;
		}
    });

	$( "#salvar_produto" ).click(function() {
		if ($('#categoria_id').val() === '') {
			M.toast({html: 'Informe a categoria do produto!'});
		}
		else if ($('#nome_produto').val() === '') {
			M.toast({html: 'Informe o nome do produto!'});
		}
		else if($('#descricao_produto').val() === ''){
			M.toast({html: 'Informe a descrição do produto!'});
		}
		else if($('#estoque').val() === ''){
			M.toast({html: 'Informe a quantidade do estoque!'});
		}
		else if($('#valor_bruto').val() === ''){
			M.toast({html: 'Informe o valor bruto do produto!'});
		}
		else if($('#valor_promocional').val() === ''){
			M.toast({html: 'Informe o valor promocional do produto!'});
		}
		else{
			if (confirm("Deseja realmente salvar?")) {
				$('#form').append($('#valor_bruto').detach());
				$('#form').append($('#valor_promocional').detach());
				$('#form').append($('#estoque').detach());
				$('#form').append($('#imagem').detach());
				$('#form').submit();
				return true;
			}
		}
    });

	$( "#salvar_empresa" ).click(function() {
	    if ($('#fantasia').val() === '') {
	        M.toast({html: 'Informe o nome fantasia da empresa!'});
	   	}else if($('#razao_social').val() === ''){
	        M.toast({html: 'Informe a razão social da empresa!'});
	    }else if($('#endereco').val() === ''){
	        M.toast({html: 'Informe o endereço da empresa!'});
	    }else if($('#bairro').val() === ''){
	        M.toast({html: 'Informe o bairro!'});
	    }else if($('#cidade').val() === ''){
	        M.toast({html: 'Informe a cidade!'});
	    }else if($('#uf').val() === ''){
	        M.toast({html: 'Informe o estado!'});
	    }else if($('#pais').val() === ''){
	        M.toast({html: 'Informe o país!'});
	    }else if($('#cep').val() === ''){
	        M.toast({html: 'Informe o CEP!'});
	    }else if($('#cnpj_cpf').val() === ''){
	        M.toast({html: 'Informe o CNPJ ou CPF!'});
	    }
	    else{
	    	if (confirm("Deseja realmente salvar?")) {
		        $('#form').submit();
		        return true;
			}
	    }
	});

	$( ".tipopessoa" ).click(function() {
		var tipopessoa = $(this).attr('tipopessoa');

		if(tipopessoa == 'pj'){
			$("#cnpj_cpf").val("");
			$("#cnpj_cpf").removeClass("cpf");
			$("#cnpj_cpf").addClass("cnpj");
			$('.cnpj').mask('99.999.999/9999-99');
		}
		else{
			$("#cnpj_cpf").val("");
			$("#cnpj_cpf").removeClass("cnpj");
			$("#cnpj_cpf").addClass("cpf");
			$('.cpf').mask('999.999.999-99');
		}
    });

	$( "#triar_pedido" ).click(function() {
    	if (confirm("Deseja realmente enviar o pedido para triagem?")) {
	        $('#form').submit();
	        return true;
	    }
	});

	$( "#finalizar_pedido" ).click(function() {
    	if (confirm("Deseja realmente finalizar o pedido?")) {
	        $('#form').submit();
	        return true;
	    }
	});

	$( "#atualizar_conta" ).click(function() {
		if ($('#name').val() === '') {
			M.toast({html: 'Informe um nome!'});
		}
		else if($('#password').val() === ''){
			M.toast({html: 'Informe a senha atual para atualizar os dados!'});
		}
		else{
			if (confirm("Deseja realmente atualizar?")) {
				$('#form').append($('#name').detach());
				$('#form').append($('#password').detach());
				$('#form').append($('#new_password').detach());
				$('#form').submit();
			}
		}
    });

    <?php if (isset($registros[0]->error_atualizar_conta)): ?>
    	M.toast({html: '<?=$registros[0]->error_atualizar_conta?>'});
    <?php endif ?>




  });
</script>
</body>
</html>
