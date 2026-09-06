@extends('principal.VPrincipal')
@section('contenido')
<!-- ================================
        VISTA EDIT ARTICULO
================================  -->

<div class="conteiner">
    <div class="card p-3">
        <div class="card-header">
            <h2>EDITAR ARTÍCULO</h2>
        </div>
        <div class="card-body">
            <form action="/articulo/update/{{$articulo->id}}" method="POST" enctype="multipart/form-data">
                {{csrf_field()}}
                <input type="hidden" name="_method" value="PUT">
                <div class="row">
                    <div class="col-lg-6 col-sm-12">
                        <input name="codigo" type="text" class="form-control mt-2" placeholder="Código..." value="{{$articulo->codigo}}" required>
                        <input name="nombre" type="text" class="form-control mt-2" placeholder="Nombre..." value="{{$articulo->nombre}}" required>
                        <select name="categoria" class="form-control mt-2" placeholder="Categoria..." required>
                            @foreach($categorias as $c)
                            @if($articulo->idCategoria == $c->id)
                            <option value="{{$c->id}}" selected>{{$c->nombre}}</option>
                            @else
                            <option value="{{$c->id}}">{{$c->nombre}}</option>
                            @endif
                            @endforeach
                        </select>
                        <input name="stock" type="number" class="form-control mt-2" placeholder="Stock..." value="{{$articulo->stock}}" required>
                    </div>
                    <div class="col-lg-6 col-sm-12">
                        <input id="archivoFoto" name="foto" type="file" class="form-control mt-2" placeholder="Foto..."><br>
                        <img id="imagen" src="{{asset('img/articulos/'.$articulo->foto)}}" alt="" class="img-fluid" style="height: 350px; width: 100%;">
                    </div>
                </div>
                <div class="row pt-5">
                    <div class="col">
                        <input type="submit" value="Actualizar" class="btn btn-info">
                        <a href="/articulo/index"><button class="btn btn-secondary" type="button">Cancelar</button></a>
                    </div>
                </div>
            </form>
        </div>
        <div class="card-footer">
        </div>
    </div>
</div>
<script>
    // **********************************************************     
    //         			CARGAR FOTO
    // **********************************************************

    // DATOS
    var img = document.getElementById('imagen');
    var archivoFoto = document.getElementById('archivoFoto');

    // PROCESO
    function cargarFoto(e) {
        // Se carga el Array cargado
        var archivo = e.target.files;
        // Se carga el primer elemento del array (FOTO)
        var mi_archivo = archivo[0];
        // Se verifica si es imagen o no
        if (!mi_archivo.type.match(/image/)) {
            alert("Selecciona una imagen");
        } else {
            var lector = new FileReader();
            // Se carga la direccion de la foto cargada
            lector.readAsDataURL(mi_archivo);
            lector.addEventListener('load', mostrarResultado);
        }
    }

    // RESULTADO
    function mostrarResultado(e) {
        var resultado = e.target.result;
        img.src = resultado;
    }

    // PRINCIPAL
    archivoFoto.addEventListener('change', cargarFoto);
</script>
@endsection