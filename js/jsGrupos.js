const consultaApi = () => {
  fetch("http://localhost/Prueba_unicosta/config/proxy.php")
    .then((response) => {
      return response.json();
    })
    .then((data) => {
      const datosParaInsertar = data.map((item) => {
        return {
          programa: item.programa,
          periodo: item.periodo,
          codigo: item.codigo,
          nombre: item.nombre,
          modalidad: item.modalidad,
        };
      });
      const url = `${servidor}/controlador/ejecucionConsultas.php?tipo_operacion=insertarGrupo`;
      const options = {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
        },
        body: JSON.stringify(datosParaInsertar),
      }; 
      fetch(url, options)
      .then((response) => {
        console.log(response);
      })
      .catch((error) => {
        console.error(error);
      });
    })
    .catch((ex) => {
      console.log("error");
      console.error(ex);
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