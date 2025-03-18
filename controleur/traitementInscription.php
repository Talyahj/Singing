<?php 

include_once "../modele/db.php";

if(isset($_POST['pseudoU'], $_POST['mailU'], $_POST['mdpU'])) {
    // Vérifier si les champs ne sont pas vides
    if(!empty($_POST['pseudoU']) && !empty($_POST['mailU']) && !empty($_POST['mdpU'])) {
        $pseudoU = $_POST['pseudoU'];
        $mailU = $_POST['mailU'];
        $mdpU = $_POST['mdpU'];

        // Vérifier si le mot de passe a au moins 8 caractères
        if(strlen($mdpU) < 8) {
            echo "<script>alert('Le mot de passe doit avoir au moins 8 caractères.'); window.location.href = '../vue/vueInscription.php';</script>";
        } else {
            // Vérifier si le pseudo est différent
            $requete_verif_pseudo = $bdd->prepare("SELECT COUNT(*) FROM utilisateur WHERE pseudoU = :pseudoU");
            $requete_verif_pseudo->execute(array("pseudoU" => $pseudoU));
            $count_pseudo = $requete_verif_pseudo->fetchColumn();

            if($count_pseudo > 0) {
                echo "<script>alert('Ce pseudo est déjà utilisé. Veuillez en choisir un autre.'); window.location.href = '../vue/vueInscription.php';</script>";
            } else {
                $requete_verif_compte = $bdd->prepare("SELECT COUNT(*) FROM utilisateur WHERE mailU = :mailU");
                $requete_verif_compte->execute(array("mailU" => $mailU));
                $count_compte = $requete_verif_compte->fetchColumn();

                if($count_compte > 0) {
                    echo "<script>alert('Un compte existe déjà avec cette adresse email.'); window.location.href = '../vue/vueInscription.php';</script>";
                } else {
                    $requete = $bdd->prepare("INSERT INTO utilisateur (mailU, mdpU, pseudoU) VALUES (:mailU, :mdpU, :pseudoU)");
                    $requete->execute(array(
                        "mailU" => $mailU,
                        "mdpU" => $mdpU,
                        "pseudoU" => $pseudoU
                    ));

                    session_start();
                    $_SESSION['pseudo'] = $pseudoU;

                    echo "<script>alert('Inscription réussie !');</script>";
                    include "../vue/vueConfirmationU.php";
                }
            }
        }
    } else {
        echo "<script>alert('Veuillez remplir tous les champs du formulaire.'); window.location.href = '../vue/vueInscription.php';</script>";
    }
}
?>