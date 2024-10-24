<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter du Stock</title>
</head>
<body>
    <h1>Ajouter du Stock</h1>
    <form action="{{ route('stocks.add') }}" method="POST">
        @csrf
        <table>
            <thead>
                <tr>
                    <th>Produit</th>
                    <th>Quantité Initiale</th>
                    <th>Quantité Ajoutée</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Macarons</td>
                    <td><input type="number" name="macarons_initial" value="0" min="0" required></td>
                    <td><input type="number" name="macarons_added" value="0" min="0" required></td>
                </tr>
                <tr>
                    <td>T-shirts</td>
                    <td><input type="number" name="tshirts_initial" value="0" min="0" required></td>
                    <td><input type="number" name="tshirts_added" value="0" min="0" required></td>
                </tr>
                <tr>
                    <td>Tissu Bleu</td>
                    <td><input type="number" name="tissu_bleu_initial" value="0" min="0" required step="0.01"></td>
                    <td><input type="number" name="tissu_bleu_added" value="0" min="0" required step="0.01"></td>
                </tr>
                <tr>
                    <td>Tissu Jaune</td>
                    <td><input type="number" name="tissu_jaune_initial" value="0" min="0" required step="0.01"></td>
                    <td><input type="number" name="tissu_jaune_added" value="0" min="0" required step="0.01"></td>
                </tr>
            </tbody>
        </table>
        <button type="submit">Ajouter le Stock</button>
    </form>
</body>
</html>
