<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../login.php");
    exit();
}
require '../db.php';
if (!isset($_GET['id'])) {
    echo "Nieprawidłowe ID użytkownika.";
    exit();
}

$userID = $_GET['id'];

$sql = "SELECT * FROM uzytkownik WHERE id = '$userID'";
$result = mysqli_query($db, $sql);
if (!$result || mysqli_num_rows($result) === 0) {
    echo "Brak użytkownika o podanym ID.";
    exit();
}
$user = mysqli_fetch_assoc($result);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $imie = $_POST['imie'];
    $nazwisko = $_POST['nazwisko'];
    $email = $_POST['email'];
    $login = $_POST['login'];
    $password = mysqli_real_escape_string($db, $_POST['haslo']);
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $update_sql = "UPDATE uzytkownik SET imie='$imie',  nazwisko='$nazwisko', email='$email', login='$login', haslo='$hashed_password' WHERE id='$userID'";
    if (!mysqli_query($db, $update_sql)) {
        echo "<p class='error'>Błąd zapisywania</p>";
    } else {
        header("Location: adminPanel.php");
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sklep Ogrodniczy</title>
    <link rel="stylesheet" href="../style/adminstyl.css">
    <style>
        .userForm{
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
.userForm input{
    width: 250px;
    height: 23px;
    font-weight: bolder;
    color: black;
    border: 2px solid black;
}
.userForm button{
    background-color: orangered;
    width: 258px;
    height: 29px;
    font-weight: bolder;
    color: black;
    border: 2px solid black;
}
.userForm h2{
    font-size: xx-large;
    font-family:Verdana;
    margin: 0;
}
.userForm form{
    margin: 30px;
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
            <form method="post" class="userForm">
                <h1 class="noMargin">Modyfikuj użytkownika</h1>
                <label>Imie<br>
                    <input type="text" name="imie" value="<?php echo $user['imie']; ?>" required>
                </label>

                <label>Nazwisko<br>
                    <input type="text" name="nazwisko" value="<?php echo $user['nazwisko']; ?>" required>
                </label>

                <label>Email<br>
                    <input type="email" name="email" value="<?php echo $user['email']; ?>" required>
                </label>

                <label>Login<br>
                    <input type="text" name="login" value="<?php echo $user['login']; ?>" required>
                </label>
                <label>Hasło<br />
                    <input type="password" name="haslo" placeholder="Nowe hasło (opcjonalne)" autocomplete="new-password">
                </label>
                <button type="submit" style="margin-top: 5px;">Zapisz zmiany</button>
                <a href="adminPanel.php"><button type="button" style="margin-top: 5px;">Anuluj</button></a>
            </form>
        </div>
    </main>
    <footer>
        Autorzy: <b>Ryszard Osiński</b>, <b>Mirosław Karpowicz</b>, <b>Szymon Linek</b>, <b>Krystian Kotowski</b>
    </footer>
</body>

</html>
