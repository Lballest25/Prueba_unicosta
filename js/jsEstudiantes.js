const consulta = () => {
    fetch("http://consultas.cuc.edu.co/api/v1.0/estudiantes", {
      method: "GET",
      headers: {
        "Content-Type": "application/json",
        Authorization:
          "JWT eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1c2VyX2lkIjo0LCJ1c2VybmFtZSI6InBydWViYTIwMjJAY3VjLmVkdS5jbyIsImV4cCI6MTY0OTQ1MzA1NCwiY29ycmVvIjoicHJ1ZWJhMjAyMkBjdWMuZWR1LmNvIn0.MAoFJE2SBgHvp9BS9fyBmb2gZzD0BHGPiyKoAo_uYAQ",
      },
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
document.body.onload = consulta();


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