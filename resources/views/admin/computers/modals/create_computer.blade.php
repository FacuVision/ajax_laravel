<div class="container mt-5">
    <!-- Modal inicial -->
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
                    {{-- <form id="form_create_computer"> --}}
                        {!! Form::open(['method' => 'POST', 'class' => 'form-horizontal', 'id'=>'form_create_computer']) !!}


                        <div class="container-fluid">
                            <div class="form-group">
                                <label for="procesador">Procesador</label>
                                <input type="text" class="form-control" id="procesador" placeholder="Procesador" name="procesador">
                            </div>
                            <div class="form-group">
                                <label for="placa">Placa</label>
                                <input type="text" class="form-control" id="placa" placeholder="Placa"  name="placa">
                            </div>
                            <div class="form-group">
                                <label for="case">Case</label>
                                <input type="text" class="form-control" id="case" placeholder="Case"  name="case">
                            </div>
                            <div class="form-group">
                                <label for="grafica">Tarjeta Gráfica</label>
                                <input type="text" class="form-control" id="grafica" placeholder="Tarjeta Gráfica" name="grafica">
                            </div>
                            <div class="form-group">
                                <label for="ram">RAM</label>
                                <input type="text" class="form-control" id="ram" placeholder="RAM" name="ram">
                            </div>
                            <div class="form-group">
                                <label for="descripcion">Descripción</label>
                                <textarea class="form-control" id="descripcion" rows="3" placeholder="Descripción" name="descripcion"></textarea>
                            </div>
                            <div class="form-group">

                                <label for="opciones">Opciones</label>

                                <div class="col-md-12">
                                    <select id="select_monitors" name="select_monitors[]"
                                        placeholder="Selecciona uno o mas monitores para la PC" multiple>
                                        <option value="HTML">HTML</option>
                                        <option value="Jquery">Jquery</option>
                                        <option value="CSS">CSS</option>
                                        <option value="Bootstrap 3">Bootstrap 3</option>
                                        <option value="Bootstrap 4">Bootstrap 4</option>
                                        <option value="Java">Java</option>
                                        <option value="Javascript">Javascript</option>
                                        <option value="Angular">Angular</option>
                                        <option value="Python">Python</option>
                                        <option value="Hybris">Hybris</option>
                                        <option value="SQL">SQL</option>
                                        <option value="NOSQL">NOSQL</option>
                                        <option value="NodeJS">NodeJS</option>
                                    </select>
                                </div>

                            </div>

                        </div>
                        {!! Form::close() !!}

                    {{-- </form> --}}
                    <div class="container-fluid">

                        <div class="form-group">
                            <label for="opciones">Agregar monitor nuevo</label> &nbsp;
                            <button class="btn btn-success mt-3" data-toggle="modal"
                            data-target="#modalInterno">+</button>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">

                    {!! Form::submit('Crear', ['id' => 'create_computer_button_submit_modal', 'class' => 'btn btn-success']) !!}
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" id="close_create_modal_computer">Cerrar</button>

                </div>
            </div>
        </div>
    </div>









    <!-- Modal superior -->
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
</div>
