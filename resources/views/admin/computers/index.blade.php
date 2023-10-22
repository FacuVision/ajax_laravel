@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Menu de computadoras</h1>
    {{-- <meta name="csrf-token" content="{{ csrf_token() }}"> --}}

@stop

@section('content')


    {{-- ESTILO DE DATATABLE CDN --}}
    @include('admin.partials.css_datatables')
    {{-- ESTILO DE DATATABLE VANILA COMPACTO --}}
    @include('admin.styles.responsive_table')
    @include('admin.computers.styles.css_select_multiple_bootstrap')



    <p>
        Aqui puedes crear, editar y eliminar las computadoras
    </p>

    <div class="container-fluid">
        <div class="card">
            <div class="card-header">



                <!-- Botón para crear una computadora-->
                <button id="register_computer" class="btn btn-primary" data-toggle="modal" data-target="#modalExterno">Registrar
                    computadora</button>

            </div>
            <div class="card-body">
                <table id="tabla" class="table-striped display compact" style="width:100%">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>procesador</th>
                            <th>placa</th>
                            <th>case</th>
                            <th>grafica</th>
                            <th>ram</th>
                            <th>descripcion</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>

                </table>
            </div>
        </div>
    </div>

    {{-- ZONA DE MODALES --}}
    @include('admin.computers.modals.create_computer')
    @include('admin.computers.modals.edit_computer')

@stop


