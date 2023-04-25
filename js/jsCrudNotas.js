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
        <td>${item.identificacion}</td>
        <td>${item.nota1}</td>
        <td>${item.nota2}</td>
        <td>${item.nota3}</td>
        <td><button onclick="calcularNotaFinal(${item.nota1}, ${item.nota2}, ${item.nota3})">Calcular</button></td>
        <td><button onclick="notaFaltante(${item.nota1}, ${item.nota2}, ${item.nota3})">Calcular</button></td>
        <td><button onclick="editar(${item.identificacion})">Editar</button></td>
        <td><button onclick="crear(${item.identificacion})">Crear</button></td>
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
        method:'POST',
        body:datos
    })
    .then (data => data.json())
    .then (data => {
        console.log(data);
        if (data != 0) {
            console.log(data);
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
        method:'get',
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
        method: 'get',
        body: datos_actualizar
    })
    .then(data => data.json())
    .then(data =>{ 
        pintar_tabla_CrudNotas(data);
        console.log(data);
        $("#contenedorFormCrear").show();
        $("#contenedorFormActualizar").hide();
    })
    .catch(function(error){
        console.error('Error:', error);
    });
}

const calcularNotaFinal = (nota1, nota2, nota3) => {
    let nota_final = (parseFloat(nota1)*0.3 + parseFloat(nota2)*0.3 + parseFloat(nota3)*0.4);
    Swal.fire({
        title: 'Tu nota final es de:'+nota_final.toFixed(1),
        showClass: {
          popup: 'animate__animated animate__fadeInDown'
        },
        hideClass: {
          popup: 'animate__animated animate__fadeOutUp'
        }
      })
  }

const notaFaltante = (nota1, nota2, nota3) => {
    const notaParcial = nota1 * 0.3 + nota2 * 0.3 + nota3 * 0.4;
    const puntosFaltantes = 3.0 - notaParcial;
    const notaFaltante = puntosFaltantes / 0.4;
    const notaFaltanteRedondeada = notaFaltante.toFixed(2);
    if (notaParcial < 3) {
        Swal.fire({
            title: 'La nota faltante es de:'+notaFaltanteRedondeada,
            showClass: {
              popup: 'animate__animated animate__fadeInDown'
            },
            hideClass: {
              popup: 'animate__animated animate__fadeOutUp'
            }
          })
    } else {
        Swal.fire({
            title: 'Aprobaste!',
            showClass: {
              popup: 'animate__animated animate__fadeInDown'
            },
            hideClass: {
              popup: 'animate__animated animate__fadeOutUp'
            }
          })
    }
}

const crear = (id) => {
    $("#identificacion").val(id);
    $("#contenedorFormCrear").show();
    $("#contenedorFormActualizar").hide();
} 