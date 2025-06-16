var mais = document.createElement("a");

mais.className = "itens-left text-purple-500 text-xs";
mais.onclick = verMais;
var paragrafo = document.getElementById("paragrafo");
var content = document.getElementById("content");
var texto = paragrafo.textContent;

if (paragrafo.textContent.length > 100) {
	content.appendChild(mais);
	mais.innerHTML = "Ver mais";
	paragrafo.innerText = texto.substring(0, 100) + "...";
	console.log("maior que 100");
}

function verMais() {
	if (mais.textContent === "Ver menos") {
		mais.innerHTML = "Ver mais";
		paragrafo.innerText = texto.substring(0, 100) + "...";
	} else {
		mais.innerHTML = "Ver menos";
		paragrafo.innerText = texto;
	}
}
