var btnLogar = document.querySelector("#logar");
var btnCadastrar = document.querySelector("#cadastrar");
var body = document.querySelector("body");

btnLogar.addEventListener("click", function () {
	body.className = "logar-js"
})

btnCadastrar.addEventListener("click", function () {
	body.className = "cadastrar-js"
});

function validar() {
	var numeros = /([0-9])/;
	var alfabeto = /([a-zA-Z])/;
	var minúscula = /([a-z])/;
	var maiúscula = /([A-Z])/;

	if ($('#password').val().length < 6 && $('#password').val().match(alfabeto)) {
		$('#password-status').html("<span style='color:red; padding: 6px 20px;'>Insira no mínimo 6 caracteres!</span>");

	} else {
		if (!$('#password').val().match(numeros)) {
			$('#password-status').html("<span style='color:red; padding: 6px 20px;'>Fraca, insira pelo menos um número!</span>");
		}

		if ($('#password').val().match(numeros)) {
			$('#password-status').html("<span style='color:red; padding: 6px 20px;'>Fraca, insira pelo menos uma letra minúscula!</span>");
		}

		if ($('#password').val().match(minúscula) && $('#password').val().match(numeros)) {
			$('#password-status').html("<span style='color:#EEAD2D; padding: 6px 20px;'>Médio, insira pelo menos uma letra maiúscula!</span>");
		}

		if ($('#password').val().length > 6 && $('#password').val().match(numeros) && $('#password').val().match(minúscula) && $('#password').val().match(maiúscula)) {
			$('#password-status').html("<span style='color:green; padding: 6px 20px;'>Senha forte!</span>");
		}
	}
}

var inputdata = document.querySelector('#input');
function validarCPF(event) {
	var x = event.keyCode;
	if (x == 96 || x == 97 || x == 98 || x == 99 || x == 100 || x == 101 || x == 102 || x == 103 || x == 104 || x == 105 || x == 48 || x == 49 || x == 50 || x == 51 || x == 52 || x == 53 || x == 54 || x == 55 || x == 56 || x == 57) {
		if (x != 8) {
			inputdata.maxLength = "14";
			if (inputdata.value.length == 3 || inputdata.value.length == 7) {
				inputdata.value += '.';
			}
			if (inputdata.value.length == 11) {
				inputdata.value += '-';

			}
		}
	} else {
		if (inputdata.value.length < 14) {
			setTimeout(() => {
				inputdata.value = inputdata.value.substr(0, inputdata.value.length - 1);
			}, 10)
		}
	}

}