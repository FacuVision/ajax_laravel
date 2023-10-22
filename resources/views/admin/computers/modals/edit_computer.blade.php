<div class="container mt-5">
    <!-- Modal inicial -->
    <div class="modal fade" id="edit_modalExterno" tabindex="-1" role="dialog" aria-labelledby="edit_modalExternoLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="edit_modalExternoLabel">Editar computadora <span id="cod_patrimonial_header"> </span></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">



                    {{-- ZONA ALERTS --}}

                    {{-- <div class="alert alert-success" role="alert" id="alert_create_computers" style="display: none;">
                        La computadora con código patrimonial N° <strong id="cod_patrimonial_alert_computer"></strong> ha sido registrado
                    </div>

                    <div class="alert alert-danger" id="alerta-computer" style="display: none;">
                        <ul id="lista-errores-computer"></ul>
                    </div>--}}
                    {{-- ZONA ALERTS --}}



                    <!-- Formulario POST en el Modal Externo -->
                    {!! Form::open(['class' => 'form-horizontal', 'id' => 'form_edit_computer']) !!}

                    {!! Form::hidden('computer_id', null, ['id' => 'computer_id']) !!}


                    <div class="container-fluid">

                        <div class="form-group">
                            <label for="procesador_edit">Procesador</label>
                            <input type="text" class="form-control" id="procesador_edit" placeholder="Procesador"
                                name="procesador_edit">
                        </div>
                        <div class="form-group">
                            <label for="placa_edit">Placa</label>
                            <input type="text" class="form-control" id="placa_edit" placeholder="Placa"
                                name="placa_edit">
                        </div>
                        <div class="form-group">
                            <label for="case_edit">Case</label>
                            <input type="text" class="form-control" id="case_edit" placeholder="Case" name="case_edit">
                        </div>
                        <div class="form-group">
                            <label for="grafica_edit">Tarjeta Gráfica</label>
                            <input type="text" class="form-control" id="grafica_edit" placeholder="Tarjeta Gráfica"
                                name="grafica_edit">
                        </div>
                        <div class="form-group">
                            <label for="ram_edit">RAM</label>
                            <input type="text" class="form-control" id="ram_edit" placeholder="RAM" name="ram_edit">
                        </div>
                        <div class="form-group">
                            <label for="descripcion_edit">Descripción</label>
                            <textarea class="form-control" id="descripcion_computer_edit" rows="3" placeholder="Descripción"
                                name="descripcion_computer_edit"></textarea>
                        </div>
                        <div class="form-group">

                            <label for="opciones">Monitores</label>
                            <select name="select_edit_monitors[]" class="form-select" id="select_edit_monitors"
                            data-placeholder="Selecciona uno o mas monitores para la PC" multiple></select>

                        </div>

                    </div>
                    {!! Form::close() !!}

                    {{-- </form> --}}
                    <div class="container-fluid">

                        <div class="form-group">
                            <label for="opciones">Agregar monitor nuevo</label> &nbsp;
                            <button class="btn btn-success mt-3" data-toggle="modal" data-target="#modalInterno_crear_monitor_edit"
                                id="modal_monitors_button">+</button>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">

                    {!! Form::submit('Editar', ['id' => 'edit_computer_button_submit_modal', 'class' => 'btn btn-success']) !!}
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" id="close_edit_modal_computer">Cerrar</button>

                </div>
            </div>
        </div>
    </div>





{{-- ESTE MODAL ES IDENTICO AL OTRO MODAL DE CREACION DE MONITOR, LA DIFERENCIA ES QUE ESTE SE MUESTRA EN UN NIVEL MAS ALTO,
    YA QUE EL DE CREACION ESTABA MUCHO MAS ATRAS --}}

    <!-- Modal superior -->
    <div class="modal fade" id="modalInterno_crear_monitor_edit" tabindex="-1" role="dialog" aria-labelledby="modalInterno_crear_monitor_edit"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            {!! Form::open(['method' => 'POST', 'class' => 'form-horizontal', 'id' => 'form_create_monitor_edit']) !!}

            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="edit_modalInternoLabel">Registrar un nuevo monitor</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Formulario POST en el Modal Interno -->

                    <div class="alert alert-success" role="alert" id="alert_create_monitors_edit" style="display: none;">
                        El monitor con código patrimonial N° <strong id="cod_patrimonial_alert_edit"></strong> ha sido registrado
                    </div>

                    <div class="alert alert-danger" id="alerta_edit_monitors" style="display: none;">
                        <ul id="lista-errores-edit"></ul>
                    </div>

                    <!-- Campo cod_patrimonial -->
                    <div class="form-group">
                        {!! Form::label('cod_patrimonial', 'Código Patrimonial (*)') !!}
                        {!! Form::text('cod_patrimonial', null, ['class' => 'form-control', 'placeholder' => 'Ingrese código patrimonial' , "id" => "cod_patrimonial_edit"]) !!}
                    </div>

                    <!-- Campo marca -->
                    <div class="form-group">
                        {!! Form::label('marca', 'Marca (*)') !!}
                        {!! Form::text('marca', null, ['class' => 'form-control', 'placeholder' => 'Ingrese Marca' , "id" => "marca_edit"]) !!}
                    </div>

                    <!-- Campo modelo -->
                    <div class="form-group">
                        {!! Form::label('modelo', 'Modelo (*)') !!}
                        {!! Form::text('modelo', null, ['class' => 'form-control', 'placeholder' => 'Ingrese modelo' , "id" => "modelo_edit" ]) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('descripcion', 'Descripción (*)') !!}
                        {!! Form::textarea('descripcion', null, ['class' => 'form-control', 'rows' => 3, 'placeholder' => 'Ingrese Descripción', "id" => "descripcion_edit"]) !!}
                    </div>
                </div>
                <div class="modal-footer">
                    {!! Form::submit('Enviar', ['class' => 'btn btn-primary']) !!}
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" id="modal_close_create_monitors">Cerrar</button>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
