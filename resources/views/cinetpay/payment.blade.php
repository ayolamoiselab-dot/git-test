@extends("navbarmodel.navbar")
@section("title", "")
@section("content")



@if(isset($erreur))
    <div class="alert alert-danger">
        {{ $erreur }}
    </div>
    @endif

<form action="{{ route('cinetpay.payment') }}" method="POST">
    @csrf
    <label for="name">Nom</label>
    <input type="text" name="name" required>
    
    <label for="email">Email</label>
    <input type="email" name="email" required>

    <label for="phone">Téléphone</label>
    <input type="text" name="phone" required>

    <label for="amount">Montant</label>
    <input type="number" name="amount" required>

    <button type="submit">Payer</button>
</form>
<style>
     .alert alert-danger {
        color: red;
        font-weight: bold;
        margin-top: 10px;
    }
</style>

@endsection