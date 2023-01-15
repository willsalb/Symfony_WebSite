/* Chamando a funcão somente quando a página for carregada */
window.addEventListener('load', () => {
	FormSubmit();
})


/* Tratará do envio do formulário contact_us e processará o resultado */
function FormSubmit() {

	//Obtendo o formário
	const form = document.querySelector('#contactUsModal form');

	form.addEventListener('submit', (event) => {
		//Cancelar o evento e vitar o envio de um formlário
		event.preventDefault();

		sendData(form);
	})
}

function sendData(form) {
	const xml = new XMLHttpRequest();
	const formData = new FormData(form);

	xml.addEventListener('load', () => {
		//Se o status HTTP for igual a 200 = conexão bem-sucedida
		/*
		if(xml.status = 200) {
			return
		}
		O novo conteúdo sempre será renderizado assim que for recebido do servidor
		*/
		//Obtendo a resposta que conterá no HTML do widget
		const newHTML = xml.response;
		const divElement = document.createElement('div');
		divElement.innerHTML = newHTML;
		//Encontrando um container para o formulário
		const newModalBody = divElement.querySelector('#contactUsModal .modal-body');
		const oldModalBody = document.querySelector('#contactUsModal .modal-body');

		if(newModalBody) {
			oldModalBody.innerHTML = newModalBody.innerHTML;
		} else {
			//Qualquer mensagem de error ira ser renderizada em uma pagina HTML
			document.querySelector('#contactUsModal .modal-body').innerHTML = 'An error has occurred. Please try again';
		}

		//Substituindo o HTML, o Listener é removido e deve ser reatribuído
		FormSubmit();
	})

	xml.addEventListener('error', () => {
		//Container do formlário para escrever uma mensagem de erro.
		document.querySelector('#contactUsModal .modal-body').innerHTML = 'An error has occurred. Please try again';
	})

	//Enviando a solicitação POST para a URL com o atributo de formlário "action"
	xml.open('POST', form.getAttribute('action'));
	xml.send(formData);
}