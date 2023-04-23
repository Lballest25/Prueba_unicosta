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
        <td><button>Editar</button></td>
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
                pintar_tabla_CrudNotas(data);
                form.reset();
            }
    })
    .catch(function(error){
        console.log('error', error);
    });
});