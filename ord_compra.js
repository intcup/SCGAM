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
		remove_item(link.parentNode);
	}
	cant.append(fields.cant.value);
	prod.append(fields.producto.value);
	row.append(cant);
	row.append(prod);
	row.append(link);
	tabla.append(row);
	fields.cant.value = "1";
	fields.producto.value = "";
}

function remove_item(item) {
	tabla.removeChild(item);
}

orden.onsubmit = async (e) => {
	e.preventDefault();
	const form = document.getElementById("orden");
	const formData = new FormData(form);
	let art_items = new Array();
	let art_cants = new Array();
	for(i of tabla.children){
		art_cants.push(i.children[0].innerHTML);
		art_items.push(i.children[1].innerHTML);
	}
	formData.append("productos", art_items);
	formData.append("cantidades", art_cants);
	const request = new XMLHttpRequest();
	request.open("POST", "orden_compra.php");
	request.send(formData);
}
