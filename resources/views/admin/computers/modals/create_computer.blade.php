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
                            <textarea class="form-control" id="descripcion" rows="3" placeholder="Descripción" name="descripcion"></textarea>
                        </div>
                        <div class="form-group">

                            <label for="opciones">Opciones</label>

                            <div class="col-md-12">
                                {{-- <select id="select_monitors" name="select_monitors[]"
                                    placeholder="Selecciona uno o mas monitores para la PC" multiple>
                                </select> --}}

                                <select class="form-select" id="select_monitors" data-placeholder="Selecciona uno o mas monitores para la PC" multiple>
                                    <option>Christmas Island</option>
                                    <option>South Sudan</option>
                                    <option>Jamaica</option>
                                    <option>Kenya</option>
                                    <option>French Guiana</option>
                                    <option>Mayotta</option>
                                    <option>Liechtenstein</option>
                                    <option>Denmark</option>
                                    <option>Eritrea</option>
                                    <option>Gibraltar</option>
                                    <option>Saint Helena, Ascension and Tristan da Cunha</option>
                                    <option>Haiti</option>
                                    <option>Namibia</option>
                                    <option>South Georgia and the South Sandwich Islands</option>
                                    <option>Vietnam</option>
                                    <option>Yemen</option>
                                    <option>Philippines</option>
                                    <option>Benin</option>
                                    <option>Czech Republic</option>
                                    <option>Russia</option>
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
