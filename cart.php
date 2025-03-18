<?php
session_start();
include "../modele/db.php";
include "../modele/database.php";

// Initialize cart in session if it doesn't exist
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
}

// Handle adding item to cart
if (isset($_POST['add_to_cart']) && isset($_POST['id_album'])) {
    $albumId = $_POST['id_album'];
    
    // Check if the album exists
    $album = getAlbumById($albumId);
    
    if ($album) {
        // Add to cart in session
        if (isset($_SESSION['cart'][$albumId])) {
            // Increment quantity if already in cart
            $_SESSION['cart'][$albumId]['quantity']++;
        } else {
            // Add new item to cart
            $_SESSION['cart'][$albumId] = [
                'id' => $albumId,
                'title' => $album['titreAlb'],
                'price' => $album['prix'],
                'quantity' => 1,
                'photo' => $album['photo']
            ];
        }
        
        // If user is logged in, save to database
        if (isset($_SESSION['user'])) {
            $userId = $_SESSION['user']['mailU'];
            addToCartDb($userId, $albumId);
        }
    }
    
    // Redirect back to albums page
    header("Location: ../vue/user_albums.php?added=true");
    exit();
}

// Function to add item to cart in database
function addToCartDb($userId, $albumId) {
    global $conn;
    
    // Check if already in cart
    $stmt = $conn->prepare("SELECT * FROM panier WHERE mailU = ? AND idAlbum = ?");
    $stmt->bind_param("si", $userId, $albumId);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows == 0) {
        // Insert new item
        $stmt = $conn->prepare("INSERT INTO panier (mailU, idAlbum) VALUES (?, ?)");
        $stmt->bind_param("si", $userId, $albumId);
        $stmt->execute();
    }
}

// Handle removing item from cart
if (isset($_GET['remove']) && isset($_GET['id'])) {
    $albumId = $_GET['id'];
    
    // Remove from session cart
    if (isset($_SESSION['cart'][$albumId])) {
        unset($_SESSION['cart'][$albumId]);
    }
    
    // If user is logged in, remove from database
    if (isset($_SESSION['user'])) {
        $userId = $_SESSION['user']['mailU'];
        removeFromCartDb($userId, $albumId);
    }
    
    header("Location: cart.php");
    exit();
}

// Function to remove item from cart in database
function removeFromCartDb($userId, $albumId) {
    global $conn;
    
    $stmt = $conn->prepare("DELETE FROM panier WHERE mailU = ? AND idAlbum = ?");
    $stmt->bind_param("si", $userId, $albumId);
    $stmt->execute();
}

// Get cart items for display
function getCartItems() {
    if (!isset($_SESSION['cart']) || count($_SESSION['cart']) == 0) {
        return array();
    }
    
    return $_SESSION['cart'];
}

// Calculate cart total
function getCartTotal() {
    $total = 0;
    
    if (isset($_SESSION['cart'])) {
        foreach ($_SESSION['cart'] as $item) {
            $total += $item['price'] * $item['quantity'];
        }
    }
    
    return $total;
}

$cartItems = getCartItems();
$cartTotal = getCartTotal();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <title>Panier ⎸ SingLouder</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="../style/styleAlbs.css" type="text/css" rel="stylesheet">
    <style>
        .cart-table {
            width: 100%;
            margin-top: 30px;
        }
        .cart-table th, .cart-table td {
            padding: 10px;
            text-align: left;
        }
        .cart-total {
            text-align: right;
            margin-top: 20px;
            font-weight: bold;
        }
        .empty-cart {
            text-align: center;
            margin: 50px 0;
        }
        .album-thumbnail {
            width: 80px;
            height: auto;
        }
    </style>
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
                    <a href="../vue/vueConfirmationU.php"><img src="../img/inscription.webp" alt="compte" width="30px"></a>
                    <a href="cart.php"><img src="../img/shopping.webp" alt="cart" width="30px"></a>
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
                <a class="nav-link" href="../vue/user_albums.php">Albums</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="../vue/form.html">Formulaire</a>
              </li>
            </ul>
          </nav>
        <div class="content">
            <h1>PANIER</h1>
        </div>
       </div>
    </header>
    
    <main class="container">
        <?php if (count($cartItems) > 0): ?>
            <table class="cart-table">
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Album</th>
                        <th>Prix</th>
                        <th>Quantité</th>
                        <th>Total</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($cartItems as $item): ?>
                        <tr>
                            <td><img src="../img/<?php echo $item['photo']; ?>" class="album-thumbnail"></td>
                            <td><?php echo $item['title']; ?></td>
                            <td><?php echo $item['price']; ?>€</td>
                            <td><?php echo $item['quantity']; ?></td>
                            <td><?php echo $item['price'] * $item['quantity']; ?>€</td>
                            <td><a href="cart.php?remove=true&id=<?php echo $item['id']; ?>" class="btn btn-sm btn-danger">Supprimer</a></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            
            <div class="cart-total">
                <p>Total: <?php echo $cartTotal; ?>€</p>
                <a href="#" class="btn btn-primary">Procéder au paiement</a>
            </div>
        <?php else: ?>
            <div class="empty-cart">
                <h3>Votre panier est vide</h3>
                <p>Découvrez nos albums et ajoutez-les à votre panier.</p>
                <a href="../vue/user_albums.php" class="btn btn-primary">Voir les albums</a>
            </div>
        <?php endif; ?>
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