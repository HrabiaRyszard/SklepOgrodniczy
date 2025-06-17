<?php
session_start();

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}
require '../db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_category'], $_POST['category_id'])) {
    $category_id = intval($_POST['category_id']);
    mysqli_query($db, "DELETE FROM kategoria WHERE id = $category_id");
    echo "<script>window.location.href=window.location.href;</script>";
}
?>
<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zarządzaj kategoriami</title>
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
            <h1 class="noMargin">Zarządzaj kategoriami</h1>
            <table>
                <tr>
                    <th>Nazwa kategorii</th>
                    <th>Akcje</th>
                </tr>
                <?php
                $sql = "SELECT * FROM kategoria order by nazwa";
                $result = mysqli_query($db, $sql);
                while ($row = mysqli_fetch_assoc($result)) : ?>
                    <tr>
                        <td><?= htmlspecialchars($row['nazwa']) ?></td>
                        <td style="text-align: center;">
                            <div style="display: flex; flex-direction: row; gap: 5px; justify-content: center; align-items: center;">
                                <a href="modifyCategories.php?id=<?= $row['id'] ?>"><button class='modifyBtn'>Modyfikuj</button></a>
                                <form method="post" style="margin:0;" onsubmit="return confirm('Czy na pewno chcesz usunąć tę kategorię?');">
                                    <input type="hidden" name="delete_category" value="1">
                                    <input type="hidden" name="category_id" value="<?= $row['id'] ?>">
                                    <button type="submit" class="modifyBtn" style="background:#c00;color:#fff;">Usuń kategorię</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </table>
        </div>
    </main>
    <footer>
        Autorzy: <b>Ryszard Osiński</b>, <b>Mirosław Karpowicz</b>, <b>Szymon Linek</b>, <b>Krystian Kotowski</b>
    </footer>
</body>

</html>
