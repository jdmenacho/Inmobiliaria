	//agregamos los eventtos para que al hace click en los radios del formulario ejecuten la funcion mostrarCampoContrasena
document.getElementById('opcionsi').addEventListener('click',mostrarCampoContrasena);
document.getElementById('opcionno').addEventListener('click',mostrarCampoContrasena);

	// cogemos los div donde van a ir los campos de contraseña y verificacion contraseña
		var divContrasena=document.getElementById('divContrasena');
		var divVerificacionContrasena=document.getElementById('divVerificacionContrasena');

	//creamos los nodos de label para etiquetar los campos de contraseña y verificar contraseña	
		var labelContrasena=document.createElement('label');
		var labelVerificacionContrasena=document.createElement('label');

	//creamos los nodos de los campos de contraseña y verificacion de contraseña
		var campoContrasena=document.createElement('input');
		var campoVerificacionContrasena=document.createElement('input');

	function mostrarCampoContrasena(){



		if(this.value==1){		

			//esta parte se ejecuta si la opcion elegida es SI en el formulario, es decir 1.

			labelContrasena.innerHTML="Contraseña";
			labelVerificacionContrasena.innerHTML="Verifique su contraseña";

			//creamos los atributos del campo contraseña
			campoContrasena.setAttribute("type", "password");
			campoContrasena.setAttribute("name", "contrasena");
			campoContrasena.setAttribute("class", "form-control");
			campoContrasena.setAttribute("id", "pass");
			campoContrasena.setAttribute("placeholder", "Escriba su contraseña");
			campoContrasena.setAttribute("required", "true");

			//creamos los atributos del campo verificacion de contraseña
			campoVerificacionContrasena.setAttribute("type", "password");
			campoVerificacionContrasena.setAttribute("name", "contrasena2");
			campoVerificacionContrasena.setAttribute("class", "form-control");
			campoVerificacionContrasena.setAttribute("id", "passVerification");
			campoVerificacionContrasena.setAttribute("placeholder", "Verifique su contraseña");
			campoVerificacionContrasena.setAttribute("required","true");

			//agregamos nodos al div padre
			divContrasena.appendChild(labelContrasena);
			divContrasena.appendChild(campoContrasena);
			divVerificacionContrasena.appendChild(labelVerificacionContrasena);
			divVerificacionContrasena.appendChild(campoVerificacionContrasena);
		}
		else
		{
			//esta parte se ejecuta si la opcion elegida en el formulario es NO, es decir valor 0.
			//eliminamos los nodos creado con anterioridad.
			labelContrasena.parentNode.removeChild(labelContrasena);
			labelVerificacionContrasena.parentNode.removeChild(labelVerificacionContrasena);
			campoContrasena.parentNode.removeChild(campoContrasena);
			campoVerificacionContrasena.parentNode.removeChild(campoVerificacionContrasena);
		}
	}