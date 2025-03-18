<?php
session_start();
include "../modele/db.php";
include "../modele/database.php";

$albums = getAlbums();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <title>Albums ⎸ SingLouder</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="../style/styleAlbs.css" type="text/css" rel="stylesheet">
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
                    <a href="../vue/vueInscription.php"><img src="../img/inscription.webp" alt="inscription" width="30px"></a>
                    <a href="../vue/vueInscription.php"><img src="../img/shopping.webp" alt="like" width="30px"></a>
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
                <a class="nav-link" href="../vue/albums.php">Albums</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="../vue/form.html">Formulaire</a>
              </li>
            </ul>
          </nav>
        <div class="content">
            <h1>ALBUMS</h1>
        </div>
       </div>
    </header>
    <main>
    <div class="whole">
        <?php foreach ($albums as $album): ?>
            <div class="album">
                <h5 class="nom_ART"><a href="../vue/artistes.html"><?php echo $album['titreAlb']; ?></a></h5>
                <div><a href="../vue/<?php echo $album['photo']; ?>"><img src="../img/<?php echo $album['photo']; ?>"></a></div>
                <h4 class="nom_ART"><a href="../vue/<?php echo $album['photo']; ?>"><?php echo $album['titreAlb']; ?> - <?php echo $album['prix']; ?>€</a></h4>
                <form method="post">
                    <button type="button" class="btn btn-danger" onclick="showAlert(this)" data-bs-toggle="popover" data-bs-placement="top">Ajouter au panier</button>
                    <input type="hidden" name="id_album" value="<?php echo $album['idAlbum']; ?>">
                </form>
            </div>
        <?php endforeach; ?>
    </div>
</main>

<div id="popover-content" class="d-none">
    <p>Inscris-toi pour ajouter au panier</p>
</div>

<script>
    function showAlert(btn) {
        var popover = new bootstrap.Popover(btn, {
            content: document.getElementById('popover-content').innerHTML,
            html: true,
        });
        popover.show();
    }
</script>
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col">
                    <ul>
                        <li><a href="../vue/mentions.html">Mentions Légales</a></li>
                        <li><a href="../vue/CGU.html">CGU</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body> 
</html>
