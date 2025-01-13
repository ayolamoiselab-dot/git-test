@extends('navbarmodel.navbar2')
@section('content')

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif
<form action="{{ route('favorisation.favoriser') }}" method="POST">
    @csrf
    <input type="hidden" name="type" value="{{ $type }}">
    <table>
        <tr>
            <th>Nom</th>
            <th>Classe</th>
            <th>Favoriser</th>
        </tr>
        @foreach($eleves as $eleve)
        <tr>
            <td>{{ $eleve->nom }}</td>
            <td>{{ $eleve->classe }}</td>
            <td><input type="checkbox" name="ids[]" value="{{ $eleve->id_eleve }}"></td>
        </tr>
        @endforeach
    </table>
    <button type="submit">Favoriser</button>
</form>

<style>
    .alert alert-danger {
      color: red;
      font-weight: bold;
      margin-top: 10px;
  }

  .alert alert-success {
      color: green;
      font-weight: bold;
      margin-top: 10px;
  }
</style>
@endsection