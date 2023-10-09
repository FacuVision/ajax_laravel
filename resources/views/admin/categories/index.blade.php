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


    <div class="container mb-2">
        <div class="card">
            <div class="card-header">
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal_categories">
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
                            <th scope="col">fecha formateada</th>
                            <th scope="col">fecha actualizacion</th>
                            <th scope="col">Accion</th>
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

    <div class="modal fade" id="modal_categories" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
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
                        {!! Form::text('name', '', ['id' => 'name', 'class' => 'form-control', 'required']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('description', 'Descripcion') !!}
                        {!! Form::text('description', '', ['id' => 'description', 'class' => 'form-control', 'required']) !!}
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





    <!-- Modal Edit-->
    {!! Form::open(['class' => 'form-horizontal', 'id' => 'form_ajax_edit']) !!}

    {{-- hidden para la actualizacion --}}
    {!! Form::hidden('category_id', null, ['id' => 'category_id']) !!}

    <div class="modal fade" id="modal_categories_edit" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Edit modal</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="form-group">
                        {!! Form::label('name_edit', 'Nombre') !!}
                        {!! Form::text('name_edit', '', ['id' => 'name_edit', 'class' => 'form-control', 'required']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('description_edit', 'Descripcion') !!}
                        {!! Form::text('description_edit', '', ['id' => 'description_edit', 'class' => 'form-control', 'required']) !!}
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    {!! Form::submit('Editar', ['id' => 'ajax_boton_edit', 'class' => 'btn btn-success']) !!}
                </div>
            </div>
        </div>
    </div>
    @method('PUT')
    {!! Form::close() !!}
@stop



@section('js')
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/responsive.bootstrap4.min.js"></script>

    <script>
        $(document).ready(function() {

            //ESTE TOKEC CSRF LO SOLICITA LA LIBRERIA YAJRA PARA PODER HACER EL ENVIO DE LA
            //PETICION Y LA RECEPCION DE LA MISMA

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            //ESTO SIRVE PARA MODIFICAR EL TITULO DEL MODAL

            $(".modal-title").html("Crear una Categoria")

            //CREAMOS EL DATATABLE Y LO ASIGNAMOS A UNA VARIABLE DE JS

            /*
                processing:true
                y serverSide

                processing: true: Cuando se establece en true, indica que DataTables debe mostrar un mensaje
                de "Processing" (procesamiento) en la tabla mientras se cargan los datos o se realiza una operación
                en el lado del servidor. Esto es útil para informar al usuario que se están procesando datos y que debe esperar.

                serverSide: true: Cuando se establece en true, indica que DataTables debe realizar operaciones de
                paginación, búsqueda y ordenamiento en el lado del servidor en lugar de en el lado del cliente.
                Esto significa que DataTables enviará solicitudes al servidor para obtener datos y aplicar filtros y
                ordenamientos en función de las interacciones del usuario, lo que puede ser más eficiente para grandes conjuntos de datos.
            */

            var table = $('#category_table').DataTable({

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
                        data: 'fecha_creacion',
                        name: 'fecha_creacion'
                    }, // Agrega esta columna formateada
                    {
                        data: 'fecha_actualizacion',
                        name: 'fecha_actualizacion'
                    }, // Agrega esta columna formateada
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    }
                ],

                order: [
                    [0, 'desc']
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

                table.ajax.reload(); //recargar la tabla
                hideModal(); //ocultar modal de creacion
            });

            function hideModal() {
                $("#name").val("");
                $("#description").val("");
                $("#modal_categories").hide();
                $("#modal_categories").removeClass("in");
                $('body').removeClass('modal-open');
                $('body').css('padding-right', '');
                $(".modal-backdrop").remove();
            }



            /*


            $('body').on('click', '.editButton', function() {
            Este código utiliza el método .on() de jQuery para agregar un evento de clic a todos
            los elementos con la clase .editButton que se encuentren dentro del elemento <body>.
            La ventaja de este enfoque es que los elementos con la clase .editButton pueden
            agregarse o eliminarse dinámicamente en el DOM, y el evento de clic seguirá funcionando
            para ellos sin necesidad de volver a asignar el evento. Es útil cuando trabajas con
            contenido dinámico o elementos que se crean después de que se carga la página inicial.

            $('.editButton').click(function() {
            Este código selecciona todos los elementos con la clase .editButton en el momento en que se
            ejecuta y les asigna el evento de clic. Sin embargo, esta asignación de eventos es estática
            y solo se aplicará a los elementos con la clase .editButton que existían en el DOM en el
            momento en que se ejecutó el código. Si se agregan nuevos elementos con esta clase después
            de que se haya ejecutado el código, no tendrán el evento de clic adjunto automáticamente.

            */


            //EDITAR BOTON --------------------------------------------------------------------------
            $('body').on('click', '.editButton', function() {

                //$('.editButton').click(function() {

                var id = $(this).data('id');
                //console.log(id);

                $.ajax({
                    type: 'GET',
                    url: '{{ url('admin/categories', '') }}/' + id + '/edit',
                    success: function(response) {
                        // Manejar la respuesta del servidor (opcional)

                        //UNA VEZ QUE SE HAYA RECEPCIONADO EL MODELO POR AJAX, SE PROCEDE A LA ACTUALIZACION
                        $(".modal-title").html("Editar Categoria Id: " + id)
                        $("#name_edit").val(response.name);
                        $("#description_edit").val(response.description);
                        $("#category_id").val(response.id);


                    },
                    error: function(xhr) {
                        // Manejar errores (opcional)
                        console.error(xhr.responseText);
                    }
                });
            });


            //ajax para hacer la actualizacion enviado el formulario con los datos

            $('#form_ajax_edit').on('submit', function(e) {
                e.preventDefault();
                let formData = $(this).serialize();

                let id = $("#category_id").val();

                //console.log(formData);

                $.ajax({
                    type: 'PUT',
                    url: '{{ url('admin/categories', '') }}/' + id,
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

                table.ajax.reload(); //recargar la tabla
                hideModalEdit(); //ocultar modal de edicion
            });

            function hideModalEdit() {
                $("#name").val("");
                $("#description").val("");
                $(".modal-backdrop").remove();
                $("#modal_categories_edit").hide();
                $("#modal_categories").removeClass("in");
                $('body').removeClass('modal-open');
                $('body').css('padding-right', '');
            }



            //PASOS PARA LA ELIMINACION DE UN REGISTRO AJAX--------------------------

            $("body").on("click", ".delButton", function() {
                if (confirm('¿Seguro que quieres eliminar este registro?')) {
                    // Si el usuario hace clic en "Aceptar", ejecutamos la lógica de eliminación aquí
                    // Puedes realizar una solicitud AJAX para eliminar el registro o cualquier otra acción que necesites

                    //e.preventDefault();

                    var id = $(this).data('id');
                    //console.log(id);
                    $.ajax({
                        type: 'DELETE',
                        url: '{{ url('admin/categories', '') }}/' + id,
                        success: function(response) {
                            // Manejar la respuesta del servidor (opcional)

                        },
                        error: function(xhr) {
                            // Manejar errores (opcional)
                            console.error(xhr.responseText);
                        }

                    });

                    table.ajax.reload(); //recargar la tabla
                }

                // Si el usuario hace clic en "Cancelar", no hacemos nada
                // Aquí puedes agregar cualquier otra acción que desees realizar si el usuario cancela

            });



        });
    </script>
@stop
