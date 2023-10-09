@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Menu de computadoras</h1>
@stop

@section('content')

    {{-- ESTILO DE DATATABLE CDN --}}
    @include('admin.partials.css_datatables')
    {{-- ESTILO DE DATATABLE VANILA COMPACTO --}}
    @include('admin.styles.responsive_table')


    <p>
        Aqui puedes crear, editar y eliminar las computadoras
    </p>

    <div class="container-fluid">
        <div class="card">
            <div class="card-header">

                <!-- Button trigger modal -->
                {{-- <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#create_computer">
                    Launch
                </button> --}}

                <button class="btn btn-primary" data-toggle="modal" data-target="#create_computer">Abrir Modal Externo</button>


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

    <div class="container mt-5">
        <!-- Modal Externo -->
        <div class="modal fade" id="modalExterno" tabindex="-1" role="dialog" aria-labelledby="modalExternoLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalExternoLabel">Modal Externo</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- Formulario POST en el Modal Externo -->
                        <form action="procesar_externo.php" method="post">
                            <div class="container-fluid">
                                <div class="form-group">
                                    <label for="procesador">Procesador</label>
                                    <input type="text" class="form-control" id="procesador" placeholder="Procesador">
                                </div>
                                <div class="form-group">
                                    <label for="placa">Placa</label>
                                    <input type="text" class="form-control" id="placa" placeholder="Placa">
                                </div>
                                <div class="form-group">
                                    <label for="case">Case</label>
                                    <input type="text" class="form-control" id="case" placeholder="Case">
                                </div>
                                <div class="form-group">
                                    <label for="grafica">Tarjeta Gráfica</label>
                                    <input type="text" class="form-control" id="grafica" placeholder="Tarjeta Gráfica">
                                </div>
                                <div class="form-group">
                                    <label for="ram">RAM</label>
                                    <input type="text" class="form-control" id="ram" placeholder="RAM">
                                </div>
                                <div class="form-group">
                                    <label for="descripcion">Descripción</label>
                                    <textarea class="form-control" id="descripcion" rows="3" placeholder="Descripción"></textarea>
                                </div>
                                <div class="form-group">

                                    <label for="opciones">Opciones</label>
                                    <select class="form-control" id="opciones">
                                        <option value="opcion1">Opción 1</option>
                                        <option value="opcion2">Opción 2</option>
                                        <option value="opcion3">Opción 3</option>
                                    </select>



                                </div>

                            </div>
                        </form>

                        <div class="form-group">
                            <label for="opciones">Agregar monitor nuevo</label>
                            <button class="btn btn-secondary mt-3" data-toggle="modal" data-target="#modalInterno">Abrir
                                Modal Interno
                            </button>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Interno -->
        <div class="modal fade" id="modalInterno" tabindex="-1" role="dialog" aria-labelledby="modalInternoLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalInternoLabel">Modal Interno</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- Formulario POST en el Modal Interno -->
                        <form action="procesar_interno.php" method="post">
                            <div class="form-group">
                                <label for="campoInterno">Campo Interno</label>
                                <input type="text" class="form-control" id="campoInterno" name="campoInterno"
                                    placeholder="Campo Interno">
                            </div>
                            <button type="submit" class="btn btn-primary">Enviar</button>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Botón para abrir el Modal Externo -->
        <button class="btn btn-primary" data-toggle="modal" data-target="#modalExterno">Abrir Modal Externo</button>
    </div>





    {{-- ZONA DE MODALES --}}
    {{-- @include('admin.computers.modals.create_computer') --}}


@stop






@section('js')

    {{-- JS DE DATATABLE CDN --}}

    @include('admin.partials.js_datatables')

    <script>
        $(document).ready(function() {
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
                    }, // Agrega esta columna formateada
                    {
                        data: 'grafica',
                        name: 'grafica'
                    }, // Agrega esta columna formateada
                    {
                        data: 'ram',
                        name: 'ram'
                    }, // Agrega esta columna formateada
                    {
                        data: 'descripcion',
                        name: 'descripcion'
                    }, // Agrega esta columna formateada
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



        });
    </script>
@stop
