$(document).ready(function(){



	$("#Envio").on("click", FuncaoTeste);

	function FuncaoTeste(){
		$(".modal-body").hide();
		$(".modal-title").hide();
		$(".modal-footer").hide();
		$("span").load("BLT-Web-DLTEmprestimos2.php", 
			$("#DLTemprestimo").serializeArray());
		$
	}


	$("#conf").on("click", FuncaoADCEmp);

	function FuncaoADCEmp(){
		$(".modal-body").hide();
		$(".modal-title").hide();
		$(".modal-footer").hide();
		$("span").load("BLT-Web-ADCEmprestimos.php", 
			$("#ADCEmpp").serializeArray());
		$
	}


	$('#IDAcervo').keyup(function(){

		$('form').submit(function(){
			var dados = $(this).serialize();


			$.ajax({

				url: 'processa.php',
				type: 'POST',
				dataType: 'html',
				data: dados,
				success: function(data){
					$('#Tab').empty().html(data);
				}
			});

			return false;
			
		});

		if ( $("#meuid").length ){
			$("#EnvioData").addClass('disabled');
		}else{
			$("#EnvioData").removeClass('disabled');
		}

		$('form').trigger('submit');

	});



});