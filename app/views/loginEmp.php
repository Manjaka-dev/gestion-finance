<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <form action="doLogin" method="POST">
        <label for="nom">Nom : </label>
        <input type="text" name="nom" id="nom" placeholder="ex: Rahantamalala">

        <label for="prenom">Prenom : </label>
        <input type="text" name="prenom" id="prenom" placeholder="ex: Elyance">

        <label for="departement">Departement : </label>
        <select name="departement" id="departement">
            <option value="" disabled selected>Choisissez un departement</option>
            <option value=""></option>
        </select>

        <label for="mdp">Mot de passe : </label>
        <input type="password" name="mdp" id="mdp" placeholder="ex: mdp=2$5·6//">

        <button type="submit">Se connecter</button>
    </form>

</body>
</html>