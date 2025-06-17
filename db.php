<?php
$db = mysqli_connect("localhost", "root", "", "sklep");
mysqli_set_charset($db, 'utf8mb4');

if (!$db) {
    die("Błąd połączenia z bazą danych: " . mysqli_connect_error());
}
?>