const consultaApi = () => {
  const url = `${servidor}/config/guardarEstudiantes.php`;
  fetch(url, {
    method: 'POST',
})
.then(data => data.json())
.then(data => {
    console.log(data);
    pintar_tabla_estudiantes(data);
})
.catch(function (error) {
    console.log('error', error);
});
}


  const cargarDatosEstudiantes = () => {
    const url = `${servidor}/controlador/ejecucionConsultas.php?tipo_operacion=seleccionarEstudiantes`;
    fetch(url, {
        method: 'get'
    })
    .then(data => data.json())
    .then(data => {
        console.log(data);
        pintar_tabla_estudiantes(data);
    })
    .catch(function (error) {
        console.log('error', error);
    });
  }
document.body.onload = cargarDatosEstudiantes();

const pintar_tabla_estudiantes = (datos) => {
    let tab_datos = document.querySelector("#tablaEstudiantes");
    for (let item of datos) {
        tab_datos.innerHTML +=`
        <tr>
        <td>${item.curso}</td>
        <td>${item.identificacion}</td>
        <td>${item.nombres}</td>
        <td>${item.apellidos}</td>
        <td>${item.correo}</td>
        </tr>
        `;
    }
}