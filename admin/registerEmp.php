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
    <!-- <link rel="stylesheet" href="../style/adminstyl.css"> -->
    <style>
body{
    margin: 0;
    height: 100%;
    background-color: #b45700;
    font-family: 'Segoe UI', sans-serif;
}
header{
    background-color: #b45700;
    line-height: 8vh;
    text-align: center;
    height: 15vh;
}
header h1{
    color: white;
}
.noMargin{
    margin: 0;
}
.buttonContainer{
    position: absolute;
    top: 3vh;
    right: 3vw;
}
header h1{
    font-size: 4rem;
    font-family: 'Franklin Gothic Medium';
}
.buttonContainer>a>button{
    background-color: orangered;
    border-width: 0;
    border-radius: 5px;
    color: white;
    height: 4.5rem;
    width: 8rem;
    font-size: 17px;
}
a{
    color: black;
    text-decoration: none;
}
footer{
    clear: both;
    position: relative;
    height: 7.5vh;
    position: absolute;
    width: 100%;
    text-align: center;
    background-color: #b45700;
    line-height: 7.5vh;
}
main{
    min-height: 77.5vh;
    height: 77.5%;
    background-color: #ffe8ce;
    text-align: center;
}
.operationsPanel{
    display: flex;
    flex-direction: column;
    height: 50vh;
    justify-content: space-around;
    align-items: center;
}
.operationsPanel button{
    background-color: orangered;
    border-radius: 20px;
    color: white;
    height: 4rem;
    width: 15rem;
    font-size: 17px;
    margin: 10px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);

}
.operationsPanel button:hover {
    background-color: #ff7300;
    transform: scale(1.05);
    transition: background-color 0.3s ease, transform 0.3s ease;
}
.operationsPanel a{
    height: 4.5rem;
    width: 15rem;
}
.productImage{
    height: 50px;
}
.modifyBtn{
    background-color: orangered;
    border-width: 0;
    border-radius: 5px;
    color: white;
    height: 1.5rem;
    width: 10rem;
}
.iconButton {
    background: none;
    border: none;
    padding: 0;
    cursor: pointer;
    box-shadow: none;
}
.iconButton:focus {
    outline: none;
}
.adminForm{
    background-color: white;
    width: 300px;
    min-height: 35vh;
    display: flex;
    justify-content: center;
    align-items: center;
    flex-direction: column;
    line-height: 1.75;
    padding: 20px;
    margin-top: 20px;
    border-radius: 20px;
    border: 4px solid black;
}
.center{
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    min-height: 70vh;
}
.adminForm input{
    width: 250px;
    height: 23px;
    font-weight: bolder;
    color: black;
    border: 2px solid black;
}
.adminForm button{
    background-color: orangered;
    width: 258px;
    height: 29px;
    font-weight: bolder;
    color: black;
    border: 2px solid black;
}
.adminForm h2{
    font-size: xx-large;
    font-family:Verdana;
    margin: 0;
}
.adminForm form{
    margin: 30px;
}
table{
    width: 100%;
}
td,th{
    border: 1px solid black;
}
    </style>
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
