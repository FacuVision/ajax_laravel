@extends('adminlte::page')

@section('title', 'Categorias')

@section('content_header')
    <h1>Menu de Categorias</h1>
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
    <script>
        $(document).ready(function() {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $(".modal-title").html("Crear una Categoria")



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
