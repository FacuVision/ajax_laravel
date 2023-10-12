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
                    <!-- Formulario POST en el Modal Externo -->
                    {{-- <form id="form_create_computer"> --}}
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
                            <textarea class="form-control" id="descripcion_computer" rows="3" placeholder="Descripción" name="descripcion_computer"></textarea>
                        </div>
                        <div class="form-group">

                            <label for="opciones">Opciones</label>


                            <select name="select_monitors[]" class="form-select" id="select_monitors"
                                data-placeholder="Selecciona uno o mas monitores para la PC" multiple>

                            </select>

                        </div>

                    </div>
                    {!! Form::close() !!}

                    {{-- </form> --}}
                    <div class="container-fluid">

                        <div class="form-group">
                            <label for="opciones">Agregar monitor nuevo</label> &nbsp;
                            <button class="btn btn-success mt-3" data-toggle="modal"
                                data-target="#modalInterno" id="modal_monitors_button">+</button>
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






                    <!-- Campo cod_patrimonial -->
                    <div class="form-group">
                        <label for="cod_patrimonial">Código Patrimonial (*)</label>
                        <input type="text" class="form-control" id="cod_patrimonial" name="cod_patrimonial" placeholder="Ingrese código patrimonial"  required>
                    </div>

                    <!-- Campo marca -->
                    <div class="form-group">
                        <label for="marca">Marca (*)</label>
                        <input type="text" class="form-control" id="marca" name="marca" placeholder="Ingrese Marca"  required>
                    </div>

                    <!-- Campo modelo -->
                    <div class="form-group">
                        <label for="modelo">Modelo (*)</label>
                        <input type="text" class="form-control" id="modelo" name="modelo" placeholder="Ingrese modelo"  required>
                    </div>

                    <div class="form-group">
                        <label for="descripcion">Descripción (*)</label>
                        <textarea class="form-control" id="descripcion" rows="3" placeholder="Ingrese Descripción" name="descripcion" required></textarea>
                    </div>
                </div>
                <div class="modal-footer">

                    <button type="submit" class="btn btn-primary">Enviar</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" id="modal_close_create_monitors">Cerrar</button>

                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