@section('js')

    {{-- JS DE DATATABLE CDN --}}
    @include('admin.partials.js_datatables')
    @include('admin.computers.styles.js_select_multiple_bootstrap')

    <script>
        $(document).ready(function() {

            $("#alerta-computer").hide();
            $("#alert_create_monitors").hide();

            //CARGAR LOS MONITORES AL INICIO Y AL PRESIONAR EL BOTON DE CREAR
            cargar_monitores_select_modal();

            $("#register_computer").click(function() {
                cargar_monitores_select_modal();
            })

            //CARGAR MONITORES EN EL SELECT MULTIPLE
            $('#select_monitors').select2({
                theme: "bootstrap-5",
                width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' :
                    'style',
                placeholder: $(this).data('placeholder'),
                closeOnSelect: false,
                allowClear: true,
            });

            //CARGAR MONITORES EN PARA LA EDICION
            $('#select_edit_monitors').select2({
                theme: "bootstrap-5",
                width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' :
                    'style',
                placeholder: $(this).data('placeholder'),
                closeOnSelect: false,
                allowClear: true,
            });


            //CARGAR MONITORES EN EL SELECT MULTIPLE CON AJAX Y METODO LOAD MONITORS
            function cargar_monitores_select_modal() {
                $.ajax({
                    type: 'GET',
                    url: '{{ route('admin.computers.load_monitors') }}',
                    success: function(response) {
                        // Manejar la respuesta del servidor (opcional)
                        //console.log(response);

                        var selectMonitors = $('#select_monitors');
                        selectMonitors.empty(); // Limpia cualquier opción previa
                        response.free_monitors.forEach(function(monitor) {
                            selectMonitors.append($('<option>', {
                                value: monitor.id,
                                text: monitor.cod_patrimonial + " " +
                                    monitor.marca + " " +
                                    monitor.modelo
                            }));
                        });

                    },


                    error: function(xhr) {
                        // Manejar errores (opcional)
                        console.error(xhr.responseText);
                    }
                });
            }





            //REGISTRAR UN NUEVO MONITOR DESDE EL MENU MODAL DE LAS COMPUTADORAS


            $('#form_create_monitor').on('submit', function(e) {
                e.preventDefault();
                let formData = $(this).serialize();

                $.ajax({
                    type: 'POST',
                    url: '{{ route('admin.computers.create_monitors') }}', // Reemplaza 'nombre_de_ruta' con la ruta de destino en tu aplicación
                    data: formData,
                    success: function(response) {
                        // Manejar la respuesta del servidor (opcional)
                        //console.log(response);

                        var selectMonitors = $('#select_monitors');
                        selectMonitors.empty(); // Limpia cualquier opción previa
                        response.free_monitors.forEach(function(monitor) {

                            //LLENAMOS EL ALERT CON EL VALOR
                            $("#cod_patrimonial_alert").text(monitor.cod_patrimonial)

                            selectMonitors.append($('<option>', {
                                value: monitor.id,
                                text: monitor.cod_patrimonial + " " +
                                    monitor.marca + " " +
                                    monitor.modelo
                            }));

                            //DURA 10 SEG Y SE OCULTA LA ALERTA
                            $("#alert_create_monitors").fadeTo(10000, 500).slideUp(500,
                                function() {
                                    $("#alert_create_monitors").slideUp(500);
                                });

                        });

                        limpiarCamposDeCreacion_create(); //ocultar modal de creacion
                        $("#alerta").hide(); //Ocultar el alert de errores en caso haya uno

                    },
                    error: function(xhr, status, error) {
                        if (xhr.status === 422) {
                            var errores = xhr.responseJSON.errors;
                            var listaErrores = $("#lista-errores");
                            listaErrores.empty(); // Limpiar errores anteriores

                            $.each(errores, function(index, error) {
                                listaErrores.append("<li>" + error + "</li>");
                            });

                            $("#alerta").show(); // Mostrar la alerta
                        }
                    }
                });

                //data_table.ajax.reload(); //recargar la tabla
            });



            $('#form_create_monitor_edit').on('submit', function(e) {
                e.preventDefault();
                let formData = $(this).serialize();

                $.ajax({
                    type: 'POST',
                    url: '{{ route('admin.computers.create_monitors') }}', // Reemplaza 'nombre_de_ruta' con la ruta de destino en tu aplicación
                    data: formData,
                    success: function(response) {
                        // Manejar la respuesta del servidor (opcional)
                        //console.log(response);

                        var selectMonitors = $('#select_edit_monitors');
                        selectMonitors.empty(); // Limpia cualquier opción previa
                        response.free_monitors.forEach(function(monitor) {

                            //LLENAMOS EL ALERT CON EL VALOR
                            $("#cod_patrimonial_alert_edit").text(monitor
                                .cod_patrimonial)

                            selectMonitors.append($('<option>', {
                                value: monitor.id,
                                text: monitor.cod_patrimonial + " " +
                                    monitor.marca + " " +
                                    monitor.modelo
                            }));

                            //DURA 10 SEG Y SE OCULTA LA ALERTA
                            $("#alert_create_monitors_edit").fadeTo(10000, 500).slideUp(
                                500,
                                function() {
                                    $("#alert_create_monitors_edit").slideUp(500);
                                });
                        });

                        limpiarCamposDeCreacion_edit(); //ocultar modal de creacion
                        $("#alerta_edit_monitors")
                    .hide(); //Ocultar el alert de errores en caso haya uno


                    },
                    error: function(xhr, status, error) {
                        if (xhr.status === 422) {
                            var errores = xhr.responseJSON.errors;
                            var listaErrores = $("#lista-errores-edit");
                            listaErrores.empty(); // Limpiar errores anteriores

                            $.each(errores, function(index, error) {
                                listaErrores.append("<li>" + error + "</li>");
                            });

                            $("#alerta_edit_monitors").show(); // Mostrar la alerta
                        }
                    }
                });

                //data_table.ajax.reload(); //recargar la tabla


            });

            function limpiarCamposDeCreacion_edit() {

                $("#marca_edit").val("");
                $("#modelo_edit").val("");
                $("#cod_patrimonial_edit").val("");
                $("#descripcion_edit").val("");
            }

            function limpiarCamposDeCreacion_create() {

                $("#marca").val("");
                $("#modelo").val("");
                $("#cod_patrimonial").val("");
                $("#descripcion").val("");
            }


            // $.ajaxSetup({
            //     headers: {
            //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            //     }
            // });


            //CARGAR DATATABLE

            var data_table = $('#tabla').DataTable({

                responsive: true,
                autowidth: false,
                pageLength: 25,

                language: {
                    "lengthMenu": "Mostrando _MENU_ registros por pagina",
                    "zeroRecords": "No hay registros, lo sentimos",
                    "info": "Mostrando _PAGE_ de _PAGES_",
                    "infoEmpty": "No hay datos",
                    "infoFiltered": "(Filtrado de _MAX_ registros)",
                    "search": "Buscar:",
                    'paginate': {
                        'next': 'Siguiente',
                        'previous': 'Anterior'
                    }
                },

                processing: true,
                serverSide: true,

                ajax: '{!! route('admin.computers.create') !!}',

                columns: [{
                        data: 'id',
                        mame: 'id'
                    },
                    {
                        data: 'procesador',
                        mame: 'procesador'
                    },
                    {
                        data: 'placa',
                        mame: 'placa'
                    },
                    {
                        data: 'case',
                        name: 'case'
                    },
                    {
                        data: 'grafica',
                        name: 'grafica'
                    },
                    {
                        data: 'ram',
                        name: 'ram'
                    },
                    {
                        data: 'descripcion',
                        name: 'descripcion'
                    },
                    {
                        data: 'acciones',
                        name: 'acciones',
                        orderable: false,
                        searchable: false
                    }
                ],

                order: [
                    [0, 'desc']
                ]

            });







            // ZONA DE ACCIONES CRUD ----------------------------------

            //AL PRESIONAR EL BOTON QUE ESTÁ FUERA DEL FORMULARIO, ESTE DISPARA EL SUBMIT DEL FORMULARIO
            $('#create_computer_button_submit_modal').click(function(e) {
                $('#form_create_computer').submit();
            });

            $('#edit_computer_button_submit_modal').click(function(e) {
                $('#form_edit_computer').submit();
            });






            $('#form_create_computer').on('submit', function(e) {

                $("#alerta-computer").hide();

                e.preventDefault();
                let formData = $(this).serialize();


                $.ajax({
                    type: 'POST',
                    url: '{{ route('admin.computers.store') }}', // Reemplaza 'nombre_de_ruta' con la ruta de destino en tu aplicación
                    data: formData,
                    success: function(response) {
                        // Manejar la respuesta del servidor (opcional)
                        //console.log(response);

                        //Al terminar la insercion, limpiar los campos y recargar el select con los monitores
                        //que aun no poseen una computadora asociada
                        cargar_monitores_select_modal();
                        limpiarCamposDeCreacionComputadora(); //ocultar modal de creacion
                        data_table.ajax.reload(); //recargar la tabla

                    },
                    error: function(xhr, status, error) {
                        if (xhr.status === 422) {

                            var errores = xhr.responseJSON.errors;
                            var listaErrores = $("#lista-errores-computer");
                            listaErrores.empty(); // Limpiar errores anteriores

                            $.each(errores, function(index, error) {
                                listaErrores.append("<li>" + error + "</li>");
                            });

                            $("#alerta-computer").show(); // Mostrar la alerta
                        }
                    }
                });


            });

            function limpiarCamposDeCreacionComputadora() {

                $("#case").val("");
                $("#procesador").val("");
                $("#placa").val("");
                $("#case").val("");
                $("#grafica").val("");
                $("#descripcion_computer").val("");
                $("#ram").val("");
                $('#select_monitors').val(null).trigger('change');

                // Selecciona el botón por su id
                var close_create_modal_computer = $('#close_create_modal_computer');
                // Programáticamente dispara un evento de clic en el botón
                close_create_modal_computer.trigger('click');
            }





            /**
             * LO QUE AQUI CARGA ES PRIMERO LA LISTA DE TODOS LOS MONITORES
             * DESPUES CARGA LA LISTA DE LOS MONITORES SELECCIONADOS, ES UN ARRAY UNIDIMENSIONAL ['0','1','2','3']
             *FINALMENTE CARGAMOS LA LISTA DE LOS MONITORES EN GENERAL, PERO SOLO LOS QUE ESTAN RELACIONADOS CON LA
              COMPUTADORA SELECCIONADA, ASI COMO TAMBIEN TRAE LA LISTA DE LOS MONNITORES QUE TIENEN UN computer_id EN NULO
              ES DECIR LOS MONITORES QUE NO HAN LLEGADO A RELACIONARSE CON UNA COMPUTADORA (LIBRES)
            */

            //EDITAR BOTON --------------------------------------------------------------------------
            $('body').on('click', '.editButton', function() {

                var id = $(this).data('id');
                $("#cod_patrimonial_header").text(id)

                $.ajax({
                    type: 'GET',
                    url: '{{ url('admin/computers', '') }}/' + id + '/edit',
                    success: function(response) {


                        var selectMonitors = $('#select_edit_monitors');
                        selectMonitors.empty(); // Limpia cualquier opción previa
                        response.free_monitors.forEach(function(monitor) {
                            selectMonitors.append($('<option>', {
                                value: monitor.id,
                                text: monitor.cod_patrimonial + " " +
                                    monitor.marca + " " +
                                    monitor.modelo
                            }));
                        });

                        //console.log(response.free_monitors);
                        // Manejar la respuesta del servidor (opcional)

                        //UNA VEZ QUE SE HAYA RECEPCIONADO EL MODELO POR AJAX, SE PROCEDE A LA ACTUALIZACION

                        $("#computer_id").val(id);
                        $("#procesador_edit").val(response.computer.procesador);
                        $("#placa_edit").val(response.computer.placa);
                        $("#case_edit").val(response.computer.case);
                        $("#grafica_edit").val(response.computer.grafica);
                        $("#ram_edit").val(response.computer.ram);
                        $("#descripcion_computer_edit").val(response.computer.descripcion);

                        // Configura el campo select2 múltiple con opciones seleccionadas
                        selectMonitors.val(response.selectedMonitors).trigger('change');

                        //PENDIENTE ENVIAR LA INFORMACION AL CONTROLADOR PARA HACER LA ACTUALIZACION
                    },
                    error: function(xhr) {
                        // Manejar errores (opcional)
                        console.error(xhr.responseText);
                    }
                });
            });

            //AJAX PARA ENVIAR TODO AL SERVIDOR Y HACER LA EDICION


                $('#form_edit_computer').on('submit', function(e) {

                e.preventDefault();
                let formData = $(this).serialize();

                let id = $("#computer_id").val();


                $.ajax({
                    type: 'PUT',
                    url: '{{ url('admin/computers', '') }}/' + id,
                    data: formData,
                    success: function(response) {
                        // Manejar la respuesta del servidor (opcional)
                        console.log(response);
                        data_table.ajax.reload(); //recargar la tabla
                    },
                    error: function(xhr) {
                        // Manejar errores (opcional)
                        console.error(xhr.responseText);
                    }
                });

                hideModalEdit(); //ocultar modal de edicion
            });

            function hideModalEdit() {

                    // Selecciona el botón por su id
                    var close_edit_modal_computer = $('#close_edit_modal_computer');
                    // Programáticamente dispara un evento de clic en el botón
                    close_edit_modal_computer.trigger('click');

            }









        });
    </script>
@stop
