@extends("navbarmodel.navbar")
@section("title", "")
@section("content")
<!-- Ajouter Font Awesome pour les icônes -->



<main class="page-content">
    

    <div class="card">
        <div class="content">
            <h2 class="title"><mark style="color: green">SCOLARITE</mark></h2>
            <a href="{{url('/menuscolarite')}}"><button class="btn">Acceder</button></a>
        </div>
    </div>
    <div class="card">
        <div class="content">
            <h2 class="title"><mark style="color: green">REQUETES</mark></h2>
            <a href="{{url('/requetes')}}"><button class="btn">Acceder</button></a>
        </div>
    </div>
    <div class="card">
        <div class="content">
            <h2 class="title"><mark style="color: green">INSCRIPTION</mark></h2>
            <a href="{{url('/inscription')}}"><button class="btn">Acceder</button></a>
        </div>
    </div>
    <div class="card">
        <div class="content">
            <h2 class="title"><mark style="color: green">CANTINE</mark></h2>
            <a href="{{url('/menucantine')}}"><button class="btn">INSCRIPTION</button></a>
            <a href="{{ url('/pagemiseajourcantine') }}"><button class="btn">MISE A JOUR</button></a>
            <a href="{{route('cantine_jour.form')}}"><button class="btn">CANTINE JOUR</button></a>
        </div>
    </div>

    <div class="card">
        <div class="content">
            <h2 class="title"><mark style="color: green">TRANSPORT</mark></h2>
            <a href="{{url('/menutransport')}}"><button class="btn">INSCRIPTION</button></a>
            <a href="{{ url('/pagemiseajourtransport') }}"><button class="btn">MISE A JOUR</button></a>
        </div>
    </div>

    <div class="card">
        <div class="content">
            <h2 class="title"><mark style="color: green">INFORMATIQUE</mark></h2>
            <a href="{{url('/menuinformatique')}}"><button class="btn">INSCRIPTION</button></a>
            <a href="{{ url('/pagemiseajourinformatique') }}"><button class="btn">MISE A JOUR</button></a>
        </div>
    </div>

    <div class="card">
        <div class="content">
            <h2 class="title"><mark style="color: green">PISCINE</mark></h2>
            <a href="{{url('/menupiscine')}}"><button class="btn">INSCRIPTION</button></a>
            <a href="{{ url('/pagemiseajourpiscine') }}"><button class="btn">MISE A JOUR</button></a>
        </div>
    </div>

    <div class="card">
        <div class="content">
            <h2 class="title"><mark style="color: green">MUSIQUE</mark></h2>
            <a href="{{url('/menumusique')}}"><button class="btn">INSCRIPTION</button></a>
            <a href="{{ url('/pagemiseajourmusique') }}"><button class="btn">MISE A JOUR</button></a>
        </div>
    </div>

    <div class="card">
        <div class="content">
            <h2 class="title"><mark style="color: green">CAFETARIAT</mark></h2>
            <a href="{{url('/menucafetariat')}}"><button class="btn">Acceder</button></a>
        </div>
    </div>

    <div class="card">
        <div class="content">
            <h2 class="title"><mark style="color: green">VENTES</mark></h2>
            <a href="{{url('/ventes')}}"><button class="btn">ACCEDER</button></a>
        </div>
    </div>

    <div class="card">
        <div class="content">
            <h2 class="title"><mark style="color: green">DECAISSEMENTS</mark></h2>
            <a href="{{url('/decaissements')}}"><button class="btn">ACCEDER</button></a>
        </div>
    </div>

    <div class="card">
        <div class="content">
            <h2 class="title"><mark style="color: green">CANTINE JOUR</mark></h2>
            <a href="{{url('/cantinejour')}}"><button class="btn">ACCEDER</button></a>
        </div>
    </div>

    <div class="card">
        <div class="content">
            <h2 class="title"><mark style="color: green">RECHERCHER REÇU/TRANSACTION SCOLARITE</mark></h2>
            <a href="{{ route('recherche.recu') }}"><button class="btn">ACCEDER</button></a>
        </div>
    </div>

    <div class="card">
        <div class="content">
            <h2 class="title"><mark style="color: green">RECHERCHER REÇU/TRANSACTION CANTINE</mark></h2>
            <a href="{{ route('recherche.recucant') }}"><button class="btn">ACCEDER</button></a>
        </div>
    </div>

    <div class="card">
        <div class="content">
            <h2 class="title"><mark style="color: green">RECHERCHER REÇU/TRANSACTION TRANSPORT</mark></h2>
            <a href="{{ route('recherche.recutrans') }}"><button class="btn">ACCEDER</button></a>
        </div>
    </div>

    <div class="card">
        <div class="content">
            <h2 class="title"><mark style="color: green">RECHERCHER REÇU/TRANSACTION CANTINE JOUR</mark></h2>
            <a href="{{ route('recherche.recucantjour') }}"><button class="btn">ACCEDER</button></a>
        </div>
    </div>

    <!--<div class="card">
        <div class="content">
            <h2 class="title"><mark style="color: green">PAYEMENT</mark></h2>
            <a href="{{ url('/payement') }}"><button class="btn">ACCEDER</button></a>
        </div>
    </div>-->

    
</main>

<!-- Styles pour les icônes et les cartes de statistiques -->
<style>
    .statistics {
        display: flex;
        justify-content: space-around;
        margin-bottom: 20px;
    }

    .stat-card {
        display: flex;
        align-items: center;
        background-color: #f8f9fa;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .stat-icon {
        font-size: 50px;
        color: #007bff;
        margin-right: 20px;
    }

    .stat-info h3 {
        margin: 0;
        font-size: 18px;
        color: #333;
    }

    .stat-info p {
        margin: 5px 0 0;
        font-size: 24px;
        font-weight: bold;
        color: #007bff;
    }
</style>
@endsection
