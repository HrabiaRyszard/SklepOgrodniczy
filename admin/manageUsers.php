<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../login.php");
    exit();
}
require '../db.php';

$sql = "SELECT id, imie, nazwisko, email FROM uzytkownik";
$result = mysqli_query($db, $sql);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_user'], $_POST['user_id'])) {
    $user_id = $_POST['user_id'];
    mysqli_query($db, "DELETE FROM uzytkownik WHERE id = $user_id");
    echo "<script>window.location.href=window.location.href;</script>";
}
?>

<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zarządzaj użytkownikami</title>
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
                    <img src="../icons/back.svg" alt="Index" style="width:48px; height:48px; vertical-align:middle;">
                </button>
            </a>
        </div>
    </header>
    <main>
        <div>
            <h1 class="noMargin">Użytkownicy</h1>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Imię</th>
                        <th>Nazwisko</th>
                        <th>Email</th>
                        <th>Akcje</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($user = mysqli_fetch_assoc($result)) : ?>
                        <tr>
                            <td><?= $user['id'] ?></td>
                            <td><?= $user['imie'] ?></td>
                            <td><?= $user['nazwisko'] ?></td>
                            <td><?= $user['email'] ?></td>
                            <td>
                                <div style="display: flex; flex-direction: column; gap: 5px;">
                                    <a href="editUser.php?id=<?= $user['id'] ?>"><button class='modifyBtn'>Modyfikuj</button></a>
                                    <form method="post" style="margin:0;" onsubmit="return confirm('Czy na pewno chcesz usunąć tego użytkownika?');">
                                        <input type="hidden" name="delete_user" value="1">
                                        <input type="hidden" name="user_id" value="<?= $user['id'] ?>">
                                        <button type="submit" class="modifyBtn" style="background:#c00;color:#fff;">Usuń użytkownika</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>

            <p><a href="addUser.php">+ Dodaj nowego użytkownika</a></p>
        </div>
    </main>
    <footer>
        Autorzy: <b>Ryszard Osiński</b>, <b>Mirosław Karpowicz</b>, <b>Szymon Linek</b>, <b>Krystian Kotowski</b>
    </footer>
</body>

</html>
