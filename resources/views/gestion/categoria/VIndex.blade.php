@extends('principal.VPrincipal')
@section('contenido')
<!-- ================================
         VISTA INDEX CATEGORIA
================================  -->

<div class="conteiner">
    <div class="card p-3" style="min-height: 80vh;">
        <div class="card-header">
            <h2>GESTIÓN DE CATEGORÍAS</h2>
        </div>
        <div class="card-body">
            <form action="/categoria/search" method="GET">
                <div class="row mt-5">
                    <div class="col-5">
                        <input type="text" name="criterio" class="form-control" placeholder="Buscar...">
                    </div>
                    <div class="col-7">
                        <button type="submit" class="btn btn-info">Buscar</button>
                        <a href="/categoria/create">
                            <button type="button" class="btn btn-success">Nuevo</button>
                        </a>
                    </div>
                </div>
            </form>
            <table id="tabla2" class="table mt-3">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">NOMBRE</th>
                        <th scope="col">DESCRIPCIÓN</th>
                        <th scope="col">UBICACIÓN</th>
                        <th>OPCIONES</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($categorias as $c)
                    <tr>
                        <th scope="row">{{$c->id}}</th>
                        <td>{{$c->nombre}}</td>
                        <td>{{$c->descripcion}}</td>
                        <td>{{$c->ubicacion}}</td>
                        <td>
                            <a href="/categoria/edit/{{$c->id}}"><img src="{{asset('img/editar.png')}}"
                                    alt=""></a> &nbsp;
                            <a href="/categoria/destroy/{{$c->id}}"><img src="{{asset('img/eliminar.png')}}"
                                    alt=""></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer">
        </div>
    </div>
</div>
@endsection