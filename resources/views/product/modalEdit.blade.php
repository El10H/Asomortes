<div class="modal fade" id="actualizar{{ $product->id }}" tabindex="-1"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-m ">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Editar
                    Producto</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>

            <div class="modal-body">

                <form class="row g-3 " action="{{ route('actualizar.product', $product->id) }}" method="POST">
                    @csrf

                    <div class="col-12 ">
                        <label for="disabledTextInput" class="form-label">Nombre</label>
                        <input type="text" id="disabledTextInput" class="form-control" name="nombre"
                            value='{{$product->nombre}}'>
                    </div>
                    
                    <div class="col-12 mt-2">
                        <label for="disabledTextInput" class="form-label">Descripción</label>
                        <textarea class="form-control" name="descripcion" id="floatingTextarea">{{$product->descripcion}}
                        </textarea>
                    </div>

                    <label>Seleccionar atributos del producto:</label>

                    <?php  
                    $array_attributes=array();
                    $i=0;
                    ?>

                    @foreach ($attribute_products as $attribute_product)
                        @if ($attribute_product->id_products == $product->id)
                            <?php         
                                $atributo=$attribute_product->atributo;
                                $array_attributes[$i]=($atributo);
                                $i++;      
                            ?>    
                        @endif
                    @endforeach           
                    
                    <div class="container text-center">
                        <?php 
                            if(in_array('modelo', $array_attributes)){
                                echo <<< EOT
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="inlineCheckbox1" name="modelo" value="modelo" checked>
                                    <label class="form-check-label" for="inlineCheckbox1">Modelo</label>
                                </div>
                                EOT;   
                            }else{
                                echo <<< EOT
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="inlineCheckbox1" name="modelo" value="modelo" >
                                    <label class="form-check-label" for="inlineCheckbox1">Modelo</label>
                                </div>
                                EOT; 
                            }

                            if(in_array('cementerio', $array_attributes)){
                                echo <<< EOT
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="inlineCheckbox1" name="cementerio" value="cementerio" checked>
                                    <label class="form-check-label" for="inlineCheckbox1">Cementerio</label>
                                </div>
                                EOT;   
                            }else{
                                echo <<< EOT
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="inlineCheckbox1" name="cementerio" value="cementerio" >
                                    <label class="form-check-label" for="inlineCheckbox1">Cementerio</label>
                                </div>
                                EOT; 
                            }

                            if(in_array('sector', $array_attributes)){
                                echo <<< EOT
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="inlineCheckbox1" name="sector" value="sector" checked>
                                    <label class="form-check-label" for="inlineCheckbox1">Sector</label>
                                </div>
                                EOT;   
                            }else{
                                echo <<< EOT
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="inlineCheckbox1" name="sector" value="sector" >
                                    <label class="form-check-label" for="inlineCheckbox1">Sector</label>
                                </div>
                                EOT; 
                            }

                            if(in_array('nivel', $array_attributes)){
                                echo <<< EOT
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="inlineCheckbox1" name="nivel" value="nivel" checked>
                                    <label class="form-check-label" for="inlineCheckbox1">Nivel</label>
                                </div>
                                EOT;   
                            }else{
                                echo <<< EOT
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="inlineCheckbox1" name="nivel" value="nivel" >
                                    <label class="form-check-label" for="inlineCheckbox1">Nivel</label>
                                </div>
                                EOT; 
                            }
                        //var_dump($array_attributes);
                        ?>
                                
                    </div>
                    
                            

                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger"
                            data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-success">Actualizar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>