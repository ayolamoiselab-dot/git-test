@extends('navbarmodel.navbar')

@section('content')
<h2>Register New User</h2>
<form method="POST" action="{{ route('store-user') }}">
    @csrf
    <div>
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required>
    </div>
    <div>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
    </div>
    <div>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
    </div>
    <div>
        <label for="password_confirmation">Confirm Password:</label>
        <input type="password" id="password_confirmation" name="password_confirmation" required>
    </div>
    <div>
        <label for="role">Rôle :</label>
        <select name="role" id="role" class="form-control" required>
            <option value="user">Utilisateur</option>
            <option value="admin">Administrateur</option>
            <option value="accountant">Comptable</option>
        </select>
    </div>
    <button type="submit">Register</button>
</form>
@endsection
