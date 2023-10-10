// Creamos el DOM
document.addEventListener("DOMContentLoaded", function () {
    loadComponentes(); 
	setMarca();
	document.getElementById("btnExecUpdate").addEventListener('click', execUpdate);
	document.getElementById("btnInsert").addEventListener("click",execInsert);

});

// Nada mas entrar en la pagina se cargara todos lo componentes en una tabla con botones y a esos botones 
// les daremos un evento de click (loadComponentes())

function loadComponentes(){

    var url= "/controller/controller_getComponentes.php";
	
	fetch(url)
	
	.then(res => res.json()).then(result => {
		
   		var componente = result.componentes;
   		
   		console.log(result.componentes);
   		
   		var newRow ="<br/><h2>COMPONENTES</h2><br/>";
		newRow +="<table border='1'> ";
		newRow +="<th>img_componentes</th><th>TIPO</th><th>STOCK</th><th>precio</th><th>ID_MARCA</th><th>Nombre_Marca</th></tr>";
   		
		for (let i=0;i<componente.length;i++)
		{
			newRow += "<tr>" 
			+"<td class='celda_imagen'><img style='width: 200px;' src='"+componente[i].img_componentes+"'></td>"
			+"<td>"+componente[i].tipo+"</td>"
         	+"<td>"+componente[i].stock+"</td>"
		 	+"<td>"+componente[i].precio+"</td>"
		 	+"<td>"+componente[i].id_marca+"</td>"
         	+"<td>"+componente[i].objMarca.nombre+"</td>"
			+ "<td><button class='btnDelete' value='" + componente[i].id_componentes + "'>DELETE</button></td>"
			+ "<td><button class='btnUpdate' value='" + componente[i].id_componentes + "'>UPDATE</button></td>"
			+"</tr>";
		}
   		newRow +="</table>";   // Cliente aldean geratzen da bakarrik/ solo se queda en el DOM del cliente
   		
   		
   		document.getElementById("container_c").innerHTML=newRow; // add the new row to the container
		var buttonsDelete = document.getElementsByClassName('btnDelete');
		var buttonsUpdate = document.getElementsByClassName('btnUpdate');
		

		for (let i = 0; i < buttonsDelete.length; i++) {

			buttonsDelete[i].addEventListener('click', execDelete);
			buttonsUpdate[i].addEventListener('click', showUpdate);
			
		}
		
	
	})
	.catch(error => console.error('Error status:', error));	


}
// Nada mas iniciar la pagina se cargara una tabla con las marcas setMarca()
function setMarca(){
	var url= "/controller/controller_getMarca.php";
	
	fetch(url)
	
	.then(res => res.json()).then(result => {
		
   		var marca = result.marca;
   		
   		console.log(result.marca);
   		
   		var newRow ="<h4>Marka</h4>";
		newRow +="<table border='1'> ";
		newRow +="<tr><th>ID_marca</th><th>Izena</th></tr>";
   		
		for (let i=0;i<marca.length;i++)
		{
			newRow += "<tr>" +"<td>"+marca[i].id_marca+"</td>"
			+"<td>"+marca[i].nombre+"</td>"
			+"</tr>";
		}
   		newRow +="</table>";   // Cliente aldean geratzen da bakarrik/ solo se queda en el DOM del cliente
   		
   		
   		document.getElementById("container_m").innerHTML=newRow; // add the new row to the container
	
	})
	.catch(error => console.error('Error status:', error));	
}

// Con esta funcion haremos que el boton que creamos en loadComponentes (DELETE) funcione para borrar componentes 
function execDelete(){
    var id_componentes=event.currentTarget.value; 
    console.log(id_componentes)

	var url = "/controller/controller_deleteComponentes.php";
	
	var miData = { 'id_componentes': id_componentes };
	
    miData = JSON.stringify(miData);
	fetch(url, {
	  method: 'POST', 
	  body: miData, // data can be `string` or {object}!
	  headers:{'Content-Type': 'application/json'}  //input data
	  })
	  
	.then(res => res.json()).then(result => {
			  	
		console.log(result.error);
		alert(result.error);
		loadComponentes();
	})
	.catch(error => console.error('Error status:', error));
}

