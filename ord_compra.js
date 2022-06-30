articulos = new Array();
function add_item(){

	tabla = document.getElementById("productos");
	let form = document.getElementById("add_item");
	let fields = form.children;
	let row = document.createElement("tr");
	let cant = document.createElement("td");
	let prod = document.createElement("td");
	let link = document.createElement("a");
	link.append("Borrar")
	link.onclick = function(){
		remove_item(row);
	}
	cant.append(fields.cant.value);
	prod.append(fields.producto.value);
	row.append(cant);
	row.append(prod);
	row.append(link);
	tabla.append(row);
	articulos.push(row);
	fields.cant.value = "";
	fields.producto.value = "";
}

function remove_item(item) {
	tabla.removeChild(item);
	articulos.splice(articulos.findIndex((element) => {element = item}),1);
	delete(item);
}

orden.onsubmit = async (e) => {
	e.preventDefault();
	const form = document.getElementById("orden");
	const formData = new FormData(form);
	art_items = new Array();
	art_cants = new Array();
	articulos.forEach(function(art){ 
		art_items.push(art.childNodes[1].innerHTML);
		art_cants.push(art.childNodes[0].innerHTML)
	});
	formData.append("productos", art_items);
	formData.append("cantidades", art_cants);
	const request = new XMLHttpRequest();
	request.open("POST", "orden_compra.php");
	request.send(formData);
}
