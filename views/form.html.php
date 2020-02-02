<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Prendre une commande</title>
</head>

<body>
    <h1>Prenez une commande très cher ! (et non pas très chère !)</h1>
    <form action="" method="post">
        <select name="product" id="product" required>
            <option value="">Choissiez un produit</option>
            <option value="chaise">Chaise</option>
            <option value="meuble">Meuble</option>
        </select>
        <input type="number" name="quantity" id="quantity" required placeholder="Quantité">
        <input type="tel" name="phone" id="phone" required placeholder="Numéro de téléphone">
        <button type="submit">Passer commande</button>
    </form>
</body>

</html>