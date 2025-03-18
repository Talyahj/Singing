<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/stylelo.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Connexion ⎸ SingLouder</title>
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
    
  <div class="wrapper">
    <div class="container main">
        <div class="row">
            <div class="col-md-6 side-image">
                
                <div class="text">
                    <p>Ecoutez vos artistes préférés et chantez avec eux !</br> <i>Inscrivez vous pour acheter des albums</i></p>
                </div>
                
            </div>

            <div class="col-md-6 right">
        <form method="POST" action="../controleur/traitementAuthentification.php">
            <div class="input-box">
                <header>Connexion</header>
                <div class="input-field">
                    <input type="text" class="input" id="mailU" name="mailU" required="" autocomplete="on">
                    <label for="email">Email</label>
                </div>
                <div class="input-field">
                    <input type="password" class="input" id="mdpU" name="mdpU" required="">
                    <label for="pass">Mot de Passe</label>
                </div>
                <div class="input-field">
    <select class="input" id="type_utilisateur" name="type_utilisateur" required="">
        <option value="">Choisir le type d'utilisateur</option>
        <option value="utilisateur">Utilisateur</option>
        <option value="artiste">Admin</option>
    </select>
</div>
                <div class="input-field">
                        <input type="submit" class="submit" value="Connexion">
                   </div> 
                <div class="signin">
                    <span>Vous n'avez pas de compte ? <a href="../vue/vueInscription.php">Inscrivez-vous ici</a></span>
                </div>
            </div>
        </form>

        <?php
        if($error_msg){
            ?>
            <p><?php echo $error_msg; ?></php>
            <?php
        }
         ?>
    </div>
    </div>
    </div>
</div>
</body>

</html>

