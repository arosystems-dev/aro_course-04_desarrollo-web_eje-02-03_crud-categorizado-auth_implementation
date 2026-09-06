@extends('principal.VPrincipal')
@section('contenido')
<!-- ================================
        VISTA EDIT CATEGORIA
================================  -->

<div class="conteiner">
    <div class="card p-3">
        <div class="card-header">
            <h2>EDICIÓN DE CATEGORIA</h2>
        </div>
        <div class="card-body">
            <form action="/categoria/update/{{$categoria->id}}" method="POST">
                {{csrf_field()}}
                <input type="hidden" name="_method" value="PUT">
                <div class="row">
                    <div class="col-lg-8 col-sm-12">
                        <input name="nombre" value="{{$categoria->nombre}}" type="text" class="form-control mt-2" placeholder="Nombre..." required maxlength="50">
                        @if ($errors->has('nombre'))
                        <div class="alert alert-danger">{{ $errors->first('nombre') }}</div>
                        @endif
                        <input name="descripcion" value="{{$categoria->descripcion}}" type="text" class="form-control mt-2" placeholder="Descripción..." maxlength="200">
                        @if ($errors->has('descripcion'))
                        <div class="alert alert-danger">{{ $errors->first('descripcion') }}</div>
                        @endif
                        <input name="ubicacion" value="{{$categoria->ubicacion}}" type="text" class="form-control mt-2" placeholder="Ubicación..." maxlength="50">
                        @if ($errors->has('ubicacion'))
                        <div class="alert alert-danger">{{ $errors->first('ubicacion') }}</div>
                        @endif

                    </div>
                </div>
                <div class="row pt-5">
                    <div class="col">
                        <input type="submit" value="Actualizar" class="btn btn-info">
                        <a href="/categoria/index"><button class="btn btn-secondary" type="button">Cancelar</button></a>
                    </div>
                </div>
            </form>
        </div>
        <div class="card-footer">
        </div>
    </div>
</div>
@endsection