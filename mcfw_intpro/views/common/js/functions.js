// JavaScript Document

var validate = {
	"registrar":function(){
		var password = document.getElementById("password");
		var repassword = document.getElementById("re-password");
		if(password.value != repassword.value){
			alert("La contraseña no coincide");
			return false;
		}
		/*var a=document.reg.nombre.value;
		var b=document.reg.apelli1.value;
		var c=document.reg.apelli2.value;
		var d=document.reg.fecha.value;
		var e=document.reg.nick.value;
		var f=document.reg.pass1.value;
		var g=document.reg.pass2.value;
		var h=document.reg.fac.value;
		var i=document.reg.grupo.value;
		var j=document.reg.anno.value;
		var k=document.reg.esp.value;

		if (a=="")
		{
			alert("Falta su Nombre");
		}
		else if (b=="")
		{
			alert("Falta su primer Apellido");
		}
		else if (c=="")
		{
			alert("Falta su segundo Apellido");
		}
		else if (d=="")
		{
			alert("Falta su fecha de nacimiento");
		}
		else if (e=="")
		{
			alert("Falta su seudónimo");
		}
		else if (f=="")
		{
			alert("Falta su contraseña");
		}
		else if (g!=f)
		{
			alert("Sus contraseñas no coinciden");
		}
		else if (h=="")
		{
			alert("Seleccione su Facultad");
		}
		else if (i=="")
		{
			alert("Falta su Grupo");
		}
		else if (j=="")
		{
			alert("Seleccione su Año");
		}
		else if (k=="Seleccione")
		{
			alert("Seleccione su Especialidad"); 
			return false; 
		} 
		else 
		{
			document.reg.submit();  
		}*/
		return true;
	},
	"buscar": function(){
		var $busc=document.form14.ObjBusc.value;
		if ($busc=="")  
		{
		 alert("Introduzca termino busqueda");  
		}
		else
		{
		document.form14.submit();
		}
	},
	"publicar": function(){
		document.publicform.submit();
	}

}

var send = function(formid){
	var form = document.getElementById(formid);
	form.setAttribute('action', form.action+"?_do="+formid);
	form.submit();
}

var onsubmiting = function(id){
	if(typeof(validate[id])=="function") {
		var t = validate[id]();
		if(t == true) {
			send(id);
		}
	}else send(id);
}
