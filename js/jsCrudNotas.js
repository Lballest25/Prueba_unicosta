const cargarDatosCrudNotas = () => {
    const url = `${servidor}/controlador/ejecucionConsultas.php?tipo_operacion=obtenerNotas`;
    fetch(url, {
        method: 'get'
    })
    .then(data => data.json())
    .then(data => {
        console.log(data);
        pintar_tabla_CrudNotas(data);
    })
    .catch(function (error) {
        console.log('error', error);
    });
  }

document.body.onload = cargarDatosCrudNotas();

const pintar_tabla_CrudNotas = (datos) => {
    let tab_datos = document.querySelector("#tablaCrudNotas");
    for (let item of datos) {
        tab_datos.innerHTML +=`
        <tr>
        <td>${item.estudiante_identificacion}</td>
        <td>${item.nota1}</td>
        <td>${item.nota2}</td>
        <td>${item.nota3}</td>
        <td><button onclick="editar(${item.estudiante_identificacion})">Editar</button></td>
        </tr>
        `;
    }
}

const form = document.querySelector("#form");
form.addEventListener("submit", (e) =>{
    e.preventDefault();
    const datos = new FormData(document.getElementById('form'));
    const url = `${servidor}/controlador/ejecucionConsultas.php?tipo_operacion=insertarNotas`;
    fetch(url, {
        method:'post',
        body:datos
    })
    .then (data => data.json())
    .then (data => {
        console.log(data);
        if (data != 0) {
            document.getElementById('tablaCrudNotas').innerHTML = "";
            pintar_tabla_CrudNotas(data);
            form.reset();
            }
    })
    .catch(function(error){
        console.log('error', error);
    });
});

const editar = (id) => {
    const url = `${servidor}/controlador/ejecucionConsultas.php?tipo_operacion=editarNotas`;
    var formData = new FormData();
    formData.append('id',id);
    fetch(url,{
        method:'post',
        body:formData
    })
    .then(data => data.json())
    .then(data => {
        for (const iterator of data) {
            $("#contenedorFormCrear").hide();
            $("#contenedorFormActualizar").removeAttr("hidden");
            $("#identificacionA").val(id);
            $("#nota1A").val(iterator.nota1);
            $("#nota2A").val(iterator.nota2);
            $("#nota3A").val(iterator.nota3);
        }
    })
    .catch(function (error){
        console.error('error',error);
    }); 
}

const actualizar = () => {
    let datos_actualizar = new FormData(document.querySelector("#formActualizar"));
    const url = `${servidor}/controlador/ejecucionConsultas.php?tipo_operacion=actualizarNotas`;
    fetch(url, {
        method: 'post',
        body: datos_actualizar
    })
    .then(data => data.json())
    .then(data =>{ 
        pintar_tabla_CrudNotas(data);
        console.log(data);
    })
    .catch(function(error){
        console.error('Error:', error);
    });
}