@extends("navbarmodel.navbar")
@section("title", "")
@section("content")

@if(Auth::user()->role == 'admin' || Auth::user()->is_admin)
    @include('dashboard.admin') <!-- Fichier spécifique pour les admins -->
@elseif(Auth::user()->role == 'secretaire')
    @include('dashboard.secretaire') <!-- Fichier pour comptables -->
@elseif(Auth::user()->role == 'controlleur')
    @include('dashboard.controlleur') <!-- Fichier pour comptables -->
@else
    <!-- Contenu par défaut -->
    <p>Vous n'avez pas les droits nécessaires pour accéder à cette section.</p>
@endif

@endsection
