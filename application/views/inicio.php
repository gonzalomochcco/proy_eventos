<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Eventos</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="<?php echo base_url('assets/notiflix/notiflix-2.7.0.min.css'); ?>" rel="stylesheet" type="text/css" />

</head>

<body>


    <?php $this->load->view('layouts/nav'); ?>


    <div class="container mt-5">

        <div class="d-flex justify-content-between align-items-center mb-5">
            <div>
                <h4 class="mb-4">Listado de eventos</h4>
            </div>
            <div>
                <button type="button" onclick="agregar_evento()" class="btn btn-success" tabindex="-1" role="button"
                    aria-disabled="true" data-bs-toggle="modal" data-bs-target="#modal_crear_evento">
                    <i class='bx bx-plus-circle'></i>
                    Agregar Nuevo Evento
                </button>
            </div>
        </div>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Titulo</th>
                    <th scope="col">Descipción</th>
                    <th scope="col">Fecha Inicio</th>
                    <th scope="col">Opciones</th>
                </tr>
            </thead>
            <tbody id="table_eventos">

            </tbody>

        </table>

    </div>

    <!-- Modal Crear Evento-->
    <div class="modal fade" id="modal_crear_evento" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5">Agregar Nuevo Evento</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <form action="<?= site_url('index.php/eventos/crear_evento') ?>" id="form_crear_eventos"
                    class="form-floating">
                    <div class="modal-body p-4">

                        <div class="mb-3">
                            <label class="form-label">Titulo</label>
                            <input type="text" name="titulo" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Descripción</label>
                            <textarea class="form-control" name="descripcion" rows="3"></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Fecha Inicio</label>
                            <input type="datetime-local" name="fecha_inicio" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Fecha Fin</label>
                            <input type="datetime-local" name="fecha_fin" class="form-control">
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button type="submit" id="btn-crear-evento" class="btn btn-primary">Crear Evento</button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <!-- Modal Editar Evento-->
    <div class="modal fade" id="modal_editar_evento" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5">Editar Evento</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <form action="<?= site_url('index.php/eventos/editar_evento') ?>" id="form_editar_eventos"
                    class="form-floating">
                    <div class="modal-body p-4">
                        <input type="hidden" name="id" id="id_modal_editar">
                        <div class="mb-3">
                            <label class="form-label">Titulo</label>
                            <input type="text" require name="titulo" id="titulo_modal_editar" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Descripción</label>
                            <textarea class="form-control" require name="descripcion" id="descripcion_modal_editar" rows="3"></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Fecha Inicio</label>
                            <input type="datetime-local" require name="fecha_inicio" id="fechainicio_modal_editar" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Fecha Fin</label>
                            <input type="datetime-local" require name="fecha_fin" id="fechafin_modal_editar" class="form-control">
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" id="btn-editar-evento" class="btn btn-primary">Editar Evento</button>
                    </div>
                </form>

            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <script src="<?php echo base_url('assets/jquery/jquery-3.3.1.min.js'); ?>" type="text/javascript"></script>
    <script src="<?php echo base_url('assets/notiflix/notiflix-2.7.0.min.js'); ?>" type="text/javascript"></script>
    <script src="<?php echo base_url('assets/js/eventos.js'); ?>" type="text/javascript"></script>


</body>

</html>
