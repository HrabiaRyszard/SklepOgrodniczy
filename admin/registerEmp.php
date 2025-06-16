<?php
require '../db.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $imie = $_POST['imie'];
    $nazwisko = $_POST['nazwisko'];
    $email = $_POST['email'];
    $telefon = $_POST['telefon'];
    $rola = $_POST['rola'];
    $data_zatrudnienia = $_POST['data_zatrudnienia'];
    $login = $_POST['login'];
    $haslo = password_hash($_POST['haslo'], PASSWORD_DEFAULT);
    $placa = $_POST['placa'];

    $sql = "INSERT INTO pracownik (imie, nazwisko, email, telefon, rola, data_zatrudnienia, login, haslo, placa) VALUES ('$imie', '$nazwisko', '$email', '$telefon', '$rola', '$data_zatrudnienia', '$login', '$haslo', '$placa')";


    if (mysqli_query($db, $sql)) {
        echo "Nowy pracownik został dodany pomyślnie.";
    } else {
        echo "Błąd: " . mysqli_error($db);
    }

    mysqli_close($db);
}
?>
<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zarejestruj pracownika</title>
    <link rel="stylesheet" href="../style/adminstyl.css">
</head>

<body>
    <header>
        <a href="../index.php">
            <h1 class="noMargin">Sklep ogrodniczy</h1>
        </a>
        <div class="buttonContainer">
            <a href="../admin/adminPanel.php">
                <button class="iconButton">
                    <img src="../icons/close.svg" alt="Index" style="width:48px; height:48px; vertical-align:middle;">
                </button>
            </a>
        </div>
    </header>
    <main>
        <div class="center">
        <form action="addUser.php" method="post" class="adminForm">
            <h1 class="noMargin">Zarejestruj pracownika</h1>
            <label for="imie">Imię:</label>
            <input type="text" id="imie" name="imie" required>
            <label for="nazwisko">Nazwisko:</label>
            <input type="text" id="nazwisko" name="nazwisko" required>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
            <label for="telefon">Telefon:</label>
            <input type="tel" id="telefon" name="telefon" required>
            <label for="rola">Rola:</label>
            <select id="rola" name="rola" required>
                <option value="admin">Admin</option>
                <option value="pracownik">Pracownik</option>
            </select>
            <label for="data_zatrudnienia">Data zatrudnienia:</label>
            <input type="date" id="data_zatrudnienia" name="data_zatrudnienia" required>
            <label for="login">Login:</label>
            <input type="text" id="login" name="login" required>
            <label for="haslo">Hasło:</label>
            <input type="password" id="haslo" name="haslo" required>
            <label for="placa">Płaca:</label>
            <input type="number" id="placa" name="placa" required>
            <button type="submit" style="margin-top: 10px;">Zarejestruj pracownika</button>
        </form>
    </div>
    </main>
    <footer>
        Autorzy: <b>Ryszard Osiński</b>, <b>Mirosław Karpowicz</b>, <b>Szymon Linek</b>, <b>Krystian Kotowski</b>
    </footer>
</body>

</html>