// Esta funcion sirve para en ver un formulario donde te va a dejar modificar el componente para eso le pasamos la id
function showUpdate(){
    document.getElementById("update").style.display = "block";
	var id_componentes = event.currentTarget.value;
	
	console.log(id_componentes);
	
	document.getElementById("idComponente").value = id_componentes;

	
	var url = "/controller/controller_showupdate.php";
	
	var data = { 'id_componentes':id_componentes};
	console.log(data)
    console.log(JSON.stringify(data))

	fetch(url, {
	  method: 'POST', 
	  body: JSON.stringify(data), // data can be `string` or {object}!
	  headers:{'Content-Type': 'application/json'}  //input data
	  })
	  
	.then(res => res.json()).then(result => {
			  	
		console.log(result.error);
		alert(result.error);
		document.getElementById("imgC").value = result.error[0].img_componentes;
		document.getElementById("tipo").value = result.error[0].tipo;
        document.getElementById("stock").value = result.error[0].stock;
		document.getElementById("precio").value = result.error[0].precio;
		document.getElementById("idMarca").value = result.error[0].id_marca;
		loadComponentes();
		//location.reload();  //recarga la pagina
	})
	.catch(error => console.error('Error status:', error));
}

// Esta funcion se activara cuando el usurio de click al boton con la id btnExecUpdate, lo que hara es realizar una actualizacion 
// en el componente seleccionado. Esta funcion va de la mano con la funcion showUpdate()
function execUpdate() {

	var id_componentes = document.getElementById("idComponente").value;
	var id_marca = document.getElementById("idMarca").value;
	var img_componentes = document.getElementById("imgC").value;
	var tipo = document.getElementById("tipo").value;
	var stock = document.getElementById("stock").value;
	var precio = document.getElementById("precio").value;
		
	var url = "/controller/controller_update.php";
	
	var data = { 'id_componentes':id_componentes, 'id_marca':id_marca, 'img_componentes':img_componentes, 'tipo':tipo, 'stock':stock, 'precio':precio};
	console.log(data)

	fetch(url, {
	  method: 'POST', 
	  body: JSON.stringify(data), // data can be `string` or {object}!
	  headers:{'Content-Type': 'application/json'}  //input data
	  })
	  
	.then(res => res.json())
	.then(result => {
	
       		console.log(result.error);
			alert(result.error);
			loadComponentes();

			
	})
	.catch(error => console.error('Error status:', error));	
	
	

};//end execUpdate*/

// Con esta funcion podremos insertar componentes nuevos
function execInsert(){
	
	
	var id_marca=document.getElementById("idM").value;
	var tipo=document.getElementById("type").value;
	var stock=document.getElementById("cantidad").value;
	var img_componentes=document.getElementById("image_c").value;
	var precio=document.getElementById("price").value;

	console.log(tipo);
     
	var url = "/controller/controller_insert_componentes.php";
	var data = { 'id_marca':id_marca, 'img_componentes':img_componentes,'tipo':tipo,'stock':stock,'precio':precio };

	fetch(url, {
	  method: 'POST', // or 'POST'
	  body: JSON.stringify(data), // data can be `string` or {object}!
	  headers:{'Content-Type': 'application/json'}  //input data
	  })
	.then(res => res.json()).then(result => {
	
       		console.log(result.error);
       		alert(result.error);
       		loadComponentes();
       		
       		document.getElementById("idM").value="";
       		document.getElementById("type").value="";
       		document.getElementById("cantidad").value="";
			document.getElementById("image_c").value="";
			document.getElementById("price").value="";
       		
	})
	.catch(error => console.error('Error status:', error));	
	
};