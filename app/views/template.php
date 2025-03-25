<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="assets/css/template.css">
</head>
<body>
    <nav>
        <ul>
            <li><a href=""><button>Ajoute data</button></a></li>
            <li><a href=""><button>Voir data</button></a></li>
            <li><a href=""><button>formulaire</button></a></li>
        </ul>
    </nav>
    <main>
    <?php if (isset($page)) { include($page . '.php'); } else { echo '<p>Page non trouvée.</p>'; } ?>
    </main>
</body>
</html>