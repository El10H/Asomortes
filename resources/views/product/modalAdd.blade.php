<style>
    label.error {
        color: red;
        font-size: 0.8em;
    }
    .rojito {
        color: red;
        font-weight: 700;
    }
</style>
<div class="modal fade" id="agregarProducto" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-m">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Agregar Producto</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"> <span
                    aria-hidden="true">&times;</span></button>
            </div>

            <div class="modal-body">
                <form class="row g-3 " action="{{ route('products.store') }}" method="POST" id="formAgregarProducto">
                    @csrf
                    <div class="col-12 mt-2">
                        <label for="disabledTextInput" class="form-label">Nombre <span class="rojito">(*)</span></label>
                        <input type="text" id="disabledTextInput" class="form-control" name="nombre">
                    </div>

                    <div class="col-12 mt-2">
                        <label for="disabledTextInput" class="form-label">Descripción<span class="rojito"> (*)</span></label>
                        <textarea class="form-control" placeholder="Agregue una descripción del servicio..." name="descripcion"
                             required>
                        </textarea>
                    </div>

                    <div class="col-12 mt-2">
                        <label>Seleccionar atributos del producto:</label>
                        <div class="container text-center">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="inlineCheckbox1" name="modelo"
                                    value="modelo">
                                <label class="form-check-label" for="inlineCheckbox1">Modelo</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="inlineCheckbox2" name="cementerio"
                                    value="cementerio">
                                <label class="form-check-label" for="inlineCheckbox2">Cementerio</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="inlineCheckbox3" name="sector"
                                    value="sector">
                                <label class="form-check-label" for="inlineCheckbox3">Sector</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="inlineCheckbox3" name="nivel"
                                    value="nivel">
                                <label class="form-check-label" for="inlineCheckbox4">Nivel</label>
                            </div>
                        </div>

                    </div>

            </div>

            <div class="modal-footer ">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-success">Guardar</button>
                <button type="reset" class="btn btn-secondary">Limpiar formulario</button>



            </div>
            </form>

        </div>
    </div>
</div>

@section('js')
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>
    <script>
        $(document).ready(function() {
            jQuery.extend(jQuery.validator.messages, {
                required: "Este campo es obligatorio.",
                remote: "Por favor, rellena este campo.",
                email: "Por favor, escribe una dirección de correo válida",
                date: "Por favor, escribe una fecha válida.",
                number: "Por favor, escribe un número entero válido.",
                digits: "Por favor, escribe sólo dígitos.",

            });
            $.validator.addMethod("soloNumeros", function(value, element) {
                var pattern = /^([0-9]{1,8})$/;
                return this.optional(element) || pattern.test(value);
            }, "Este campo acepta solo números");

            $.validator.addMethod("soloLetras", function(value, element) {
                var pattern = /^[a-zA-ZÀ-ÿ\s]{1,50}$/;
                return this.optional(element) || pattern.test(value);
            }, "El campo no acepta números o signos");


            $("#formAgregarProducto").validate({
                rules: {
                    nombre: {
                        required: true,
                        soloLetras: true 
                 
                    },
                    descripcion: {
                        required: true,
                    },
                   
                },

            });

        });
    </script>
@endsection
