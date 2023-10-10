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

    <p>
        Aqui puedes crear, editar y eliminar las computadoras
    </p>

    <div class="container-fluid">
        <div class="card">
            <div class="card-header">



                <!-- Botón para crear una computadora-->
                <button class="btn btn-primary" data-toggle="modal" data-target="#modalExterno">Registrar
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


    <script>
        $(document).ready(function() {


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

            var multipleCancelButton = new Choices('#select_monitors', {
                removeItemButton: true,
                //maxItemCount: 1,
                searchResultLimit: 15,
                renderChoiceLimit: 15
            });


            // ZONA DE ACCIONES CRUD

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
