<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>user page</title>

   <link rel="stylesheet" href="../style/styleC.css">

</head>

<body>

<div class="container">
        <div class="content">
            <h3>Salut, <span>utilisateur</span></h3>
            <h1>Bienvenue <span><?php echo $_SESSION['pseudo'] ?></span></h1>
            <p>C'est une page utilisateur</p>
      <a href="../vue/user_albums.php" class="btn">Albums</a>
      <a href="../controleur/deconnexion.php" class="btn">Deconnexion</a>
   </div>

</div>

</body>
</html>