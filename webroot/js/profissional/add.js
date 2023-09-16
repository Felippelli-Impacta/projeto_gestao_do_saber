$(function () {

	$('#cpf').mask('999.999.999-99');
	$('#rg').mask('99.999.AAA-AA');
	$('.telefone').mask('(00)9999-99999');

	$('#user-username').keyup(function () {
		var login = $(this).val();
		$.post(APP + '/users/disponivel', {
			login: login
		}, function (data) {
			if (data == true) {
				$('#user_ok').show();
				$('#user_no').hide();

				$('#btn-submit').attr('disabled', false);
			} else {
				$('#user_no').show();
				$('#user_ok').hide();
				$('#btn-submit').attr('disabled', true);

			}
		}, 'json');
	});
})
function CPF(strCPF) {
	var Soma;
	var Resto;
	Soma = 0;
	if (strCPF == "00000000000")
		return false;
	for (i = 1; i <= 9; i++)
		Soma = Soma + parseInt(strCPF.substring(i - 1, i)) * (11 - i);
	Resto = (Soma * 10) % 11;
	if ((Resto == 10) || (Resto == 11))
		Resto = 0;
	if (Resto != parseInt(strCPF.substring(9, 10)))
		return false;
	Soma = 0;
	for (i = 1; i <= 10; i++)
		Soma = Soma + parseInt(strCPF.substring(i - 1, i)) * (12 - i);
	Resto = (Soma * 10) % 11;
	if ((Resto == 10) || (Resto == 11))
		Resto = 0;
	if (Resto != parseInt(strCPF.substring(10, 11)))
		return false;
	return true;
}

function check_form() {
	
	if (!CPF($('#cpf').val().replace('.','').replace('.','').replace('-',''))) {
		alert("Informe um cpf válido!");
		$('#cpf').focus();
		return false;
	}
	return true;
}