<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../login.php");
    exit();
}
require '../db.php';
if (!isset($_GET['id'])) {
    echo "Nieprawidłowe ID zamówienia.";
    exit();
}

$orderID = $_GET['id'];

$sql = "SELECT * FROM orderView WHERE zamowienie_id = '$orderID'";
$result = mysqli_query($db, $sql);
if (!$result || mysqli_num_rows($result) === 0) {
    echo "Brak zamówienia o podanym ID.";
    exit();
}
$order = mysqli_fetch_assoc($result);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_order'])) {
    $zamowienie_id = $order['zamowienie_id'];

    mysqli_query($db, "DELETE FROM szczegoly_zamowienia WHERE zamowienie_id='$zamowienie_id'");

    mysqli_query($db, "DELETE FROM zamowienie WHERE id='$zamowienie_id'");
    header("Location: adminPanel.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $miasto = mysqli_real_escape_string($db, $_POST['miasto']);
    $ulica = mysqli_real_escape_string($db, $_POST['ulica']);
    $numer_domu = mysqli_real_escape_string($db, $_POST['numer_domu']);
    $numer_mieszkania = mysqli_real_escape_string($db, $_POST['numer_mieszkania']);
    $kod_pocztowy = mysqli_real_escape_string($db, $_POST['kod_pocztowy']);
    $kurier_id = mysqli_real_escape_string($db, $_POST['kurier_id']);
    $data_zamowienia = mysqli_real_escape_string($db, $_POST['data_czas_zamowienia']);
    $data_realizacji = mysqli_real_escape_string($db, $_POST['data_czas_realizacji']);
    $uwagi = mysqli_real_escape_string($db, $_POST['uwagi']);
    $status = mysqli_real_escape_string($db, $_POST['status']);
    $platnosc = mysqli_real_escape_string($db, $_POST['platnosc']);
    $suma = mysqli_real_escape_string($db, $_POST['suma']);

    $adres_id = $order['adres_id'];
    $zamowienie_id = $order['zamowienie_id'];

    $adres_sql = "UPDATE adres SET miasto='$miasto', ulica='$ulica', numer_domu='$numer_domu', numer_mieszkania='$numer_mieszkania', kod_pocztowy='$kod_pocztowy' WHERE id='$adres_id'";
    if (!mysqli_query($db, $adres_sql)) {
        echo "<p class='error'>Błąd zapisywania adresu: " . mysqli_error($db) . "</p>";
    }

    $zamowienie_sql = "UPDATE zamowienie SET kurier_id='$kurier_id', data_czas_zamowienia='$data_zamowienia', data_czas_realizacji='$data_realizacji', uwagi='$uwagi', status='$status', platnosc='$platnosc', suma='$suma' WHERE id='$zamowienie_id'";
    if (!mysqli_query($db, $zamowienie_sql)) {
        echo "<p class='error'>Błąd zapisywania zamówienia: " . mysqli_error($db) . "</p>";
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
</head>

<body>
    <header>
        <a href="../index.php">
            <h1 class="noMargin">Sklep ogrodniczy</h1>
        </a>
        <div class="buttonContainer">
            <a href="../admin/viewOrders.php">
                <button class="iconButton">
                    <img src="../icons/back.svg" alt="Index" style="width:48px; height:48px; vertical-align:middle;">
                </button>
            </a>
        </div>
    </header>
    <main>
        <div>
            <form method="post" >
                <h1 class="noMargin">Podgląd zamówienia</h1>
                <table>
                <thead>
                    <tr>
                        <th>ID zamówienia</th>
                        <th>ID Użytkownika</th>
                        <th>Imię</th>
                        <th>Miasto</th>
                        <th>Ulica</th>
                        <th>Numer domu</th>
                        <th>Numer Mieszkania</th>
                        <th>Kod Pocztowy</th>
                        
                        
                        <th>ID Kuriera</th>
                        <th>Data zamówienia</th>
                        <th>Data realizacji</th>
                        
                        <th>Uwagi</th>
                        <th>Status</th>
                        <th>Płatność</th>
                        <th>Suma</th>       
                        <th>Akcje</th>
                    </tr>
                </thead>
                <tbody>
                        <tr>                    
                            <td><?= $order['zamowienie_id'] ?></td>
                            <td><?= $order['uzytkownik_id'] ?></td>                         
                            <td><?= $order['uzytkownik_imie'] . " " . $order['uzytkownik_nazwisko'] ?></td>
                            <td><input type="text" name="miasto" value="<?= $order['miasto'] ?>" required /></td>
                            <td><input type="text" name="ulica" value="<?= $order['ulica'] ?>" required /></td>
                            <td><input type="text" name="numer_domu" value="<?= $order['numer_domu'] ?>" required /></td>
                            <td><input type="text" name="numer_mieszkania" value="<?= $order['numer_mieszkania'] ?>" /></td>
                            <td><input type="text" name="kod_pocztowy" value="<?= $order['kod_pocztowy'] ?>" required /></td>                     
                            <td>
                                <select name="kurier_id" required>
                                    <option value="" disabled selected>-- wybierz --</option>
                                    <?php
                                    $kurier_sql = "SELECT * FROM pracownik WHERE rola = 'kurier'";
                                    $kurier_result = mysqli_query($db, $kurier_sql);
                                    while ($kurier = mysqli_fetch_assoc($kurier_result)) {
                                        $selected = $order['kurier_id'] == $kurier['id'] ? 'selected' : '';
                                        echo "<option value='{$kurier['id']}' $selected>{$kurier['imie']} {$kurier['nazwisko']}</option>";
                                    }
                                    ?>
                            </td>
                            <td><input type="datetime-local" name="data_czas_zamowienia" value="<?= date('Y-m-d\TH:i', strtotime($order['data_czas_zamowienia'])) ?>" required /></td>
                            <td><input type="datetime-local" name="data_czas_realizacji" value="<?= $order['data_czas_realizacji'] ? date('Y-m-d\TH:i', strtotime($order['data_czas_realizacji'])) : '' ?>" /></td>    
                            <td><input type="text" name="uwagi" value="<?= $order['uwagi'] ?>" /></td>
                            <td>
                                <select name="status" required>
                                    <option value="" disabled selected>-- wybierz --</option>
                                    <option value="przyjęte" <?= $order['status'] === 'przyjęte' ? 'selected' : '' ?>>Przyjęte</option>
                                    <option value= "spakowane" <?= $order['status'] === 'spakowane' ? 'selected' : '' ?>>Spakowane</option>
                                    <option value="dostarczone" <?= $order['status'] === 'dostarczone' ? 'selected' : '' ?>>Dostarczone</option>
                                </select>
                            </td>
                            <td>
                                <select name="platnosc" required>
                                    <option value="" disabled selected>-- wybierz --</option>
                                    <option value="blik" <?= $order['platnosc'] === 'blik' ? 'selected' : '' ?>>Blik</option>
                                    <option value= "przelew" <?= $order['platnosc'] === 'przelew' ? 'selected' : '' ?>>Przelew</option>
                                    <option value="gotówka" <?= $order['platnosc'] === 'gotówka' ? 'selected' : '' ?>>Gotówka</option>
                                </select>
                                </td>
                                <td><input type="text" name="suma" value="<?= $order['suma'] ?>" required /></td>

                                <td>
                                    <button type="submit" class="modifyBtn">Zapisz zmiany</button>
                                </form>
                                <form method="post" onsubmit="return confirm('Czy na pewno chcesz usunąć to zamówienie?');">
                                    <input type="hidden" name="delete_order" value="1">
                                    <button type="submit" class="modifyBtn" style="background:#c00;color:#fff;">Usuń zamówienie</button>
                                </form>
                                </td>
                            </td>
                        </tr>
                </tbody>
            </table>
            </form>
        </div>
    </main>
    <footer>
        Autorzy: <b>Ryszard Osiński</b>, <b>Mirosław Karpowicz</b>, <b>Szymon Linek</b>, <b>Krystian Kotowski</b>
    </footer>
</body>

</html>
