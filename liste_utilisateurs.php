<?php
include "../modele/db.php";

$users = getUsers();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <title>Liste des utilisateurs ⎸ SingLouder</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="../style/stylelo.css" type="text/css" rel="stylesheet">
</head>
<body>
    <header>
    <div class="container">
            <div class="navbar-top">
                <div class="search-bar">
                    <input type="text" placeholder="Rechercher...">
                </div>
                <div class="logo">
                    <a href="../vue/artistes.html"><img src="../img/logo.png" alt="" width="200px"></a> 
                </div>
                <div class="icons">
                    <a href="../controleur/deconnexion.php" class="btn">Déconnexion</a>
                    <a href="../vue/admin_albums.php" class="btn">Albums</a>
                    <a href="../vue/utilisateurs.php" class="btn">Utilisateurs</a>
                </div>

            </div>
        </div>
         
        <div class="main-content">
        <nav class="navbar navbar-expand-sm bg-bisque justify-content-center sticky-top">
            <ul class="navbar-nav">
              <li class="nav-item">
                <a class="nav-link" href="../vue/artistes.html">Artistes</a>
              </li> 
              <li class="nav-item">
                <a class="nav-link" href="../vue/albums.html">Albums</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="../vue/form.html">Formulaire</a>
              </li>
            </ul>
          </nav>
       </div>
    </header>
    <div class="container">
        <h2>Liste des utilisateurs</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Pseudo</th>
                    <th>Email</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user): ?>
                <tr>
                    <td><?php echo $user['pseudoU']; ?></td>
                    <td><?php echo $user['mailU']; ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
