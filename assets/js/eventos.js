$(document).ready(function () {
	listarEventos();

	Notiflix.Notify.Init({
		fontSize: "16px",
	});
});

function agregar_evento() {
	$("#form_crear_eventos")[0].reset();
}

$("#form_crear_eventos").submit(function (e) {
	e.preventDefault();
	var ruta = $(this).attr("action");
	const datos = $(this).serialize();

	$.ajax({
		url: ruta,
		type: "POST",
		headers: {
			"X-Requested-With": "XMLHttpRequest",
		},
		dataType: "json",
		data: datos,
		beforeSend: function () {
			$("#btn-crear-evento").prop("disabled", true);
		},
		success: function (res) {
			if (res.response === "success") {
				listarEventos();
				Notiflix.Report.Success("Registro Éxitoso", res.mensaje, "Continuar");
				$("#form_crear_eventos")[0].reset();
			} else if (res.response === "warning") {
				Notiflix.Notify.Warning(res.mensaje);
			} else {
				Notiflix.Notify.Failure(res.error);
			}
		},
		complete: function () {
			$("#btn-crear-evento").prop("disabled", false);
		},
		error: function (error) {
			console.log(error);
			Notiflix.Notify.Failure(
				"Ocurrio un error inesperado, por favor vuelva a intentarlo"
			);
		},
	});
});

function listarEventos() {
	$.ajax({
		url: "http://localhost/proy_eventos/index.php/eventos/lista_eventos",
		type: "POST",
		headers: {
			"X-Requested-With": "XMLHttpRequest",
		},
		dataType: "JSON",
		beforeSend: function () {
			$("#table_eventos").html("");
		},
		success: function (res) {
			if (res.response === "success") {
				res.eventos.forEach((el, key) => {
					let tr = `
                        <tr>
                            <th scope="row"> ${key + 1} </th>
                            <td> ${el.titulo} </td>
                            <td> ${el.descripcion} </td>
                            <td> ${el.fecha_inicio} </td>
                            <td> ${el.fecha_fin} </td>
                            <td>
                                <div class="d-grid gap-2 d-md-flex justify-content-md-end me-3">
                                    <button type="button" onclick="borrar_evento(${el.id})" class="btn btn-sm btn-danger">
                                        <i class='bx bx-trash'></i>
                                    </button>
                                    <button type="button" id="${el.id}" titulo="${el.titulo}" descripcion="${el.descripcion}" 
                                        fechainicio="${el.fecha_inicio}" fechafin="${el.fecha_fin}" onclick="editar_evento(event)" class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#modal_editar_evento">
                                        <i class='bx bx-edit' ></i>
                                    </button>
                                </div>

                            </td>
                        </tr>
                    `;

					$("#table_eventos").append(tr);
				});
			} else {
				Notiflix.Notify.Failure(res.error);
			}
		},
		error: function (error) {
			console.log(error);
			Notiflix.Notify.Failure(
				"Ocurrio un error inesperado, por favor vuelva a intentarlo"
			);
		},
	});
}

function borrar_evento(id) {
   
	Notiflix.Confirm.Show(
		"Advertencia",
		"Esta seguro de borrar el evento?",
		"Si, estoy seguro",
		"No, cancelar",
		function okCb() {
			
            $.ajax({
                url: "http://localhost/proy_eventos/index.php/eventos/borrar_evento",
                type: "POST",
                headers: {
                    "X-Requested-With": "XMLHttpRequest",
                },
                dataType: "JSON",
                data: { 'id' : id },
                beforeSend: function () {
                    $("#table_eventos").html("");
                },
                success: function (res) {
                    if (res.response === "success") {
                        Notiflix.Notify.Success(res.mensaje);
                        listarEventos();
                    } else {
                        Notiflix.Notify.Failure(res.error);
                    }
                },
                error: function (error) {
                    console.log(error);
                    Notiflix.Notify.Failure(
                        "Ocurrio un error inesperado, por favor vuelva a intentarlo"
                    );
                },
            });

		},
	);

	
}

function editar_evento(e){

   const id = e.currentTarget.getAttribute('id');
   const titulo = e.currentTarget.getAttribute('titulo');
   const descripcion = e.currentTarget.getAttribute('descripcion');
   const fechainicio = e.currentTarget.getAttribute('fechainicio');
   const fechafin = e.currentTarget.getAttribute('fechafin');

   $("#id_modal_editar").val(id);
   $("#titulo_modal_editar").val(titulo);
   $("#descripcion_modal_editar").val(descripcion);
   $("#fechainicio_modal_editar").val(fechainicio);
   $("#fechafin_modal_editar").val(fechafin);
   
}


$("#form_editar_eventos").submit(function (e) {
    
	e.preventDefault();
	var ruta = $(this).attr("action");
	const datos = $(this).serialize();

	$.ajax({
		url: ruta,
		type: "POST",
		headers: {
			"X-Requested-With": "XMLHttpRequest",
		},
		dataType: "json",
		data: datos,
		beforeSend: function () {
			$("#btn-editar-evento").prop("disabled", true);
		},
		success: function (res) {

			if (res.response === "success") {

				listarEventos();
				Notiflix.Report.Success("Actualización éxitosa", res.mensaje, "Continuar");
				
			} else if (res.response === "warning") {

				Notiflix.Notify.Warning(res.mensaje);

			} else {

				Notiflix.Notify.Failure(res.error);
                
			}
		},
		complete: function () {
			$("#btn-editar-evento").prop("disabled", false);
		},
		error: function (error) {
			console.log(error);
			Notiflix.Notify.Failure(
				"Ocurrio un error inesperado, por favor vuelva a intentarlo"
			);
		},
	});
});