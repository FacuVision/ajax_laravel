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

    @include('admin.computers.styles.select_multiple_bootstrap')


<!-- Styles -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
<!-- Or for RTL support -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.rtl.min.css" />



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


    <!-- Scripts -->
    {{-- <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.0/dist/jquery.slim.min.js"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        $(document).ready(function() {

            $('#select_monitors').select2({
                theme: "bootstrap-5",
                width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' :
                    'style',
                placeholder: $(this).data('placeholder'),
                closeOnSelect: false,
                allowClear: true,
            });


            $.ajax({
                type: 'GET',
                url: '{{ route('admin.computers.load_monitors') }}',
                success: function(response) {
                    // Manejar la respuesta del servidor (opcional)
                    console.log(response);

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


            // $.ajaxSetup({
            //     headers: {
            //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            //     }
            // });

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


            // ZONA DE ACCIONES CRUD

            $('#create_computer_button_submit_modal').click(function(e) {
                $('#form_create_computer').submit();
            });

            // $('#register_computer').click(function(e) {



            // });


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
