<?php

$host = "";
$user = "";
$password = "";
$db = "";

$connessione = new mysqli($host, $user, $password, $db);

if ($connessione === false) {
    die("Errore durante la connessione: " . $connessione->connect_error);
}
