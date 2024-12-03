@extends("navbarmodel.navbar")
@section("title", "")
@section("content")
<!-- Ajouter Font Awesome pour les icônes -->



<main class="page-content">
    

   
    <div class="card">
        <div class="content">
            <h2 class="title"><mark style="color: green">REQUETES</mark></h2>
            <a href="{{url('/requetes')}}"><button class="btn">Acceder</button></a>
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
