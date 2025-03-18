<?php
session_start();
include "../modele/db.php";
include "../modele/database.php";

$albums = getAlbums();
$artistes = getArtistes();

// Add album
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_album'])) {
    $titre = $_POST['titre'];
    $prix = $_POST['prix'];
    $photo = $_POST['photo'];
    $anneeSortie = $_POST['anneeSortie'];
    $nomArtiste = $_POST['nomArtiste'];

    // Add album only if artist name is not empty
    if (!empty($nomArtiste)) {
        addAlbum($titre, $prix, $photo, $anneeSortie, $nomArtiste);
    } else {
        echo "<script>alert('Veuillez fournir un nom d'artiste');</script>";
    }
}

// Delete album
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete_album'])) {
    $albumId = $_POST['album_id'];
    deleteAlbum($albumId);
}

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Albums ⎸ SingLouder</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="../style/styleAA.css" type="text/css" rel="stylesheet">
</head>

<body>

    <header>
        <div class="container">
            <div class="navbar-top">
                <div class="search-bar">
                    <input type="text" placeholder="Rechercher...">
                </div>
                <div class="logo">
                    <a href="../vue/admin_artistes.html"><img src="../img/logo.png" alt="" width="200px"></a>
                </div>
                <div class="icons">
                    <a href="../vue/vueConfirmationA.php"><img src="../img/inscription.webp" alt="compte" width="40px"></a>
                </div>

            </div>
        </div>

        <div class="main-content">
            <nav class="navbar navbar-expand-sm bg-bisque justify-content-center sticky-top">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="../vue/admin_artistes.html">Artistes</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../vue/admin_albums.php">Albums</a>
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
        <div class="add-album-form">
            <h2>Ajouter un nouvel album</h2>
            <form action="" method="post">
                <div class="mb-3">
                    <label for="titre" class="form-label">Titre:</label>
                    <input type="text" id="titre" name="titre" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="prix" class="form-label">Prix:</label>
                    <input type="text" id="prix" name="prix" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="photo" class="form-label">Photo:</label>
                    <input type="text" id="photo" name="photo" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="anneeSortie" class="form-label">Année de sortie:</label>
                    <input type="text" id="anneeSortie" name="anneeSortie" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="nomArtiste" class="form-label">Nom de l'artiste:</label> <br>
                        <select id="nomArtiste" name="nomArtiste" class="form-select" aria-label="Default select example">
                            <option value="Tiakola">Tiakola</option>
                            <option value="SZA">SZA</option>
                            <option value="Justin Bieber">Justin Bieber</option>
                            <option value="purpose">Aya Nakamura</option>
                        </select>
                </div>
                <button type="submit" class="btn btn-secondary" name="add_album">Ajouter Album</button>
            </form>
        </div>
        <div class="albums-list">
            <h2>Liste des albums</h2>
            <div class="whole">
                <?php foreach ($albums as $album): ?>
                    <div class="album">
                        <h5 class="nom_ART"><a href="../vue/artistes.html"><?php echo $album['titreAlb']; ?></a></h5>
                        <div><a href="../vue/<?php echo $album['photo']; ?>"><img src="../img/<?php echo $album['photo']; ?>"></a></div>
                        <h4 class="nom_ART"><a href="../vue/<?php echo $album['photo']; ?>"><?php echo $album['titreAlb']; ?> - <?php echo $album['prix']; ?>€</a></h4>
                        <form method="post">
                            <button type="submit" class="btn btn-danger" name="delete_album">Supprimer</button>
                            <input type="hidden" name="album_id" value="<?php echo $album['idAlbum']; ?>">
                        </form>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</main>

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
