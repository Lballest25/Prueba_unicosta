const cargarDatosGruEstudiantes = () => {
    const url = `${servidor}/controlador/ejecucionConsultas.php?tipo_operacion=seleccionarTodo`;
    fetch(url, {
        method: 'get'
    })
    .then(data => data.json())
    .then(data => {
        pintar_tabla_todo(data);
        console.log(data);
    })
    .catch(function (error) {
        console.log('error', error);
    });
}

document.body.onload = cargarDatosGruEstudiantes();

const pintar_tabla_todo = (datos) => {
    let tab_datos = document.querySelector("#tablaTodo");
    for (let item of datos) {
        tab_datos.innerHTML +=`
        <tr>
        <td>${item.programa}</td>
        <td>${item.periodo}</td>
        <td>${item.codigo}</td>
        <td>${item.nombre}</td>
        <td>${item.modalidad}</td>
        <td>${item.curso}</td>
        <td>${item.identificacion}</td>
        <td>${item.nombres}</td>
        <td>${item.apellidos}</td>
        <td>${item.correo}</td>
        </tr>
        `;
    }
}