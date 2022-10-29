@extends('adminlte::page')
@section('title', 'Roles')


@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous">
    </script>
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-dark text-white">
                        Lista de Roles
                    </div>
                    
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card">
                                <div class="card-body">
                                    <button  type="button" class="btn btn-primary" data-bs-toggle="modal" 
                                        data-bs-target="#agregarRol">
                                        Agregar Rol
                                    </button>  
                                    <a href="{{ route('providers.pdf') }}" target="_blank" class="btn btn-success">Exportar PDF</a>
                                </div>
                            </div>
                        </div>
                    </div>
                
                  
            
                    @if (session('create'))
                        <div class="alert alert-success alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                {{Session::get('create')}}
                        </div>
                    @elseif (session('update'))
                        <div class="alert alert-success alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                {{Session::get('update')}}
                        </div>
                    @elseif (session('delete'))
                    <div class="alert alert-danger alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            {{Session::get('delete')}}
                    </div>
                    @endif
               

              
                    <div class="card-body">
                        <table class="table table-striped" style="width:100%" id="data">
                            <thead>
                                <tr align="center">
                                    <th width= 10% scope="col">Id</th>
                                    <th width= 30% scope="col">Rol</th>
                                    <th width= 20%></th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($roles as $role)
                                    <tr>
                                        <td align="left">{{ $role->id}}</td>
                                        <td align="left">{{ $role->name}}</td>
                                        
                                        <td align="center">
                                            <form action="{{route('roles.destroy', $role)}}" method="POST">
                                                @method('DELETE')
                                                @csrf
                                                 
                                                <button type="submit" class="btn btn-outline-danger"
                                                    onclick="return confirm('¿Desea eliminar?')">
                                                    <i class="far fa-trash-alt"></i>
                                                </button>

                                                <a data-bs-toggle="modal" data-bs-target="#actualizar{{ $role->id }}"
                                                    class="btn btn-outline-success">
                                                    <i class="far fa-edit"></i>
                                                </a> 
                                            </form>

                                            <!-- Modal para editar Rol -->
                                            <div class="modal fade" id="actualizar{{ $role->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
                                                aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered modal-s">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Editar Rol</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                        </div>

                                                        <div class="modal-body">

                                                            <form class="row g-3 " action="{{ route('roles.update', $role->id) }}" method="POST">
                                                                @method('PUT')
                                                                @csrf

                                                                <div class="col-12 ">
                                                                    <label for="disabledTextInput" class="form-label">nombre</label>
                                                                    <input type="text" id="disabledTextInput" class="form-control" name="name"
                                                                        value='{{$role->name}}'>
                                                                </div>

                                                                <div class="col-12 ">
                                            
                                                                    <label for="disabledTextInput" class="form-label">Lista de permisos:</label></br>

                                                                    @foreach($permissions as $permission)
                                                                    
                                                                        <div class="col-12 ml-3">
                                                                            @if($role->hasPermissionTo($permission->id))
                                                                                <input class="form-check-input" type="checkbox" id="" name="permissions[]" value= {{$permission->id}} checked>
                                                                            @else
                                                                                <input class="form-check-input" type="checkbox" id="" name="permissions[]" value= {{$permission->id}} >
                                                                            @endif

                                                                            <label class="form-check-label" for="inlineCheckbox1">{{$permission->description}}</label>   
                                                                        </div></br>
                                                                    @endforeach

                                                                    
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
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>


                    <!-- Modal para agregar Rol -->
                    <div class="modal fade" id="agregarRol" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-s">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Agregar Rol</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>

                                <div class="modal-body">
                                    <form class="row g-3 " action="{{ route('roles.store') }}" method="POST">
                                        @csrf

                                        <div class="col-12">
                                            <label for="disabledTextInput" class="form-label">Nombre</label>
                                            <input type="text" id="disabledTextInput" class="form-control" name="name">
                                        </div>

                                        @error('name')
                                            <small class="text-danger">
                                                {{$message}}
                                            </small>
                                        @enderror

                                        <div class="col-12">
                                            
                                            <label for="disabledTextInput" class="form-label">Lista de permisos:</label></br>

                                            @foreach($permissions as $permission)
                                                <div class="col-12 ml-3">
                                                    <input class="form-check-input" type="checkbox" id="" name="permissions[]" value= {{$permission->id}} >
                                                    <label class="form-check-label" for="inlineCheckbox1">{{$permission->description}}</label>   
                                                </div></br>
                                            @endforeach

                                            
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
                </div>
            </div>
        </div>
    </div>


    @section('js')
        <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
        <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
        <script>
            if (!$.fn.DataTable.isDataTable('#data')) {
                $('#data').dataTable({
                    "language": {
                        "lengthMenu": "Mostrar _MENU_ registros por página",
                        "zeroRecords": "Nada encontrado - disculpa",
                        "info": "Mostrando la página _PAGE_ de _PAGES_",
                        "infoEmpty": "No records available",
                        "infoFiltered": "(filtrado de _MAX_ registros totales)",
                        "search": "Buscar",
                        "paginate": {
                            'next': 'Siguiente',
                            'previous': 'anterior'
                        }
                    }
                });
            }
        </script>
    @endsection
@endsection