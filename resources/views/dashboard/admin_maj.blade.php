@section('content')

<!-- Content Row -->
<div class="row">

    <!-- Bloc 1 : Nombre total d'élèves -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Nombre total d'élèves</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalEleves }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-user-graduate fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bloc 2 : Total des fonds de scolarité encaissés -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                            Fonds total scolarité encaissé</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ number_format($totalScolarite, 2, ',', '
                            ') }} FCFA</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bloc 3 : Fonds encaissés cantine -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                            Fonds encaissés cantine</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ number_format($totalCantine, 2, ',', ' ')
                            }} FCFA</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-utensils fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bloc 4 : scolarité encaissé aujourd'hui -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                            scolarité encaissé aujourd'hui</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ number_format($scolariteToday, 2, ',', '
                            ') }} FCFA</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bloc 4 : Cantine encaissé aujourd'hui 
<div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-info shadow h-100 py-2">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                        cantine encaissé aujourd'hui</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ number_format($cantineToday, 2, ',', ' ') }} FCFA</div>
                </div>
                <div class="col-auto">
                    <i class="fas fa-utensils fa-2x text-gray-300"></i>
                </div>
            </div>
        </div>
    </div>
</div>
-->

    <!-- Content Row -->

    <div class="row">

        <!-- Area Chart -->
        <div class="col-xl-8 col-lg-7">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Évolution des Paiements</h6>
                    <div class="dropdown no-arrow">
                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                            aria-labelledby="dropdownMenuLink">
                            <div class="dropdown-header">Options :</div>
                            <a class="dropdown-item" onclick="updateChartData('scolarite')">Scolarité</a>
                            <a class="dropdown-item" onclick="updateChartData('cantine')">Cantine</a>
                        </div>
                    </div>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="chart-area">
                        <canvas id="myAreaChart"></canvas>
                    </div>
                </div>

            </div>
        </div>

    </div>




</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->
<pre>
    {!! json_encode($scolariteParMois) !!}
</pre>

<!-- Footer -->
<footer class="sticky-footer bg-white">
    <div class="container my-auto">
        <div class="copyright text-center my-auto">
            <span>Copyright &copy; Your Website 2021</span>
        </div>
    </div>
</footer>
<!-- End of Footer -->

</div>
<!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <a class="btn btn-primary" href="{{ route('logoutpro') }}">Logout</a>
            </div>
        </div>
    </div>
</div>
<!--<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>-->

<script src="{{ asset('vendor/chart.js/Chart.js') }}"></script>
<script src="{{ asset('js/demo/chart-area-demo.js') }}"></script>

<script>
    //const labels = Object.keys(@json($scolariteParMois));
    const scolariteData = Object.values(@json($scolariteParMois));
    const cantineData = Object.values(@json($cantineParMois));

    // Liste des noms des mois en français
const moisNoms = [
    "Janvier", "Février", "Mars", "Avril", "Mai", "Juin",
    "Juillet", "Août", "Septembre", "Octobre", "Novembre", "Décembre"
];

// Utiliser les clés des données pour associer les mois
const labels = Object.keys(@json($scolariteParMois)).map(mois => {
    const moisIndex = parseInt(mois, 10) - 1; // Convertir en index (1 pour Janvier, 2 pour Février, etc.)
    return moisNoms[moisIndex] || ` ${mois}`; // Défaut si le mois est invalide
});

    function updateChartData(type) {
    console.log('Type sélectionné :', type);
    if (type === 'cantine') {
        myLineChart.data.datasets[0].data = cantineData;
    } else {
        myLineChart.data.datasets[0].data = scolariteData;
    }
    myLineChart.update();
}


</script>

@endsection