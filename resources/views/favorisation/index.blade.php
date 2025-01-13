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

<div class="form-container">
    <form action="{{ route('favorisation.liste') }}" method="POST" class="favorisation-form">
        @csrf
        <div class="form-group">
            <label for="type">Type de faveur :</label>
            <select name="type" id="type" class="form-control">
                <option value="scolarite">Scolarité</option>
                <option value="cantine">Cantine</option>
            </select>
        </div>

        <div class="form-group">
            <label for="classe">Classe :</label>
            <select name="classe" id="classe" class="form-control">
                <option value="">Sélectionner une classe</option>
                <option value="maternelle1">Maternelle 1</option>
                <option value="maternelle2">Maternelle 2</option>
                <option value="maternelle3">Maternelle 3</option>
                <option value="cp1">CP1</option>
                <option value="cp2">CP2</option>
                <option value="ce1">CE1</option>
                <option value="ce2">CE2</option>
                <option value="cm1">CM1</option>
                <option value="cm2">CM2</option>
            </select>
        </div>

        <button type="submit" class="btn-submit">Continuer</button>
    </form>
</div>

<style>
/* Container Styling */
.form-container {
    max-width: 600px;
    margin: 50px auto;
    padding: 20px;
    background-color: #fff;
    border: 1px solid #ddd;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    font-family: Arial, sans-serif;
}

/* Form Styling */
.favorisation-form {
    display: flex;
    flex-direction: column;
    gap: 15px;
}

.form-group label {
    font-size: 16px;
    font-weight: bold;
    color: #3a3a3a;
    margin-bottom: 5px;
}

.form-group select,
.form-group input {
    padding: 10px;
    font-size: 14px;
    border: 1px solid #ccc;
    border-radius: 5px;
    width: 100%;
    box-sizing: border-box;
}

.btn-submit {
    background-color: #2b6cb0; /* Blue color */
    color: #fff;
    padding: 10px 15px;
    font-size: 16px;
    font-weight: bold;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    text-transform: uppercase;
    transition: background-color 0.3s ease;
}

.btn-submit:hover {
    background-color: #1a4f84; /* Darker blue */
}

/* Alert Messages */
.alert {
    padding: 10px;
    border-radius: 5px;
    margin-bottom: 20px;
    text-align: center;
    font-weight: bold;
}

.alert-danger {
    background-color: #f8d7da; /* Red alert */
    color: #721c24;
    border: 1px solid #f5c6cb;
}

.alert-success {
    background-color: #d4edda; /* Green alert */
    color: #155724;
    border: 1px solid #c3e6cb;
}

/* Responsive Design */
@media (max-width: 768px) {
    .form-container {
        padding: 15px;
    }

    .btn-submit {
        font-size: 14px;
        padding: 8px 10px;
    }
}
</style>

@endsection
