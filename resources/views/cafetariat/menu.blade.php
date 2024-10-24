<!-- resources/views/cafetariat/menu.blade.php -->
@extends("navbarmodel.navbar")
@section("title", "Menu Cafetariat")
@section("content")

<main class="page-content">
    <div class="card">
        <div class="content">
            <h2 class="title"><mark style="color: red;border-radius:3px">Nouvel Enregistrement</mark></h2>
            <a href="{{url('/cafetariat/nouveau')}}"><button class="btn">Acceder</button></a>
        </div>
    </div>
    <div class="card">
        <div class="content">
            <h2 class="title"><mark style="color: red">Recettes du Jour</mark></h2>
            <a href="{{ route('cafetariat.recettesJour') }}"><button class="btn">Acceder</button></a>
        </div>
    </div>
    <div class="card">
        <div class="content">
            <h2 class="title"><mark style="color: red">Rechercher un Enregistrement</mark></h2>
            <a href="#"><button class="btn">Acceder</button></a>
        </div>
    </div>
    <div class="card">
        <div class="content">
            <h2 class="title"><mark style="color: red">Liste abonnés du jour</mark></h2>
            <a href="{{ route('cafetariat.abonnesJour') }}"><button class="btn">Acceder</button></a>
        </div>
    </div>
    <div class="card">
        <div class="content">
            <h2 class="title"><mark style="color: red">Liste des Recettes Périodiques</mark></h2>
            <a href="{{ route('cafetariat.recettes.periodiques.form') }}"><button class="btn">Acceder</button></a>
        </div>
    </div>
</main>

@endsection
