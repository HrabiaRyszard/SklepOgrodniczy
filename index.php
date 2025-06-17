<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sklep Ogrodniczy</title>
    <link rel="stylesheet" href="./style/styl.css">
</head>
<body>
    <header>
        <a href="index.php"><h1 class="noMargin">Sklep ogrodniczy</h1></a>
        <div class="buttonContainer">
            <a href="products.php">
                <button class="iconButton">
                    <img src="./icons/products.svg" alt="Produkty" style="width:48px; height:48px; vertical-align:middle;">
                </button>
            </a>
            <a href="cart.php">
                <button class="iconButton">
                    <img src="./icons/cart.svg" alt="Produkty" style="width:48px; height:48px; vertical-align:middle;">
                </button>
            </a>
            <a href="login.php" >
                <button class="iconButton">
                    <img src="./icons/account.svg" alt="Konto" style="width:48px; height:48px; vertical-align:middle;">
                </button>
            </a>
        </div>
    </header>
    <main>
        <div class="center">
            <div class="note">
                <h2 class="noMargin" style="width: 100%; margin: 20px;">Witamy w naszym Sklepie Ogrodniczym!</h2>
                <p>Z pasji do ogrodnictwa stworzyliśmy miejsce, w którym każdy miłośnik zieleni znajdzie coś dla siebie. Oferujemy szeroki wybór roślin, nasion, narzędzi i akcesoriów ogrodniczych najwyższej jakości. Niezależnie od tego, czy dopiero zaczynasz swoją przygodę z ogrodem, czy jesteś doświadczonym ogrodnikiem – jesteśmy tu, aby Ci pomóc!</p>
            </div>
            <h2 style="margin-right:20px;"></h2>
            <div class="featured-products" style="display:flex;flex-wrap:wrap;gap:24px;justify-content:center;">
                <?php
                require './db.php';
                $featured = [];
                $res = mysqli_query($db, "SELECT * FROM produkt ORDER BY RAND() LIMIT 3");
                while ($row = mysqli_fetch_assoc($res)) {
                    $featured[] = $row;
                }
                foreach ($featured as $product): ?>
                    <div class="product-card" style="background:#fff;border-radius:8px;box-shadow:0 2px 8px #0001;padding:16px;width:220px;text-align:center; margin-right:50px;">
                        <a href="details.php?id=<?= $product['id'] ?>">
                            <img src="images/<?= $product['url_zdjecia'] ? $product['url_zdjecia'] : 'placeholder.png' ?>" alt="<?= htmlspecialchars($product['nazwa']) ?>" style="max-width:100%;height:140px;object-fit:cover;border-radius:4px;">
                        </a>
                        <h3 style="margin:10px 0 5px 0; font-size:1.1em;"><?= htmlspecialchars($product['nazwa']) ?></h3>
                        <div style="color:#555; font-size:0.95em; min-height:40px;"><?= mb_strimwidth($product['opis'], 0, 60, '...') ?></div>
                        <div style="font-weight:bold; color:#2a7c2a; margin:8px 0;"><?= $product['cena'] ?> zł</div>
                        <a href="details.php?id=<?= $product['id'] ?>"><button style="width:100%;">Zobacz szczegóły</button></a>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </main>
    <footer>
        <div class="noMargin">
            Autorzy: <b>Ryszard Osiński</b>, <b>Mirosław Karpowicz</b>, <b>Szymon Linek</b>, <b>Krystian Kotowski</b>
        </div>
    </footer>
</body>
</html>
