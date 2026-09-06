@extends('principal.VPrincipal')
@section('contenido')
<!-- ================================
        VISTA DASHBOARD
================================  -->

<div class="conteiner">
    <div class="card p-3" style="height:80vh">
        <div class="card-header">
            <h2>DASHBOARD</h2>
        </div>
        <div class="card-body">
            <div class="row justify-content-end text-center">
                <div class="col-lg-2 col-sm-4 p-4 bg-primary-subtle">Categorías <br>
                    <h4>{{$cantidadC}}</h4>
                </div>
                <div class="col-lg-2 col-sm-4 p-4 ms-3 bg-success-subtle"> Artículos <br>
                    <h4>{{$cantidadA}}</h4>
                </div>
            </div>
            <div>
                <canvas id="grafico" style="height: 40vh; width:100%"></canvas>
            </div>
        </div>
        <div class="card-footer">
        </div>
    </div>
</div>

<!-- ------- SCRIPT ----------- -->
<script src="{{asset('js/chart.js')}}"></script>
<script>
    const ctx = document.getElementById('grafico');

    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: @json($nombres),
            datasets: [{
                label: 'REPORTE DE STOCK',
                data: @json($stocks),
                borderWidth: 1
            }]
        },
        options: {
            indexAxis: 'x',
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>
@endsection