const consulta = () => {
  const token = "";
    fetch("http://consultas.cuc.edu.co/api/v1.0/grupos", {
      method: "GET",
      headers: {
        "Content-Type": "application/json",
        Authorization:
          "JWT eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1c2VyX2lkIjo0LCJ1c2VybmFtZSI6InBydWViYTIwMjJAY3VjLmVkdS5jbyIsImV4cCI6MTY0OTQ1MzA1NCwiY29ycmVvIjoicHJ1ZWJhMjAyMkBjdWMuZWR1LmNvIn0.MAoFJE2SBgHvp9BS9fyBmb2gZzD0BHGPiyKoAo_uYAQ",
      }
    })
      .then(async (response) => {
        const resp = await response.json();
        console.log(resp);
      })
      .catch((ex) => {
        console.log("error");
        console.error(ex);
      });
  };

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