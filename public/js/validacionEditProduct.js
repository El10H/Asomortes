const formulario5 = document.getElementById('formedit');
const inputs2 = document.querySelectorAll('#formedit input');


//const formularioedit = document.getElementById('formularioedit');
//const inputsedit = document.querySelectorAll('#formulario input');

const expresiones2 = {
	usuario: /^[a-zA-Z0-9\_\-]{4,16}$/, // Letras, numeros, guion y guion_bajo
	nombre: /^[a-zA-ZÀ-ÿ\s]{3,40}$/, // Letras y espacios, pueden llevar acentos.
    color: /^[a-zA-ZÀ-ÿ\s]{1,40}$/, // Letras y espacios, pueden llevar acentos.
    material: /^[a-zA-ZÀ-ÿ0-9\_\-\.\s]{3,50}$/, // /^[a-zA-ZÀ-ÿ\s]{1,40}$/, // Letras, numeros, guion y guion_bajo
    stock: /^([0-9]{1,4})$/, // Letras y espacios, pueden llevar acentos
	valor: /^([0-9]{1,5}(\.[0-9]{1,2})?)$/, 
	descripcion: /^.{3,150}$/, 
	password: /^.{4,12}$/, // 4 a 12 digitos.
	correo: /^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/,
	telefono: /^\d{7,14}$/ // 7 a 14 numeros.
}

const campos2 = {
	nombre: false,
	color: false,
	material: false,
	stock: false,
	valor: false,
	descripcion: false
}




const validarFormulario2 = (e) => {
	var box = e.target.value;
	switch (e.target.name) {
		case "nombre":
			if(box != "") {
				validarCampo2(expresiones.nombre, e.target, 'nombre');
			}
			if(box === ""){	
				limpiarCampo2(e.target.name);
			}
		break;

		case "color":
			if(box != "") {
				validarCampo2(expresiones.color, e.target, 'color');
			}
			if(box === ""){	
				limpiarCampo2(e.target.name);
			}
		break;

        case "material":
			if(box != "") {
				validarCampo2(expresiones.material, e.target, 'material');
			}
			if(box === ""){	
				limpiarCampo2(e.target.name);
			}
		break;

        case "stock":
			if(box != "") {
				validarCampo2(expresiones.stock, e.target, 'stock');
			}
			if(box === ""){	
				limpiarCampo2(e.target.name);
			}
		break;	

		case "valor":
			if(box != "") {
				validarCampo2(expresiones.valor, e.target, 'valor');
			}
			if(box === ""){	
				limpiarCampo2(e.target.name);
			}
		break;

		case "descripcion":
			if(box != "") {
				validarCampo2(expresiones.descripcion, e.target, 'descripcion');
			}
			if(box === ""){	
				limpiarCampo2(e.target.name);
			}
		break;
	}
}

const validarCampo2 = (expresion, input, campo) => {
	if(expresion.test(input.value)){
		document.getElementById(`grupo__${campo}`).classList.remove('formulario__grupo-incorrecto');
		document.getElementById(`grupo__${campo}`).classList.add('formulario__grupo-correcto');
		document.querySelector(`#grupo__${campo} i`).classList.add('fa-check-circle');
		document.querySelector(`#grupo__${campo} i`).classList.remove('fa-times-circle');
		document.querySelector(`#grupo__${campo} .formulario__input-error`).classList.remove('formulario__input-error-activo');
		campos[campo] = true;
	} else {
		document.getElementById(`grupo__${campo}`).classList.add('formulario__grupo-incorrecto');
		document.getElementById(`grupo__${campo}`).classList.remove('formulario__grupo-correcto');
		document.querySelector(`#grupo__${campo} i`).classList.add('fa-times-circle');
		document.querySelector(`#grupo__${campo} i`).classList.remove('fa-check-circle');
		document.querySelector(`#grupo__${campo} .formulario__input-error`).classList.add('formulario__input-error-activo');
		campos[campo] = false;	
	}
}

const limpiarCampo2 = (campo) => {
		document.getElementById(`grupo__${campo}`).classList.remove('formulario__grupo-incorrecto');
		document.getElementById(`grupo__${campo}`).classList.remove('formulario__grupo-correcto');
		document.querySelector(`#grupo__${campo} i`).classList.remove('fa-times-circle');
		document.querySelector(`#grupo__${campo} i`).classList.remove('fa-check-circle');
		document.querySelector(`#grupo__${campo} .formulario__input-error`).classList.remove('formulario__input-error-activo');
		campos[campo] = false;
}


inputs2.forEach((input) => {
	input.addEventListener('keyup', validarFormulario2);
	input.addEventListener('blur', validarFormulario2);
});


formulario5.addEventListener('submit', (e) => {
	//e.preventDefault();

	//const terminos = document.getElementById('terminos');
	if(campos.nombre === false || campos.color === false || campos.material === false || campos.stock === false || campos.valor === false || campos.descripcion === false ){
		e.preventDefault();
		document.getElementById('formulario__mensaje').classList.add('formulario__mensaje-activo');
	}
});

formulario5.addEventListener('reset', (e) => {
	limpiarCampo2("nombre");
	limpiarCampo2("color");
	limpiarCampo2("material");
	limpiarCampo2("stock");
	limpiarCampo2("valor");
	limpiarCampo2("descripcion");
});