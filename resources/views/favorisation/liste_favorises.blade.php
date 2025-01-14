<h3>Liste des élèves favorisés</h3>
<p>Type : {{ $type }}</p>
<p>Classe : {{ $classe == 'toutes' ? 'Toutes les classes' : ucfirst($classe) }}</p>

@if($eleves->isEmpty())
    <p>Aucun élève favorisé pour cette sélection.</p>
@else
    <table border="1">
        <thead>
            <tr>
                <th>N°</th>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Classe</th>
            </tr>
        </thead>
        <tbody>
            @php $numero = 1; @endphp
            @foreach($eleves as $eleve)
                <tr>
                    <td>{{ $numero++ }}</td>
                    <td>{{ $eleve->nom }}</td>
                    <td>{{ $eleve->prenom }}</td>
                    <td>
                        @if($type === 'scolarite')
                            {{ $eleve->classe }}
                        @elseif($type === 'cantine')
                            {{ $eleve->eleve->classe }}
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endif

<style>
/* CSS Splendide */
table {
    width: 100%;
    border-collapse: collapse;
    margin: 20px 0;
    font-size: 16px;
    text-align: left;
    background-color: #ffffff;
    border-radius: 8px;
    overflow: hidden;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

table thead tr {
    background-color: #0056b3;
    color: #ffffff;
    text-transform: uppercase;
    letter-spacing: 0.03em;
}

table th, table td {
    padding: 12px 15px;
}

table tbody tr:nth-child(even) {
    background-color: #f2f2f2;
}

table tbody tr:nth-child(odd) {
    background-color: #fafafa;
}

table tbody tr:hover {
    background-color: #ffe6cc;
    cursor: pointer;
}

table th, table td {
    border-bottom: 1px solid #dddddd;
}

h3 {
    font-size: 24px;
    color: #0056b3;
    margin-bottom: 10px;
    text-align: center;
    font-family: 'Arial', sans-serif;
}

p {
    font-size: 16px;
    color: #7a5230;
    text-align: center;
    margin: 10px 0;
    font-family: 'Verdana', sans-serif;
}
</style>
