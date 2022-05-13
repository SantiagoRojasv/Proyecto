 // JQUERY Consultar base de datos y mostrar en una tabla

 $("#table-tab").click(function () {
    submitConsulta();
 });

 $(document).ready(function () {
    $("#productoForm").submit(function (event) {
        //cancels the form submission
        console.log("entro");
        event.preventDefault();
        submitFormInsert();
    });
});

function submitFormInsert() {
    var descripcion = $("#descripcion").val();
    var comentario = $("#comentario").val();
    var object = {"descripcion": descripcion, "comentario": comentario };

    console.log(object);

    fetch('http://localhost/TestPHP2/server/business/ProductoInsert.php', {
         method: 'POST',
         headers: {
             'Content-Type': 'application/json'
        },
         body: JSON.stringify(object),
         cache: 'no-cache'
    })
        .then(function (response) {
          console.log("entró");
         return response.text();
    })
        .then(function (data) {
                 if (data === " 1") {
                     alert("Error al insertar");
              }
                 else {
                     alert("Producto registrado");
              }
         })
         .catch(function(err){
             console.error(err);
         });        
}



function submitConsulta() {
    console.log("Entró a llamar");
    fetch('http://localhost/TestPHP2/server/business/ProductoConsulta.php',{
        method: 'GET',
        headers: {
           'Content-Type' :  'application/json'
    }

    }). then(response => response.json())
            .then(result=>{
                if (result.length > 0) {
                    cargarDatos (result);
                } else {
                    console.log(JSON.stringify(result));
                }
            })
            .catch(error => console.log('error: ' + error));
}


function cargarDatos (data) {
    var rows = "";
    $("#dataTable tr").remove();
    $("#dataTable").append('<tr><td>Id</td>' +
        '<td>Descripción</td>' +
        '<td>Comentarios</td>' +
        '<td>Actualizar</td>' +
        '<td>Eliminar</td>' +
        "</tr>"
        );
    for (x in data) {
    rows +=`<tr row_id= ${data[x].idProducto}>`;

    var idDes="D"+data[x].idProducto;
    var idcomen="C"+data[x].idProducto;

    rows +=`<td>${data[x].idProducto}`
    rows +=`<td><id="${idDes}" value="${data[x].descripcion}" style="background-color:transparent; border:none;color: white;"></td>`
    rows +=`<td><input type="text" id="${idcomen}" value="${data[x].comentario}" style="background-color:transparent; border:none;color: white;"></td>`
    rows +=`<td> <button type='button' onclick='submitFormUpdate(${data[x].idProducto});' class='btn btn-info'>Actualizar</td>`
    rows +=`<td> <button type='button' onclick='submitFormDelete(${data[x].idProducto});' class='btn btn-danger'>Eliminar</td>`
    }
    $("#dataTable").append(rows);
}

function submitFormUpdate(idProducto) {
    idDes = "#D"+idProducto;
    idcomen = "#C"+idProducto;

    var descripcion = $(idDes).val();
    var comentario = $(idcomen).val();

    var object = {"descripcion": descripcion, "comentario": comentario, "idProducto":idProducto};

    console.log(object);
    fetch('http://localhost/TestPHP2/server/business/ProductoUpdate.php',{
        method: 'PUT',
        headers: {
           'Content-Type' :  'application/json'
        },
        body: JSON.stringify(object),
        cache: 'no-cache'
   })
       .then(function (response) {
         console.log("entró");
        return response.text();
   })
       .then(function (data) {
                if (data == " 1") {
                    formSucces("Error al actualizar");
             }
                else {
                    alert("Producto actualizado");
             }
        })
        .catch(function(err){
            console.error(err);
        });        
}

function submitFormDelete(idProducto) {
    console.log(idProducto);
    var object={"idProducto": idProducto};
    fetch('http://localhost/TestPHP2/server/business/ProductoDelete.php',{
        method: 'DELETE',
        headers: {
           'Content-Type' :  'application/json'
        },
        body: JSON.stringify(object),
        cache: 'no-cache'
   })
       .then(function (data) {
                if (data === "1") {
                    formSucces("Error al eliminar");
             }
                else {
                    alert("Producto eliminado");
             }submitConsulta();  
        })
        .catch(function(err){
            console.error(err);
        });    
        submitConsulta();    
}