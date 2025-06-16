<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dodaj pracownika</title>
</head>

<body>
    <h1>Dodaj nowego pracownika</h1>
    <p>Wypełnij poniższy formularz, aby dodać nowego pracownika.</p>
    <p>Uwaga: Pamiętaj, aby hasło było silne i zawierało co najmniej 8 znaków, w tym wielkie litery, małe litery, cyfry i znaki specjalne.</p>
    <p>Wszystkie pola są wymagane.</p>

    <form action="addUser.php" method="post">
        <label for="imie">Imię:</label>
        <input type="text" id="imie" name="imie" required>
        <br>
        <label for="nazwisko">Nazwisko:</label>
        <input type="text" id="nazwisko" name="nazwisko" required>
        <br>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
        <br>
        <label for="telefon">Telefon:</label>
        <input type="tel" id="telefon" name="telefon" required>
        <br>
        <label for="rola">Rola:</label>
        <select id="rola" name="rola" required>
            <option value="admin">Admin</option>
            <option value="pracownik">Pracownik</option>
        </select>
        <br>
        <label for="data_zatrudnienia">Data zatrudnienia:</label>
        <input type="date" id="data_zatrudnienia" name="data_zatrudnienia" required>
        <br>
        <label for="login">Login:</label>
        <input type="text" id="login" name="login" required>
        <br>
        <label for="haslo">Hasło:</label>
        <input type="password" id="haslo" name="haslo" required>
        <br>
        <label for="placa">Płaca:</label>
        <input type="number" id="placa" name="placa" required>
        <br>
        <button type="submit">Dodaj pracownika</button>
</body>

</html>
