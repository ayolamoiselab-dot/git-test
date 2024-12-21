@extends("navbarmodel.navbar2")
@section("title", "")
@section("content")

@if(Auth::user()->role == 'admin' || Auth::user()->is_admin)
    @include('dashboard.admin_maj', [
        'totalEleves' => $totalEleves,
        'totalScolarite' => $totalScolarite,
        'totalCantine' => $totalCantine,
        'scolariteToday' => $scolariteToday,
        'cantineToday' => $cantineToday,
        'scolariteParMois' => $scolariteParMois,
        'cantineParMois' => $cantineParMois,
        'scolariteData' => json_encode(array_values($scolariteParMois)),
        'cantineData' => json_encode(array_values($cantineParMois)),
    ])
@elseif(Auth::user()->role == 'secretaire')
    @include('dashboard.secretaire')
@elseif(Auth::user()->role == 'controlleur')
    @include('dashboard.controlleur')
@else
    <p>Vous n'avez pas les droits nécessaires pour accéder à cette section.</p>
@endif

@endsection
