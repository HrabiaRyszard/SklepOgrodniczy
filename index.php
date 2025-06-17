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
                <h2 class="noMargin">Witamy w naszym Sklepie Ogrodniczym!</h2>
                <p>Z pasji do ogrodnictwa stworzyliśmy miejsce, w którym każdy miłośnik zieleni znajdzie coś dla siebie. Oferujemy szeroki wybór roślin, nasion, narzędzi i akcesoriów ogrodniczych najwyższej jakości. Niezależnie od tego, czy dopiero zaczynasz swoją przygodę z ogrodem, czy jesteś doświadczonym ogrodnikiem – jesteśmy tu, aby Ci pomóc!</p>
                <div>
                    <h2>Polecany przez nas produkt:</h2>
                        <div class="recomendedProduct">
                            <img src="images/konewka.jpg" alt="konewka">
                            <h3>Konewka metalowa</h3>
                            <a href="details.php?id=19"><button>Sprawź →</button></a>
                        </div>
                </div>
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
