@extends('adminlte::page')

@section('title', 'Categorias')

@section('content_header')
    <h1>Menu de Categorias</h1>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap4.min.css">

    <meta name="csrf-token" content="{{ csrf_token() }}">

@stop

@section('content')
    <p>Aquí se crean las categorias</p>


    <div class="container">
        <div class="card">
            <div class="card-header">
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
                    Launch demo modal
                </button>

            </div>

            <div class="card-body">

                <table class="table" id="category_table">
                    <thead>
                        <tr>
                            <th scope="col">id</th>
                            <th scope="col">name</th>
                            <th scope="col">description</th>
                            <th scope="col">created_at</th>
                            <th scope="col">updated_at</th>
                            {{-- <th scope="col">Accion</th> --}}
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>

            </div>


        </div>
    </div>





    <!-- Modal -->
    {!! Form::open(['class' => 'form-horizontal', 'id' => 'form_ajax']) !!}

    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="form-group">
                        {!! Form::label('name', 'Nombre') !!}
                        {!! Form::text('name', '', ['class' => 'form-control', 'required']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('description', 'Descripcion') !!}
                        {!! Form::text('description', '', ['class' => 'form-control', 'required']) !!}
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    {!! Form::submit('Crear', ['id' => 'ajax_boton', 'class' => 'btn btn-success']) !!}
                </div>
            </div>
        </div>
    </div>
    {!! Form::close() !!}
@stop

@section('css')

@stop

@section('js')
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/responsive.bootstrap4.min.js"></script>

    <script>
        $(document).ready(function() {

            $(".modal-title").html("Crear una Categoria")

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('#category_table').DataTable({

                processing: true,
                serverSide: true,


                ajax: '{!! route('admin.categories.index') !!}',


                columns: [{
                        data: 'id',
                        mame: 'id'
                    },
                    {
                        data: 'name',
                        mame: 'name'
                    },
                    {
                        data: 'description',
                        mame: 'description'
                    },
                    {
                        data: 'created_at',
                        mame: 'created_at'
                    },
                    {
                        data: 'updated_at',
                        mame: 'updated_at'
                    }
                ]

            });

            $('#form_ajax').on('submit', function(e) {
                e.preventDefault();
                let formData = $(this).serialize();

                $.ajax({
                    type: 'POST',
                    url: '{{ route('admin.categories.store') }}', // Reemplaza 'nombre_de_ruta' con la ruta de destino en tu aplicación
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

                $('#exampleModalCenter').modal('hide');
            });


        });
    </script>
@stop
