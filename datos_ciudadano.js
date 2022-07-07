
function get_datos(){

	let formData = new FormData();
	let id = document.getElementById('ciudadano').value;
	formData.append("id", id);
	const request = new XMLHttpRequest();
	request.open("POST", "datos_ciudadano.php");
	request.onload = function(){
		let datos = JSON.parse(request.response);
		let dat = document.getElementById("datos_c");
		if (datos) {
			dat.innerHTML = "";
			let nom = document.createElement("p");
			let nom_l = document.createElement("b");
			nom_l.append("Nombre: ");
			nom.append(nom_l);
			nom.append(datos.nombre + " " + datos.ap_pat + " " + datos.ap_mat);

			// Domicilio
			let dom = document.createElement("p");
			let dom_l = document.createElement("b");
			dom_l.append("Domicilio: ");
			dom.append(dom_l);
			dom.append(datos.domicilio);

			dat.append(nom);
			dat.append(dom);
			
			document.getElementById("enviar").disabled = false;
		} else {
			dat.innerHTML = "No se ha encontrado el ciudadano <br><a href='registrar.php?id=" + id + "'>Registrar</a>";
			document.getElementById("enviar").disabled = true;
		}
	}
	request.send(formData);

}