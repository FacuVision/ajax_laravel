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
                <table id="tabla" class="table-striped display compact table" style="width:100%">
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

@stop


@section('js')

    {{-- JS DE DATATABLE CDN --}}
    @include('admin.partials.js_datatables')

    @include('admin.computers.styles.js_select_multiple_bootstrap')

    <script>
        $(document).ready(function() {

            //CARGAR MONITORES EN EL SELECT MULTIPLE

            $('#select_monitors').select2({
                theme: "bootstrap-5",
                width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' :
                    'style',
                placeholder: $(this).data('placeholder'),
                closeOnSelect: false,
                allowClear: true,
            });


            //CARGAR MONITORES EN EL SELECT MULTIPLE CON AJAX Y METODO LOAD MONITORS

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

                        // Cierra cualquier alerta previamente abierta
                        //CERRAR ALERTAS
                        //$('#alert_monitor_create_modal').alert(); // Abre la alerta

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

                //data_table.ajax.reload(); //recargar la tabla
                hideModalMonitors(); //ocultar modal de creacion
            });


            function hideModalMonitors() {

                $("#marca").val("");
                $("#modelo").val("");
                $("#cod_patrimonial").val("");
                $("#descripcion").val("");

                var modal_close_create_monitors = $('#modal_close_create_monitors');
                modal_close_create_monitors.trigger('click');

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

            $('#form_create_computer').on('submit', function(e) {
                e.preventDefault();
                let formData = $(this).serialize();


                $.ajax({
                    type: 'POST',
                    url: '{{ route('admin.computers.store') }}', // Reemplaza 'nombre_de_ruta' con la ruta de destino en tu aplicación
                    data: formData,
                    success: function(response) {
                        // Manejar la respuesta del servidor (opcional)
                        console.log(response);
                    },
                    error: function(xhr) {
                        // Manejar errores (opcional)
                        console.error(xhr.responseText);
                    }
                });

                //data_table.ajax.reload(); //recargar la tabla
                //hideModal(); //ocultar modal de creacion
            });

            function hideModal() {
                // $("input").val("");
                // $("textarea").html("");

                var close_create_modal_computer = $('#close_create_modal_computer');
                close_create_modal_computer.trigger('click');

            }





        });
    </script>
@stop
