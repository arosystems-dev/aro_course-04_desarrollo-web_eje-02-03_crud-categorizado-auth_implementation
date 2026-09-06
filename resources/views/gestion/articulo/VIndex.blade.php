@extends('principal.VPrincipal')
@section('contenido')
<!-- ================================
        VISTA INDEX ARTICULO
================================  -->

<div class="conteiner">
    <div class="card p-3" style="min-height: 80vh;">
        <div class="card-header">
            <h2>GESTIÓN DE ARTÍCULOS</h2>
        </div>
        <div class="card-body">
            <form action="/articulo/search" method="GET">
                <div class="row mt-5">
                    <div class="col-5">
                        <input name="criterio" type="text" class="form-control" placeholder="Buscar...">
                    </div>
                    <div class="col-7">
                        <button type="submit" class="btn btn-info">Buscar</button>
                        <a href="/articulo/create">
                            <button type="button" class="btn btn-success">Nuevo</button>
                        </a>
                    </div>
                </div>
            </form>
            <table id="dataTable" class="table mt-3">
                <thead>
                    <tr>
                        <th scope="col">FOTO</th>
                        <th scope="col">DATOS</th>
                        <th scope="col">STOCK</th>
                        <th>OPCIONES</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($articulos as $a)
                    <tr>
                        <td><img src="{{asset('img/articulos/'.$a->foto)}}" alt="" height="75px" width="75px"></td>
                        <td>
                            CODIGO: {{$a->codigo}} <br>
                            NOMBRE: {{$a->nombre}} <br>
                            CATEGORÍA: {{$a->categoria}}
                        </td>
                        <td>{{$a->stock}}</td>
                        <td>
                            <a href="/articulo/edit/{{$a->id}}"><img src="{{asset('img/editar.png')}}"
                                    alt=""></a> &nbsp;
                            <a href="/articulo/destroy/{{$a->id}}"><img src="{{asset('img/eliminar.png')}}"
                                    alt=""></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="pagination">{{$articulos->links()}}</div>
        </div>
        <div class="card-footer">
        </div>
    </div>
</div>
@endsection