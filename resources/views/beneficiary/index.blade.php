@extends('adminlte::page')
@section('title', 'BENEFICIARIOS')

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-dark text-white">
                        Panel de Beneficiarios

                    </div>

                    <div class="row">

                        <div class="col-sm-12">
                            <div class="card">
                                @php
                                    
                                @endphp

                                <div class="card-body">
                                    <a href="{{ route('beneficiaries.list') }}" class="btn btn-success">Exportar PDF</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <table class="table table-striped" style="width:100%" id="data">
                            <thead>
                                <tr>
                                    <th scope="col">Socio</th>
                                    <th scope="col">Beneficiario</th>
                                    <th scope="col">Dni Beneficiario</th>
                                    <th></th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($beneficiaries as $beneficiary)
                                    <tr>


                                        <td>{{ $beneficiary->nombre_partner .' ' .$beneficiary->apellidoPaterno_partner .' ' .$beneficiary->apellidoMaterno_partner }}
                                        </td>
                                        <td>{{ $beneficiary->nombre_Beneficiary .' ' .$beneficiary->apellidoPaterno_beneficiary .' ' .$beneficiary->apellidoMaterno_beneficiary }}
                                        </td>
                                        <td>{{ $beneficiary->dni }}</td>


                                        <td>
                                            <form
                                                action="{{ route('beneficiary.destroy', $beneficiary->beneficiary_id) }}"
                                                method="POST">
                                                @method('DELETE')
                                                @csrf

                                                <button type="submit" class="btn btn-outline-danger"
                                                    onclick="return confirm('¿Desea eliminar?')">
                                                    <i class="far fa-trash-alt"></i>
                                                </button>

                                                <a href="{{ route('beneficiaries.form', $beneficiary->id_partner) }}"
                                                    class="btn btn-outline-primary"><i class="fas fa-user-plus"></i></a>


                                                <a href="{{ route('beneficiaries.edit', ['beneficiary' => $beneficiary->beneficiary_id,'partnerId' => $beneficiary->id_partner]) }}"
                                                    class="btn btn-outline-success">
                                                    <i class="far fa-edit"></i>
                                                </a>
                                            </form>
                                        </td>

                                    </tr>
                                @endforeach
                            </tbody>

                        </table>

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
