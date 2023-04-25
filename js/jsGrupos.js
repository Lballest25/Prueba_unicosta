const consultaApi = () => {
  const url = `${servidor}/config/guardarGrupos.php`;
  fetch(url, {
    method: 'get'
})
.then(data => data.json())
.then(data => {
    console.log(data);
    pintar_tabla_grupos(data);
})
.catch(function (error) {
    console.log('error', error);
});
}

  const cargarDatosGrupo = () => {
    const url = `${servidor}/controlador/ejecucionConsultas.php?tipo_operacion=seleccionarGrupos`;
    fetch(url, {
        method: 'get'
    })
    .then(data => data.json())
    .then(data => {
        console.log(data);
        pintar_tabla_grupos(data);
    })
    .catch(function (error) {
        console.log('error', error);
    });
  }

document.body.onload = cargarDatosGrupo();

const pintar_tabla_grupos = (datos) => {
    let tab_datos = document.querySelector("#tablaGrupos");
    for (let item of datos) {
        tab_datos.innerHTML +=`
        <tr>
        <td>${item.programa}</td>
        <td>${item.periodo}</td>
        <td>${item.codigo}</td>
        <td>${item.nombre}</td>
        <td>${item.modalidad}</td>
        </tr>
        `;
    }
}