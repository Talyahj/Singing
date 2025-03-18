<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

try {
    $bdd = new PDO('mysql:host=localhost;dbname=SING;charset=utf8', 'root', '');
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Erreur : ' . $e->getMessage();
    die();
}

function addAlbum($titre, $prix, $photo, $anneeSortie, $nomArtiste) {
    global $bdd;

    // Check if the artist exists, if not, add the artist
    $idArtiste = getOrCreateArtist($nomArtiste);

    $sql = "INSERT INTO albums (titreAlb, prix, photo, anneeSortie, idArtiste) VALUES (:titre, :prix, :photo, :anneeSortie, :idArtiste)";
    $stmt = $bdd->prepare($sql);

    $stmt->execute([
        ':titre' => $titre,
        ':prix' => $prix,
        ':photo' => $photo,
        ':anneeSortie' => $anneeSortie,
        ':idArtiste' => $idArtiste
    ]);
}

function getArtistes() {
    global $bdd;
    $sql = "SELECT * FROM artistes";
    $stmt = $bdd->query($sql);
    $artistes = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $artistes;
}

function artistExists($nomArtiste) {
    global $bdd;
    $sql = "SELECT COUNT(*) AS count FROM artistes WHERE nomArt = :nomArtiste";
    $stmt = $bdd->prepare($sql);
    $stmt->bindParam(':nomArtiste', $nomArtiste);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result['count'] > 0;
}

function addArtiste($nomArtiste) {
    global $bdd;
    
    echo "Nom Artiste: $nomArtiste"; // For debugging

    $sql = "INSERT INTO artistes (nomArt) VALUES (:nomArtiste)";
    $stmt = $bdd->prepare($sql);
    $stmt->execute([':nomArtiste' => $nomArtiste]);
    return $bdd->lastInsertId(); // Return the last inserted ID
}


function getArtistId($nomArtiste) {
    global $bdd;

    $sql = "SELECT idArtiste FROM artistes WHERE nomArt = :nomArtiste";
    $stmt = $bdd->prepare($sql);
    $stmt->bindParam(':nomArtiste', $nomArtiste);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result) {
        return $result['idArtiste'];
    } else {
        return false;
    }
}

function getAlbums() {
    global $bdd;
    $sql = "SELECT * FROM albums";
    $stmt = $bdd->query($sql);
    $albums = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $albums;
}

function getOrCreateArtist($nomArtiste) {
    global $bdd;

    $idArtiste = getArtistId($nomArtiste);
    if (!$idArtiste) {
        $idArtiste = addArtiste($nomArtiste);
        if (!$idArtiste) {
            throw new Exception("Failed to create artist.");
        }
    }
    return $idArtiste;
}

function deleteAlbum($idAlbum) {
    global $bdd;
    $sql = "DELETE FROM albums WHERE idAlbum = :idAlbum";
    $stmt = $bdd->prepare($sql);
    $stmt->bindParam(':idAlbum', $idAlbum);
    $stmt->execute();
}
?>
