@extends("navbarmodel.navbar2")
@section("title", "Gestion des Décaissements")
@section("content")
<main class="page-content">
    <div class="card">
        <div class="content">
            <h2 class="title"><mark style="color: red">Nouveau Décaissement</mark></h2>
            <a href="{{url('/decaissements/nouveau')}}"><button class="btn">Acceder</button></a>
        </div>
    </div>
    <div class="card">
        <div class="content">
            <h2 class="title"><mark style="color: red">Décaissements du Jour</mark></h2>
            <a href="{{route('decaissements.jour')}}"><button class="btn">Acceder</button></a>
        </div>
    </div>
    <div class="card">
        <div class="content">
            <h2 class="title"><mark style="color: red">Rechercher un Décaissement</mark></h2>
            <a href="{{url('/decaissement/rechercher')}}"><button class="btn">Acceder</button></a>
        </div>
    </div>
    <div class="card">
        <div class="content">
            <h2 class="title"><mark style="color: red">Liste des Décaissements Périodiques</mark></h2>
            <a href="{{url('/decaissement/periodiques')}}"><button class="btn">Acceder</button></a>
        </div>
    </div>
</main>




@endsection
