<div class="container mt-5">
    <!-- Modal inicial -->
    <div class="modal fade" id="modalExterno" tabindex="-1" role="dialog" aria-labelledby="modalExternoLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalExternoLabel">Registrar una computadora</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">



                    {{-- ZONA ALERTS --}}

                    <div class="alert alert-success" role="alert" id="alert_create_computers" style="display: none;">
                        La computadora con código patrimonial N° <strong id="cod_patrimonial_alert_computer"></strong> ha sido registrado
                    </div>

                    <div class="alert alert-danger" id="alerta-computer" style="display: none;">
                        <ul id="lista-errores-computer"></ul>
                    </div>
                    {{-- ZONA ALERTS --}}



                    <!-- Formulario POST en el Modal Externo -->
                    {!! Form::open(['method' => 'POST', 'class' => 'form-horizontal', 'id' => 'form_create_computer']) !!}

                    <div class="container-fluid">

                        <div class="form-group">
                            <label for="procesador">Procesador</label>
                            <input type="text" class="form-control" id="procesador" placeholder="Procesador"
                                name="procesador">
                        </div>
                        <div class="form-group">
                            <label for="placa">Placa</label>
                            <input type="text" class="form-control" id="placa" placeholder="Placa"
                                name="placa">
                        </div>
                        <div class="form-group">
                            <label for="case">Case</label>
                            <input type="text" class="form-control" id="case" placeholder="Case" name="case">
                        </div>
                        <div class="form-group">
                            <label for="grafica">Tarjeta Gráfica</label>
                            <input type="text" class="form-control" id="grafica" placeholder="Tarjeta Gráfica"
                                name="grafica">
                        </div>
                        <div class="form-group">
                            <label for="ram">RAM</label>
                            <input type="text" class="form-control" id="ram" placeholder="RAM" name="ram">
                        </div>
                        <div class="form-group">
                            <label for="descripcion">Descripción</label>
                            <textarea class="form-control" id="descripcion_computer" rows="3" placeholder="Descripción"
                                name="descripcion_computer"></textarea>
                        </div>
                        <div class="form-group">

                            <label for="opciones">Monitores</label>


                            <select name="select_monitors[]" class="form-select" id="select_monitors"
                            data-placeholder="Selecciona uno o mas monitores para la PC" multiple></select>

                        </div>

                    </div>
                    {!! Form::close() !!}

                    {{-- </form> --}}
                    <div class="container-fluid">

                        <div class="form-group">
                            <label for="opciones">Agregar monitor nuevo</label> &nbsp;
                            <button class="btn btn-success mt-3" data-toggle="modal" data-target="#modalInterno"
                                id="modal_monitors_button">+</button>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">

                    {!! Form::submit('Crear', ['id' => 'create_computer_button_submit_modal', 'class' => 'btn btn-success']) !!}
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"
                        id="close_create_modal_computer">Cerrar</button>

                </div>
            </div>
        </div>
    </div>









    <!-- Modal superior -->
    <div class="modal fade" id="modalInterno" tabindex="-1" role="dialog" aria-labelledby="modalInternoLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            {!! Form::open(['method' => 'POST', 'class' => 'form-horizontal', 'id' => 'form_create_monitor']) !!}

            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalInternoLabel">Registrar un nuevo monitor</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Formulario POST en el Modal Interno -->

                    <div class="alert alert-success" role="alert" id="alert_create_monitors" style="display: none;">
                        El monitor con código patrimonial N° <strong id="cod_patrimonial_alert"></strong> ha sido registrado
                    </div>

                    <div class="alert alert-danger" id="alerta" style="display: none;">
                        <ul id="lista-errores"></ul>
                    </div>

                    <!-- Campo cod_patrimonial -->
                    <div class="form-group">
                        {!! Form::label('cod_patrimonial', 'Código Patrimonial (*)') !!}
                        {!! Form::text('cod_patrimonial', null, ['class' => 'form-control', 'placeholder' => 'Ingrese código patrimonial']) !!}
                    </div>

                    <!-- Campo marca -->
                    <div class="form-group">
                        {!! Form::label('marca', 'Marca (*)') !!}
                        {!! Form::text('marca', null, ['class' => 'form-control', 'placeholder' => 'Ingrese Marca']) !!}
                    </div>

                    <!-- Campo modelo -->
                    <div class="form-group">
                        {!! Form::label('modelo', 'Modelo (*)') !!}
                        {!! Form::text('modelo', null, ['class' => 'form-control', 'placeholder' => 'Ingrese modelo']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('descripcion', 'Descripción (*)') !!}
                        {!! Form::textarea('descripcion', null, ['class' => 'form-control', 'rows' => 3, 'placeholder' => 'Ingrese Descripción']) !!}
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
