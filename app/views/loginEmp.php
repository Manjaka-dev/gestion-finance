<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        section{
            display: flex;
            border: 1px solid black;
            height: 200px;
            width: 50%;
            margin: auto;
        }
        form{
            display: flex;
            flex-direction: column;
            height: 100vh;
            align-items: start;
            padding: 20px;
        }

    </style>
</head>
<body>

    <section>
        <form action="employe/doLogin" method="POST">
            <label for="nom">Nom : </label>
            <input type="text" name="nom" id="nom" placeholder="ex: Rahantamalala">

            <label for="prenom">Prenom : </label>
            <input type="text" name="prenom" id="prenom" placeholder="ex: Elyance">

            <label for="departement">Departement : </label>
            <select name="departement" id="departement">
                <option value="" disabled selected>Choisissez un departement</option>
                <?php foreach($depts as $dept): ?>
                    <option value="<?= $dept['id_dept'] ?>"><?= $dept['nom_dept'] ?></option>
                <?php endforeach; ?>
            </select>

            <label for="mdp">Mot de passe : </label>
            <input type="password" name="mdp" id="mdp" placeholder="ex: mdp=2$5·6//">

            <button type="submit">Se connecter</button>
        </form>
    </section>
    
</body>
</html>