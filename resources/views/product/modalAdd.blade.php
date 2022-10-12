<div class="modal fade" id="agregarProducto" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-m">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Agregar Producto</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <form class="row g-3 " action="{{ route('products.store') }}" method="POST">
                    @csrf
                    <div class="col-12 mt-2">
                        <label for="disabledTextInput" class="form-label">Nombre</label>
                        <input type="text" id="disabledTextInput" class="form-control" name="nombre">
                    </div>

                    <div class="col-12 mt-2">
                        <label for="disabledTextInput" class="form-label">Descripción</label>
                        <textarea class="form-control" placeholder="Agregue una descripción del servicio..." name="descripcion" id="floatingTextarea">
                        </textarea>
                    </div>

                    <label>Seleccionar atributos del producto:</label>
                    <div class="container text-center">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="inlineCheckbox1" name="modelo" value="modelo">
                            <label class="form-check-label" for="inlineCheckbox1">Modelo</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="inlineCheckbox2" name="cementerio" value="cementerio">
                            <label class="form-check-label" for="inlineCheckbox2">Cementerio</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="inlineCheckbox3" name="sector" value="sector">
                            <label class="form-check-label" for="inlineCheckbox3">Sector</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="inlineCheckbox3" name="nivel" value="nivel">
                            <label class="form-check-label" for="inlineCheckbox4">Nivel</label>
                        </div>
                    </div>
                    
                    

                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-success">Guardar</button>
                        <button type="reset" class="btn btn-secondary">Limpiar formulario</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>